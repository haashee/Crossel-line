<?php

namespace App\Http\Controllers;

use App\Models\Account;
use App\Models\Chat;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\Http;


use App\Models\LineUser;
use App\Models\ReceivedMedia;
use App\Models\RichMenu;
use LINE\LINEBot\HTTPClient\CurlHTTPClient;
use LINE\LINEBot;
use App\Models\User;
use App\Models\RichmenuSetting;

use LINE\LINEBot\MessageBuilder\TextMessageBuilder;
use LINE\LINEBot\MessageBuilder\StickerMessageBuilder;
use LINE\LINEBot\MessageBuilder\LocationMessageBuilder;
use LINE\LINEBot\MessageBuilder\TemplateMessageBuilder;
use LINE\LINEBot\MessageBuilder\TemplateBuilder\ConfirmTemplateBuilder;
use LINE\LINEBot\TemplateActionBuilder\MessageTemplateActionBuilder;
use LINE\LINEBot\TemplateActionBuilder\UriTemplateActionBuilder;
use LINE\LINEBot\MessageBuilder\TemplateBuilder\CarouselColumnTemplateBuilder;
use LINE\LINEBot\MessageBuilder\TemplateBuilder\CarouselTemplateBuilder;
use LINE\LINEBot\MessageBuilder\TemplateBuilder\ButtonTemplateBuilder;
use LINE\LINEBot\TemplateActionBuilder\DatetimePickerTemplateActionBuilder;
use LINE\LINEBot\QuickReplyBuilder\ButtonBuilder\QuickReplyButtonBuilder;
use LINE\LINEBot\QuickReplyBuilder\QuickReplyMessageBuilder;
use LINE\LINEBot\MessageBuilder\RawMessageBuilder;
use LINE\LINEBot\MessageBuilder\MultiMessageBuilder;

use LINE\LINEBot\RichMenuBuilder\RichMenuAreaBuilder;
use LINE\LINEBot\RichMenuBuilder\RichMenuSizeBuilder;
use LINE\LINEBot\RichMenuBuilder\RichMenuAreaBoundsBuilder;
use LINE\LINEBot\TemplateActionBuilder\PostbackTemplateActionBuilder;
use LINE\LINEBot\RichMenuBuilder;

use Log;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use \LINE\LINEBot\Constant\HTTPHeader;
use Illuminate\Support\Facades\Storage;
use Carbon\Carbon;



class LineMessengerController extends Controller
{
    public function webhook(Request $request, $aid)
    {
        // get account ID (aid) 
        $account = Account::where('id', $aid)->first();

        // Get the rich menu setting for this account
        $richmenuSetting = RichmenuSetting::where('account_id', $aid)->first();

        // get current default richmenu table
        $richmenu = RichMenu::where([
            'account_id' => $aid,
            'default' => true,
        ])->get();

        // get channel secret and access token
        $channel_secret = $account->channel_secret;
        $access_token = $account->access_token;

        // LINE???????????????????????????$inputs?????????
        $inputs = $request->all();

        // ????????????type??????????????????$message_type?????????
        $message_type = $inputs['events'][0]['type'];
        Log::info("LOG: received message type is `" . $message_type . "`");

        // LINEBOTSDK?????????
        $http_client = new CurlHTTPClient($access_token);
        $bot = new LINEBot($http_client, ['channelSecret' => $channel_secret]);

        // check signature if message is from LINE
        $signature = $request->header('x-line-signature');
        if (!$bot->validateSignature($request->getContent(), $signature)) {
            abort(400, 'Invalid signature');
            Log::warning("LOG: Signature is not validated");
        } else {
            Log::info("LOG: Signature is validated `" . $signature . "`");
        }

        // LINE???????????????ID???userId?????????
        $userId = $request['events'][0]['source']['userId'];

        // userId??????????????????????????????
        $user = LineUser::where('line_id', $userId)->first();

        // check if blacklisted
        if ($user != NULL && $user->isBlackListed) {
            Log::warning("Exited because the user " . $user->name  . " is blacklisted");
            return;
        }

        // ???????????????????????????????????????????????????????????????
        if ($user == NULL) {
            $profile = $bot->getProfile($userId)->getJSONDecodedBody();
            $mode = $inputs['events'][0]['mode'];

            // add to database
            $user = new LineUser();
            $user->name = $profile['displayName'];
            $user->line_id = $userId;
            $user->provider = 'line';
            $user->mode = $mode;
            $user->image = 'default_lineprofilepicture.png';
            $user->account_id = $account->id;
            $user->save();
        }

        // check if chat for this user exists
        $chatUser = Chat::where('lineuser_id', $user->line_id)->first();

        // if does not exist then create new
        if ($chatUser == NULL && $message_type == 'message') {
            // if message is an image
            if ($inputs['events'][0]['message']['type'] == 'image') {
                $message_content = 'image file';
            } elseif ($inputs['events'][0]['message']['type'] == 'video') {
                $message_content = 'video file';
            } else {
                // get message content that was sent to you
                $message_content = $inputs['events'][0]['message']['text'];
            }
            // get profile info of user
            $profile = $bot->getProfile($userId)->getJSONDecodedBody();

            $chatUser = new Chat();
            $chatUser->senderName = $profile['displayName'];
            $chatUser->receiverName = $account->name;
            $chatUser->message = $message_content;
            $chatUser->lineuser_id = $user->id;
            $chatUser->user_identifier = $userId;
            $chatUser->save();
        }

        // get basic_id of account from LINE 
        $profileInfo = Http::withToken($account->access_token)->get('https://api.line.me/v2/bot/info');
        $basicId = json_decode($profileInfo)->basicId;
        $account->basic_id = $basicId;
        $account->save();
        Log::info("LOG: the basicId of new account is `$basicId`");

        // $response = $bot->getRichMenuId($userId);

        // ????????????????????????
        switch ($message_type) {

                // ?????????????????????
            case 'message':

                // get the token needed to reply
                $reply_token = $inputs['events'][0]['replyToken'];

                // get message content that was sent to you
                // $message_content = $inputs['events'][0]['message']['text'];

                // if message content is button texts 
                if ($message_content == '?????????????????????') {
                    // get flex json template for layout (https://developers.line.biz/flex-simulator/)
                    // https://developers.line.biz/en/docs/messaging-api/using-flex-messages/
                    $flexTemplate = file_get_contents(resource_path() . "/json/flex_btn_menu.json");

                    // decode the json template
                    $data = json_decode($flexTemplate, true);

                    // change the URI of button
                    $data["footer"]["contents"]["0"]["action"]["uri"] = 'https://liff.line.me/' . $account->liff_full;

                    // create flex message
                    $flexMessageBuilder = new RawMessageBuilder([
                        'type' => 'flex',
                        'altText' => '?????????????????????',
                        'contents' => $data,
                    ]);

                    // send this flex message
                    $response = $bot->replyMessage($reply_token, $flexMessageBuilder);
                } else if ($message_content == '????????????') {
                    // get flex json template for layout (https://developers.line.biz/flex-simulator/)
                    // https://developers.line.biz/en/docs/messaging-api/using-flex-messages/
                    $flexTemplate = file_get_contents(resource_path() . "/json/flex_btn_membership.json");

                    // decode the json template
                    $data = json_decode($flexTemplate, true);

                    // change the title of template
                    $data["body"]["contents"]["0"]["contents"]["1"]["contents"]["0"]["text"] = $user->name . '???????????????';

                    // change the URI of button
                    $data["footer"]["contents"]["0"]["action"]["uri"] = 'https://liff.line.me/' . $account->liff_tall;

                    // create flex message
                    $flexMessageBuilder = new RawMessageBuilder([
                        'type' => 'flex',
                        'altText' => '????????????',
                        'contents' => $data
                    ]);

                    // send this flex message
                    $response = $bot->replyMessage($reply_token, $flexMessageBuilder);
                } else if ($message_content == 'image file') {
                    // get media ID from message
                    $mediaId = $inputs['events'][0]['message']['id'];

                    // send to verify media id
                    $response = $bot->getMessageContent($mediaId);

                    // if status 200 from response
                    if ($response->isSucceeded()) {
                        // get binary image 
                        $binary = $response->getRawBody();

                        // set path of new image to store
                        $pathMedia = "/media" . "/" . $aid . '-' . uniqid() . ".jpg";

                        // store received image
                        Storage::disk("public")->put($pathMedia, $binary);

                        // save image to received media
                        $media = new ReceivedMedia();
                        $media->media = $pathMedia;
                        $media->type = 'image';
                        $media->senderName = $user->name;
                        $media->delete_at = Carbon::now()->addDays(1)->format('Y-m-d');
                        $media->account_id = $aid;
                        $media->save();

                        // log if succeeded
                        Log::info("Image received and saved`" . $pathMedia . "`");
                    } else {
                        Log::error($response->getHTTPStatus() . ' ' . $response->getRawBody());
                    }
                } else if ($message_content == 'video file') {
                    // get media ID from message
                    $mediaId = $inputs['events'][0]['message']['id'];

                    // send to verify media id
                    $response = $bot->getMessageContent($mediaId);

                    // if status 200 from response
                    if ($response->isSucceeded()) {
                        // get binary image 
                        $binary = $response->getRawBody();

                        // set path of new image to store
                        $pathMedia = "/media" . "/" . $aid . '-' . uniqid() . ".mp4";

                        // store received image
                        Storage::disk("public")->put($pathMedia, $binary);

                        // save image to received media
                        $media = new ReceivedMedia();
                        $media->media = $pathMedia;
                        $media->type = 'video';
                        $media->senderName = $user->name;
                        $media->delete_at = Carbon::now()->addDays(1)->format('Y-m-d');
                        $media->account_id = $aid;
                        $media->save();

                        // log if succeeded
                        Log::info("Video received and saved`" . $pathMedia . "`");
                    } else {
                        Log::error($response->getHTTPStatus() . ' ' . $response->getRawBody());
                    }
                } elseif ($message_content == $richmenuSetting->nameA) {
                    //Send quick reply message

                    // get string from richmenu setting (multi btn actions)
                    $stringList = $richmenuSetting->multiBtnA;

                    //Define display texts for quick reply (max number is 12)
                    // explode the string and set it as buttons
                    $buttons = explode(',', $stringList);

                    // $categories = [
                    //     '??????', '??????', '????????????', '???????????????????????????', '???????????????', '????????????'
                    // ];

                    foreach ($buttons as $button) {
                        // Display the texts and define reply text
                        $message_template_action_builder = new MessageTemplateActionBuilder($button, $button); #(display text, reply text)
                        // Create buttons for the display text
                        $quick_reply_button_builder = new QuickReplyButtonBuilder($message_template_action_builder);
                        // Add buttons
                        $quick_reply_buttons[] = $quick_reply_button_builder;
                    }
                    // Create quick reply and send message
                    $quick_reply_message_builder = new QuickReplyMessageBuilder($quick_reply_buttons);
                    $text_message_builder = new TextMessageBuilder($richmenuSetting->displayTextA, $quick_reply_message_builder); #(text bubble, quick reply)
                    $response = $bot->replyMessage($reply_token, $text_message_builder);
                } elseif ($message_content == $richmenuSetting->nameB) {
                    //Send quick reply message

                    // get string from richmenu setting (multi btn actions)
                    $stringList = $richmenuSetting->multiBtnB;

                    //Define display texts for quick reply (max number is 12)
                    // explode the string and set it as buttons
                    $buttons = explode(',', $stringList);

                    foreach ($buttons as $button) {
                        // Display the texts and define reply text
                        $message_template_action_builder = new MessageTemplateActionBuilder($button, $button); #(display text, reply text)
                        // Create buttons for the display text
                        $quick_reply_button_builder = new QuickReplyButtonBuilder($message_template_action_builder);
                        // Add buttons
                        $quick_reply_buttons[] = $quick_reply_button_builder;
                    }
                    // Create quick reply and send message
                    $quick_reply_message_builder = new QuickReplyMessageBuilder($quick_reply_buttons);
                    $text_message_builder = new TextMessageBuilder($richmenuSetting->displayTextB, $quick_reply_message_builder); #(text bubble, quick reply)
                    $response = $bot->replyMessage($reply_token, $text_message_builder);
                } elseif ($message_content == $richmenuSetting->nameC) {
                    //Send quick reply message

                    // get string from richmenu setting (multi btn actions)
                    $stringList = $richmenuSetting->multiBtnC;

                    //Define display texts for quick reply (max number is 12)
                    // explode the string and set it as buttons
                    $buttons = explode(',', $stringList);

                    foreach ($buttons as $button) {
                        // Display the texts and define reply text
                        $message_template_action_builder = new MessageTemplateActionBuilder($button, $button); #(display text, reply text)
                        // Create buttons for the display text
                        $quick_reply_button_builder = new QuickReplyButtonBuilder($message_template_action_builder);
                        // Add buttons
                        $quick_reply_buttons[] = $quick_reply_button_builder;
                    }
                    // Create quick reply and send message
                    $quick_reply_message_builder = new QuickReplyMessageBuilder($quick_reply_buttons);
                    $text_message_builder = new TextMessageBuilder($richmenuSetting->displayTextC, $quick_reply_message_builder); #(text bubble, quick reply)
                    $response = $bot->replyMessage($reply_token, $text_message_builder);
                } else if ($account->chatSetting->default_text_active == true) {
                    // The message to send
                    $message_data = $account->chatSetting->default_text;

                    // LINE process to send
                    $response = $bot->replyText($reply_token, $message_data);
                } else {
                    Log::info('LOG: break as message does not fit case');
                    break;
                }

                // Succeeded
                if ($response->isSucceeded()) {
                    Log::info('LOG: the message is sent');
                    break;
                }
                // Failed
                Log::error($response->getRawBody());
                break;

                // Added as new friend or unblocked
            case 'follow':
                // get the token needed to reply
                $reply_token = $inputs['events'][0]['replyToken'];

                // send welcome text if active
                if ($account->chatSetting->welcome_text_active == true) {
                    // The message to send
                    $message_data = $account->chatSetting->welcome_text;

                    // LINE process to send
                    $response = $bot->replyText($reply_token, $message_data);

                    Log::info("Welcome message sent to " . $userId);
                }

                // link LINE user ID with rich menu ID
                $response = $bot->linkRichMenu($userId, $account->richmenu_id);

                // ?????????????????????ID????????????????????????????????????????????????????????????????????????????????????????????????
                LineUser::updateOrCreate(['line_id' => $userId]);
                Log::info("New user added user_id = " . $userId);
                break;

                // Enter chat room
            case 'join':
                // get the token needed to reply
                $reply_token = $inputs['events'][0]['replyToken'];

                // send welcome text if active
                if ($account->chatSetting->welcome_text_active == true) {
                    // The message to send
                    $message_data = $account->chatSetting->welcome_text;

                    // LINE process to send
                    $response = $bot->replyText($reply_token, $message_data);

                    Log::info("Welcome message sent to " . $userId);
                }

                // link LINE user ID with rich menu ID
                $response = $bot->linkRichMenu($userId, $account->richmenu_id);

                // ?????????????????????ID????????????????????????????????????????????????????????????????????????????????????????????????
                LineUser::updateOrCreate(['line_id' => $userId]);
                Log::info("New user added user_id = " . $userId);
                Log::info("????????????????????????????????????????????????????????????");
                break;

                // Leave chat room
            case 'leave':
                Log::info("?????????????????????????????????????????????????????????????????????");
                break;

                // Block or unfollow
            case 'unfollow':
                $bot->unlinkRichMenu($userId);
                LineUser::where('line_id', $userId)->delete();
                Log::info("?????????????????????????????????????????????");
                break;

            default:
                Log::info("the type is `" . $message_type . "`");
                break;
        }

        return;
    }

    public function webhookDefault(Request $request, $aid)
    {

        // get account ID (aid) 
        $account = Account::where('id', $aid)->first();

        // get channel secret and access token
        $channel_secret = $account->channel_secret;
        $access_token = $account->access_token;

        // LINE???????????????????????????$inputs?????????
        $inputs = $request->all();

        // ????????????type??????????????????$message_type?????????
        $message_type = $inputs['events'][0]['type'];
        Log::info("LOG: received message type is `" . $message_type . "`");

        // LINEBOTSDK?????????
        $http_client = new CurlHTTPClient($access_token);
        $bot = new LINEBot($http_client, ['channelSecret' => $channel_secret]);
        // $http_client = new CurlHTTPClient(config('services.line.channel_token'));
        // $bot = new LINEBot($http_client, ['channelSecret' => config('services.line.messenger_secret')]);

        // LINE???????????????ID???userId?????????
        $userId = $request['events'][0]['source']['userId'];

        // userId??????????????????????????????
        $user = LineUser::where('line_id', $userId)->first();

        // ???????????????????????????????????????????????????????????????
        if ($user == NULL) {
            $profile = $bot->getProfile($userId)->getJSONDecodedBody();
            $mode = $inputs['events'][0]['mode'];
            // $id = Auth::user()->id;

            $user = new LineUser();
            $user->name = $profile['displayName'];
            $user->line_id = $userId;
            $user->provider = 'line';
            $user->mode = $mode;
            $user->image = 'default_lineprofilepicture.png';
            $user->account_id = $account->id;
            $user->save();
        }

        // check if chat for this user exists
        $chatUser = Chat::where('lineuser_id', $user->line_id)->first();

        // if does not exist then create new
        if ($chatUser == NULL) {
            // get message content that was sent to you
            $message_content = $inputs['events'][0]['message']['text'];
            // get profile info of user
            $profile = $bot->getProfile($userId)->getJSONDecodedBody();

            $chatUser = new Chat();
            $chatUser->senderName = $profile['displayName'];
            $chatUser->receiverName = $account->name;
            $chatUser->message = $message_content;
            $chatUser->lineuser_id = $user->id;
            $chatUser->user_identifier = $userId;
            $chatUser->save();
        }

        // $response = $bot->getRichMenuId($userId);

        // ????????????????????????
        switch ($message_type) {

                // ?????????????????????
            case 'message':

                // get the token needed to reply
                $reply_token = $inputs['events'][0]['replyToken'];

                // get message content that was sent to you
                $message_content = $inputs['events'][0]['message']['text'];

                // The message to send
                $message_data = "???????????????????????????????????????????????????????????????????????????";

                // if message content is `??????`
                if ($message_content == '??????') {
                    $message_data = $reply_token . '???????????????????????????????????????';
                }

                if ($message_content == 'Stamp') {
                    //Send stamp message
                    $response = $bot->replyMessage($reply_token, new StickerMessageBuilder('1', '2')); #LINE stamp Id  
                } elseif ($message_content == 'Location') {
                    //Send location message
                    $response = $bot->replyMessage($reply_token, new LocationMessageBuilder("????????????", "???????????????????????????", 27.576718, 84.493928));
                } elseif ($message_content == 'Confirm') {
                    //Send confirm message
                    $bot->replyMessage(
                        $reply_token,
                        new TemplateMessageBuilder(
                            'Confirm alt text',
                            new ConfirmTemplateBuilder(
                                'Do it?',
                                [new MessageTemplateActionBuilder('Yes', 'Yes!'), new MessageTemplateActionBuilder('No', 'No!'),]
                            )
                        )
                    );
                } elseif ($message_content == 'Button') {
                    //Send button message
                    // Create button in buttons message
                    $yes_button = new MessageTemplateActionBuilder('Confirm text', 'reply text');
                    $no_button = new MessageTemplateActionBuilder('Cancel text', 'reply text');
                    // Select date template
                    $date_time = new DatetimePickerTemplateActionBuilder('???????????????', 'action=dosomething&data=1', 'datetime');
                    // Create actions
                    $actions = [$date_time, $yes_button, $no_button];
                    $button = new ButtonTemplateBuilder('Title', 'Description', '', $actions);
                    // Add button message and send message
                    $button_message = new TemplateMessageBuilder('Alt text', $button);
                    $bot->replyMessage($reply_token, $button_message);
                } elseif ($message_content == 'Carousel') {
                    //Send carousel message
                    $columns = []; // Column array for carousel
                    for ($i = 0; $i < 3; $i++) {
                        // Create button in carousel
                        $action = new UriTemplateActionBuilder("?????????????????????", 'https://liff.line.me/' . $account->liff_full);
                        // Create columns for carousel
                        $column = new CarouselColumnTemplateBuilder("????????????(40????????????)", "???????????????", 'https://57c57cef.ngrok.io/linebot/image/PICT0065.JPG', [$action]);
                        $columns[] = $column;
                    }
                    // Create carousel from columns
                    $carousel = new CarouselTemplateBuilder($columns);
                    // Add carousel and send message
                    $carousel_message = new TemplateMessageBuilder("??????????????????????????????", $carousel);
                    $response = $bot->replyMessage($reply_token, $carousel_message);
                } elseif ($message_content == 'Flex') {
                    // get flex json for layout (https://developers.line.biz/flex-simulator/)
                    // https://developers.line.biz/en/docs/messaging-api/using-flex-messages/
                    $flexTemplate = file_get_contents(resource_path() . "/json/flex_receipt.json");
                    // create flex message
                    $flexMessageBuilder = new RawMessageBuilder([
                        'type' => 'flex',
                        'altText' => 'Test Flex Message',
                        'contents' => json_decode($flexTemplate)
                    ]);
                    // send flex message
                    $response = $bot->replyMessage($reply_token, $flexMessageBuilder);
                } elseif ($message_content == 'Quick') {
                    //Send quick reply message
                    //Define display texts for quick reply (max number is 12)
                    $categories = [
                        '??????',
                        '??????',
                        '????????????',
                        '???????????????????????????',
                        '???????????????',
                        '????????????'
                    ];

                    foreach ($categories as $category) {
                        // Display the texts and define reply text
                        $message_template_action_builder = new MessageTemplateActionBuilder($category, $category . '?????????????????????'); #(display text, reply text)
                        // Create buttons for the display text
                        $quick_reply_button_builder = new QuickReplyButtonBuilder($message_template_action_builder);
                        // Add buttons
                        $quick_reply_buttons[] = $quick_reply_button_builder;
                    }
                    // Create quick reply and send message
                    $quick_reply_message_builder = new QuickReplyMessageBuilder($quick_reply_buttons);
                    $text_message_builder = new TextMessageBuilder('???????????????????????????????????????', $quick_reply_message_builder); #(text bubble, quick reply)
                    $bot->replyMessage($reply_token, $text_message_builder);
                } else {
                    // LINE process to send
                    $response = $bot->replyText($reply_token, $message_data);
                }

                // Succeeded
                if ($response->isSucceeded()) {
                    Log::info('LOG: the message is sent');
                    break;
                }
                // Failed
                Log::error($response->getRawBody());
                break;

                // Added as new friend or unblocked
            case 'follow':
                // get the token needed to reply
                $reply_token = $inputs['events'][0]['replyToken'];

                // The message to send
                $message_data = "???????????????";

                // LINE process to send
                $response = $bot->replyText($reply_token, $message_data);

                // link LINE user ID with rich menu ID
                $response = $bot->linkRichMenu($userId, $account->richmenu_id);

                // ?????????????????????ID????????????????????????????????????????????????????????????????????????????????????????????????
                LineUser::updateOrCreate(['line_id' => $userId]);
                Log::info("New user added user_id = " . $userId);
                break;

                // Enter chat room
            case 'join':
                Log::info("????????????????????????????????????????????????????????????");
                break;

                // Leave chat room
            case 'leave':
                Log::info("?????????????????????????????????????????????????????????????????????");
                break;

                // Block or unfollow
            case 'unfollow':
                $bot->unlinkRichMenu($userId);
                LineUser::where('line_id', $userId)->delete();
                Log::info("?????????????????????????????????????????????");
                break;

            default:
                Log::info("the type is `" . $message_type . "`");
                break;
        }

        return;
    }




    // Send message
    public function sendMessage($aid)
    {
        // get account ID (aid) 
        $account = Account::where('id', $aid)->first();

        // get channel secret and access token
        $channel_secret = $account->channel_secret;
        $access_token = $account->access_token;

        // LINEBOTSDK?????????
        $http_client = new CurlHTTPClient($access_token);
        $bot = new LINEBot($http_client, ['channelSecret' => $channel_secret]);

        // Set user to send 
        $userId = "U6f9e0ed71f65c0f07c6915788713aa5c";

        // Set message to send
        $message = "???????????????!";

        // Send message
        $textMessageBuilder = new TextMessageBuilder($message);
        $response    = $bot->pushMessage($userId, $textMessageBuilder);

        // // Send to multiple people
        // $line_id_list = ["U6f9e0ed71f65c0f07c6915788713aa5c", "U6f9e0ed71f65c0f07c6915788713aa5c"];
        // $textMessageBuilder = new TextMessageBuilder('sending this msg to multiple people');
        // $response = $bot->multicast($line_id_list, $textMessageBuilder);

        // // Send multiple messages to one user
        // // confirm message
        // $confirmMessageBuilder = new TemplateMessageBuilder(
        //     'Confirm alt text',
        //     new ConfirmTemplateBuilder(
        //         'Do it?',
        //         [new MessageTemplateActionBuilder('Yes', 'Yes!'), new MessageTemplateActionBuilder('No', 'No!'),]
        //     )
        // );
        // // multi message
        // $multiMessageBuilder = new MultiMessageBuilder();
        // $multiMessageBuilder->add($textMessageBuilder);
        // $multiMessageBuilder->add($confirmMessageBuilder);
        // // send
        // $response    = $bot->pushMessage($userId, $multiMessageBuilder);

        // Logging error
        if ($response->isSucceeded()) {
            Log::info('Line send successful');
        } else {
            Log::error('Sending failed: ' . $response->getRawBody());
        }
    }




    public function richMenuCreate($aid, Request $request)
    {
        // get account ID (aid) 
        $account = Account::where('id', $aid)->first();

        // get from richmenu table 
        $richmenuSetting = RichmenuSetting::where('account_id', $aid)->first();

        // get channel secret and access token
        $channel_secret = $account->channel_secret;
        $access_token = $account->access_token;

        // https://developers.line.biz/en/reference/messaging-api/#create-rich-menu
        // LINEBOTSDK?????????
        $http_client = new CurlHTTPClient($access_token);
        $bot = new LINEBot($http_client, ['channelSecret' => $channel_secret]);

        // choosing richmenu 01,02,03
        switch ($request->input('richmenu-btn')) {
            case ('rich01'):

                // delete the old rich menu on LINE if exists in database
                if ($account->richmenu_id) {
                    $response = $bot->deleteRichMenu($account->richmenu_id);
                }

                // Create richmenu
                $richMenuBuilder = new RichMenuBuilder(
                    new RichMenuSizeBuilder(1686, 2500), #h,w
                    true, # show rich menu as default (false to hide rich menu) 
                    "Rich Menu 1", # name of rich menu
                    "??????????????????!", # Display text for rich menu
                    array( # array for actions on rich menu
                        new RichMenuAreaBuilder( # action 1
                            new RichMenuAreaBoundsBuilder(0, 0, 833, 843), # (x,y,width,height)
                            new MessageTemplateActionBuilder('m', '?????????????????????') # reply text
                        ),
                        new RichMenuAreaBuilder( # action 2
                            new RichMenuAreaBoundsBuilder(833, 0, 833, 843), # (x,y,width,height)
                            new MessageTemplateActionBuilder('m', '?????????????????????') # reply text
                        ),
                        new RichMenuAreaBuilder( # action 3
                            new RichMenuAreaBoundsBuilder(1666, 0, 833, 843), # (x,y,width,height)
                            new MessageTemplateActionBuilder('m', '?????????????????????') # reply text
                        ),
                        new RichMenuAreaBuilder( # action 4
                            new RichMenuAreaBoundsBuilder(0, 843, 833, 843), # (x,y,width,height)
                            new MessageTemplateActionBuilder('m', '????????????') # reply text
                        ),
                        new RichMenuAreaBuilder( # action 5
                            new RichMenuAreaBoundsBuilder(833, 843, 833, 843), # (x,y,width,height)
                            new MessageTemplateActionBuilder('m', '????????????') # reply text
                        ),
                        new RichMenuAreaBuilder( # action 6
                            new RichMenuAreaBoundsBuilder(1666, 843, 833, 843), # (x,y,width,height)
                            new UriTemplateActionBuilder('l', 'https://line.me/R/nv/recommendOA/' . $account->basic_id)
                        ),
                    )
                );
                $response = $bot->createRichMenu($richMenuBuilder);

                // check what is sent in POST for debug
                file_put_contents(base_path() . '/postdata.txt', var_export($response, true));

                // retrieve richmenu id
                $richMenuBody = $response->getRawBody();
                $richMenuId = json_decode($richMenuBody)->richMenuId;
                Log::info('the rich menu ID is `' . $richMenuId . '`');

                // upload pic for richmenu
                $imagePath = public_path() . '/images/rich-img-01.jpeg';
                $contentType = 'image/jpeg';
                $response = $bot->uploadRichMenuImage($richMenuId, $imagePath, $contentType);

                // apply richmenu to all users in this account
                $lineUsers = LineUser::where('account_id', $aid)->get();
                foreach ($lineUsers as $friend) {
                    $response = $bot->linkRichMenu($friend->line_id, $richMenuId);
                }

                // add richmenu ID to accounts table
                Account::where('id', $aid)
                    ->update([
                        'richmenu_id' => $richMenuId,
                    ]);

                // Succeeded
                if ($response->isSucceeded()) {
                    Log::info('Richmenu uploaded');
                } else {
                    // Failed
                    Log::error($response->getRawBody());
                }
                break;

            case ('rich02'):
                // delete the old rich menu on LINE if exists in database
                if ($account->richmenu_id) {
                    $response = $bot->deleteRichMenu($account->richmenu_id);
                }

                // Create richmenu
                $richMenuBuilder = new RichMenuBuilder(
                    new RichMenuSizeBuilder(1686, 2500), #h,w
                    true, # show rich menu as default (false to hide rich menu) 
                    "Rich Menu 2", # name of rich menu
                    "??????????????????!", # Display text for rich menu
                    array( # array for actions on rich menu
                        new RichMenuAreaBuilder( # action 1
                            new RichMenuAreaBoundsBuilder(0, 0, 833, 843), # (x,y,width,height)
                            new MessageTemplateActionBuilder('m', '?????????????????????') # reply text
                        ),
                        new RichMenuAreaBuilder( # action 2
                            new RichMenuAreaBoundsBuilder(833, 0, 833, 843), # (x,y,width,height)
                            new MessageTemplateActionBuilder('m', '????????????') # reply text
                        ),
                        new RichMenuAreaBuilder( # action 3
                            new RichMenuAreaBoundsBuilder(1666, 0, 833, 843), # (x,y,width,height)
                            new MessageTemplateActionBuilder('m', '????????????') # reply text
                        ),
                        new RichMenuAreaBuilder( # action 4
                            new RichMenuAreaBoundsBuilder(0, 843, 833, 843), # (x,y,width,height)
                            new MessageTemplateActionBuilder('m', '?????????????????????') # reply text
                        ),
                        new RichMenuAreaBuilder( # action 5
                            new RichMenuAreaBoundsBuilder(833, 843, 833, 843), # (x,y,width,height)
                            new UriTemplateActionBuilder('l', 'https://line.me/R/nv/recommendOA/' . $account->basic_id)
                        ),
                        new RichMenuAreaBuilder( # action 6
                            new RichMenuAreaBoundsBuilder(1666, 843, 833, 843), # (x,y,width,height)
                            new MessageTemplateActionBuilder('m', $richmenuSetting->nameA)
                        ),
                    )
                );
                $response = $bot->createRichMenu($richMenuBuilder);

                // check what is sent in POST for debug
                file_put_contents(base_path() . '/postdata.txt', var_export($response, true));

                // retrieve richmenu id
                $richMenuBody = $response->getRawBody();
                $richMenuId = json_decode($richMenuBody)->richMenuId;
                Log::info('the rich menu ID is `' . $richMenuId . '`');

                // upload pic for richmenu
                $imagePath = public_path() . '/images/rich-img-02.jpeg';
                $contentType = 'image/jpeg';
                $response = $bot->uploadRichMenuImage($richMenuId, $imagePath, $contentType);

                // apply richmenu to all users in this account
                $lineUsers = LineUser::where('account_id', $aid)->get();
                foreach ($lineUsers as $friend) {
                    $response = $bot->linkRichMenu($friend->line_id, $richMenuId);
                }

                // add richmenu ID to accounts table
                Account::where('id', $aid)
                    ->update([
                        'richmenu_id' => $richMenuId,
                    ]);

                // Succeeded
                if ($response->isSucceeded()) {
                    Log::info('Richmenu uploaded');
                } else {
                    // Failed
                    Log::error($response->getRawBody());
                }
                break;

            case ('rich03'):
                // delete the old rich menu on LINE if exists in database
                if ($account->richmenu_id) {
                    $response = $bot->deleteRichMenu($account->richmenu_id);
                }

                // Create richmenu
                $richMenuBuilder = new RichMenuBuilder(
                    new RichMenuSizeBuilder(1686, 2500), #h,w
                    true, # show rich menu as default (false to hide rich menu) 
                    "Rich Menu 3", # name of rich menu
                    "??????????????????!", # Display text for rich menu
                    array( # array for actions on rich menu
                        new RichMenuAreaBuilder( # action 1
                            new RichMenuAreaBoundsBuilder(0, 0, 833, 843), # (x,y,width,height)
                            new MessageTemplateActionBuilder('m', '?????????????????????') # reply text
                        ),
                        new RichMenuAreaBuilder( # action 2
                            new RichMenuAreaBoundsBuilder(833, 0, 833, 843), # (x,y,width,height)
                            new MessageTemplateActionBuilder('m', '?????????????????????') # reply text
                        ),
                        new RichMenuAreaBuilder( # action 3
                            new RichMenuAreaBoundsBuilder(1666, 0, 833, 843), # (x,y,width,height)
                            new MessageTemplateActionBuilder('m', '????????????') # reply text
                        ),
                        new RichMenuAreaBuilder( # action 4
                            new RichMenuAreaBoundsBuilder(0, 843, 833, 843), # (x,y,width,height)
                            new MessageTemplateActionBuilder('m', '????????????') # reply text
                        ),
                        new RichMenuAreaBuilder( # action 5
                            new RichMenuAreaBoundsBuilder(833, 843, 833, 843), # (x,y,width,height)
                            new UriTemplateActionBuilder('l', 'https://line.me/R/nv/recommendOA/' . $account->basic_id)
                        ),
                        new RichMenuAreaBuilder( # action 6
                            new RichMenuAreaBoundsBuilder(1666, 843, 833, 843), # (x,y,width,height)
                            new MessageTemplateActionBuilder('m', $richmenuSetting->nameA)
                        ),
                    )
                );
                $response = $bot->createRichMenu($richMenuBuilder);

                // check what is sent in POST for debug
                file_put_contents(base_path() . '/postdata.txt', var_export($response, true));

                // retrieve richmenu id
                $richMenuBody = $response->getRawBody();
                $richMenuId = json_decode($richMenuBody)->richMenuId;
                Log::info('the rich menu ID is `' . $richMenuId . '`');

                // upload pic for richmenu
                $imagePath = public_path() . '/images/rich-img-03.jpeg';
                $contentType = 'image/jpeg';
                $response = $bot->uploadRichMenuImage($richMenuId, $imagePath, $contentType);

                // apply richmenu to all users in this account
                $lineUsers = LineUser::where('account_id', $aid)->get();
                foreach ($lineUsers as $friend) {
                    $response = $bot->linkRichMenu($friend->line_id, $richMenuId);
                }

                // add richmenu ID to accounts table
                Account::where('id', $aid)
                    ->update([
                        'richmenu_id' => $richMenuId,
                    ]);

                // Succeeded
                if ($response->isSucceeded()) {
                    Log::info('Richmenu uploaded');
                } else {
                    // Failed
                    Log::error($response->getRawBody());
                }
                break;
            default:
        }

        // session 'title' with 'message'
        Session::put('title', '?????????????????????????????????');

        return redirect('/accounts' . '/' . $aid . '/richmenu')->with('message', '????????????????????????????????????????????????');
    }




    public function richMenuDelete($aid)
    {
        // get account ID (aid) 
        $account = Account::where('id', $aid)->first();

        // get channel secret and access token
        $channel_secret = $account->channel_secret;
        $access_token = $account->access_token;

        // LINEBOTSDK?????????
        $http_client = new CurlHTTPClient($access_token);
        $bot = new LINEBot($http_client, ['channelSecret' => $channel_secret]);

        // // Get rich menu ID from user
        // $response = $bot->getRichMenuId('U6f9e0ed71f65c0f07c6915788713aa5c');

        // // retrieve richmenu id
        // $richMenuBody = $response->getRawBody();
        // $richMenuId = json_decode($richMenuBody)->richMenuId;

        // Use below to delete specific richmenu
        $richMenuId = 'richmenu-03af3696d527d95b71a654f9174f6470';
        Log::info('DELETE: the deleted rich menu ID is `' . $richMenuId . '`');
        // delete the specific richmenu
        $response = $bot->deleteRichMenu($richMenuId);

        // delete the rich menu
        $response = $bot->deleteRichMenu($account->richmenu_id);
    }
}
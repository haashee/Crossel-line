<?php

namespace App\Http\Controllers;

use App\Models\LineUser;
use LINE\LINEBot\HTTPClient\CurlHTTPClient;
use LINE\LINEBot;
use App\Models\User;

use LINE\LINEBot\MessageBuilder\TextMessageBuilder;
use LINE\LINEBot\MessageBuilder\StickerMessageBuilder;
use LINE\LINEBot\MessageBuilder\LocationMessageBuilder;
use LINE\LINEBot\MessageBuilder\TemplateMessageBuilder;
use LINE\LINEBot\MessageBuilder\TemplateBuilder\ConfirmTemplateBuilder;
use LINE\LINEBot\TemplateActionBuilder\MessageTemplateActionBuilder;
use LINE\LINEBot\TemplateActionBuilder\UriTemplateActionBuilder;
use LINE\LINEBot\MessageBuilder\TemplateBuilder\CarouselColumnTemplateBuilder;
use LINE\LINEBot\MessageBuilder\TemplateBuilder\CarouselTemplateBuilder;

use LINE\LINEBot\RichMenuBuilder\RichMenuAreaBuilder;
use LINE\LINEBot\RichMenuBuilder\RichMenuSizeBuilder;
use LINE\LINEBot\RichMenuBuilder\RichMenuAreaBoundsBuilder;
use LINE\LINEBot\TemplateActionBuilder\PostbackTemplateActionBuilder;
use LINE\LINEBot\RichMenuBuilder;

use Log;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use \LINE\LINEBot\Constant\HTTPHeader;



class LineMessengerController extends Controller
{
    public function webhook(Request $request)
    {
        // LINEから送られた内容を$inputsに代入
        $inputs = $request->all();

        // そこからtypeをとりだし、$message_typeに代入
        $message_type = $inputs['events'][0]['type'];
        Log::info("LOG: message type is `" . $message_type . "`");

        // LINEBOTSDKの設定
        $http_client = new CurlHTTPClient(config('services.line.channel_token'));
        $bot = new LINEBot($http_client, ['channelSecret' => config('services.line.messenger_secret')]);

        // LINEのユーザーIDをuserIdに代入
        $userId = $request['events'][0]['source']['userId'];

        // userIdがあるユーザーを検索
        $user = LineUser::where('line_id', $userId)->first();

        // もし見つからない場合は、データベースに保存
        if ($user == NULL) {
            $profile = $bot->getProfile($userId)->getJSONDecodedBody();
            $mode = $inputs['events'][0]['mode'];
            // $id = Auth::user()->id;

            $user = new LineUser();
            // $user->user_id = '4'; 
            $user->name = $profile['displayName'];
            $user->line_id = $userId;
            $user->provider = 'line';
            $user->mode = $mode;
            $user->save();
        }

        $channelAccessToken = config('services.line.channel_token');

        function createNewRichmenu($channelAccessToken)
        {
            $sh = <<< EOF
            curl -X POST \
            -H 'Authorization: Bearer $channelAccessToken' \
            -H 'Content-Type:application/json' \
            -d '{"size": {"width": 2500,"height": 1686},"selected": false,"name": "Controller","chatBarText": "Controller","areas": [{"bounds": {"x": 551,"y": 325,"width": 321,"height": 321},"action": {"type": "message","text": "up"}},{"bounds": {"x": 876,"y": 651,"width": 321,"height": 321},"action": {"type": "message","text": "right"}},{"bounds": {"x": 551,"y": 972,"width": 321,"height": 321},"action": {"type": "message","text": "down"}},{"bounds": {"x": 225,"y": 651,"width": 321,"height": 321},"action": {"type": "message","text": "left"}},{"bounds": {"x": 1433,"y": 657,"width": 367,"height": 367},"action": {"type": "message","text": "btn b"}},{"bounds": {"x": 1907,"y": 657,"width": 367,"height": 367},"action": {"type": "message","text": "btn a"}}]}' https://api.line.me/v2/bot/richmenu;
            EOF;
            $result = json_decode(shell_exec(str_replace('\\', '', str_replace(PHP_EOL, '', $sh))), true);
            if (isset($result['richMenuId'])) {
                return $result['richMenuId'];
            } else {
                return $result['message'];
            }
        }
        createNewRichmenu(getenv('CHANNEL_ACCESS_TOKEN'));

        $richMenuSizeBuilder = new RichMenuSizeBuilder(1686, 2500); #h,w
        $richMenuAreaBoundsBuilder = new RichMenuAreaBoundsBuilder(0, 0, 2500, 1686); #w,h
        $postbackTemplateActionBuilder = new PostbackTemplateActionBuilder("Test", "i=1");
        $richMenuAreaBuilder = new RichMenuAreaBuilder($richMenuAreaBoundsBuilder, $postbackTemplateActionBuilder);
        $richMenuBuilder = new RichMenuBuilder($richMenuSizeBuilder, false, "Nice richmenu", "Tap here", $richMenuAreaBuilder);
        $response = $bot->createRichMenu($richMenuBuilder);

        // check what is sent in POST for debug
        file_put_contents('/tmp/postdata.txt', var_export($richMenuBuilder, true));

        // delete the rich menu
        // $response = $bot->deleteRichMenu('richmenu-b1f66f6d9c93859b2d5673a383075e6d');


        // タイプごとに分岐
        switch ($message_type) {

                // メッセージ受信
            case 'message':

                // get the token needed to reply
                $reply_token = $inputs['events'][0]['replyToken'];

                // get message content that was sent to you
                $message_content = $inputs['events'][0]['message']['text'];

                // The message to send
                $message_data = "メッセージありがとうございます。ただいま準備中です";

                // if message content is `確認`
                if ($message_content == '確認') {
                    $message_data = $reply_token . 'ご確認ありがとうございます';
                }

                // LINE process to send
                // $response = $bot->replyText($reply_token, $message_data);

                if ($message_content == 'Stamp') {
                    $response = $bot->replyMessage($reply_token, new StickerMessageBuilder('1', '2'));
                } elseif ($message_content == 'Location') {
                    $response = $bot->replyMessage($reply_token, new LocationMessageBuilder("位置情報", "チトワンソウラハ村", 27.576718, 84.493928));
                } elseif ($message_content == 'Confirm') {
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
                } elseif ($message_content == 'Carousel') {
                    //カルーセル型メッセージ送信
                    $columns = []; // カルーセル型カラムを3つ追加する配列
                    for ($i = 0; $i < 3; $i++) {
                        // カルーセルに付与するボタンを作る
                        $action = new UriTemplateActionBuilder("クリックしてね", "http://hiroasake.blogspot.com/");
                        // カルーセルのカラムを作成する
                        $column = new CarouselColumnTemplateBuilder("タイトル(40文字以内)", "ブログです", 'https://57c57cef.ngrok.io/linebot/image/PICT0065.JPG', [$action]);
                        $columns[] = $column;
                    }
                    // カラムの配列を組み合わせてカルーセルを作成する
                    $carousel = new CarouselTemplateBuilder($columns);
                    // カルーセルを追加してメッセージを作る
                    $carousel_message = new TemplateMessageBuilder("メッセージのタイトル", $carousel);
                    $response = $bot->replyMessage($reply_token, $carousel_message);
                } else {
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

                // 友だち追加 or ブロック解除
            case 'follow':

                // ユーザー固有のIDを取得
                $mid = $request['events'][0]['source']['userId'];

                // get the token needed to reply
                $reply_token = $inputs['events'][0]['replyToken'];

                // The message to send
                $message_data = "初めまして";

                // LINE process to send
                $response = $bot->replyText($reply_token, $message_data);

                // ユーザー固有のIDはどこかに保存しておいてください。メッセージ送信の際に必要です。
                LineUser::updateOrCreate(['line_id' => $mid]);
                Log::info("New user added user_id = " . $mid);
                break;

                // グループ・トークルーム参加
            case 'join':
                Log::info("グループ・トークルームに追加されました。");
                break;

                // グループ・トークルーム退出
            case 'leave':
                Log::info("グループ・トークルームから退出させられました。");
                break;

                // ブロック
            case 'unfollow':
                Log::info("ユーザーにブロックされました。");
                break;

            default:
                Log::info("the type is `" . $message_type . "`");
                break;
        }

        return;
    }



    // メッセージ送信用
    public function sendMessage()
    {
        // LINEBOTSDKの設定
        $http_client = new CurlHTTPClient(config('services.line.channel_token'));
        $bot = new LINEBot($http_client, ['channelSecret' => config('services.line.messenger_secret')]);

        // LINEユーザーID指定
        $userId = "U6f9e0ed71f65c0f07c6915788713aa5c";

        // メッセージ設定
        $message = "こんにちは!";

        // メッセージ送信
        $textMessageBuilder = new TextMessageBuilder($message);
        $response    = $bot->pushMessage($userId, $textMessageBuilder);

        // 配信成功・失敗
        if ($response->isSucceeded()) {
            Log::info('Line 送信完了');
        } else {
            Log::error('投稿失敗: ' . $response->getRawBody());
        }
    }
}
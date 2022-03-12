<?php

namespace App\Http\Controllers;

use App\Models\RichMenu;
use App\Models\Account;
use App\Models\LineUser;
use App\Models\RichmenuSetting;
use App\Models\Tag;

use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\File;

use LINE\LINEBot\HTTPClient\CurlHTTPClient;
use LINE\LINEBot;
use LINE\LINEBot\RichMenuBuilder\RichMenuAreaBuilder;
use LINE\LINEBot\RichMenuBuilder\RichMenuSizeBuilder;
use LINE\LINEBot\RichMenuBuilder\RichMenuAreaBoundsBuilder;
use LINE\LINEBot\TemplateActionBuilder\PostbackTemplateActionBuilder;
use LINE\LINEBot\RichMenuBuilder;
use LINE\LINEBot\TemplateActionBuilder\MessageTemplateActionBuilder;
use LINE\LINEBot\TemplateActionBuilder\UriTemplateActionBuilder;
use LINE\LINEBot\MessageBuilder\TemplateMessageBuilder;
use LINE\LINEBot\MessageBuilder\TextMessageBuilder;

use Illuminate\Support\Facades\Http;
use Illuminate\Http\Request;
use Log;



class RichMenuController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index($aid)
    {
        $account = Account::where('id', $aid)->first();
        $richmenus = RichMenu::where('account_id', $aid)->get();

        return view('dashboard.richmenu.index', [
            'account' => $account,
            'richmenus' => $richmenus,
        ]);
    }



    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create($aid)
    {
        $account = Account::where('id', $aid)->first();

        $richmenuSetting = RichmenuSetting::where('account_id', $aid)->first();


        return view('dashboard.richmenu.create', [
            'account' => $account,
            'richmenuSetting' => $richmenuSetting,
        ]);
    }



    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request, $aid)
    {
        if ($request->input('richmenu_size') == 'big') {

            $height = 1686;

            $request->validate([
                'name' => 'required',
                'label' => 'required',
                'richmenu_size' => 'required',
                'image' => 'required|mimes:png,jpg,jpeg|max:1024|dimensions:width=2500,height=1686',
                'urlA' => 'nullable|regex:/^(https?:\/\/)?([\da-z\.-]+)\.([a-z\.]{2,6})([\/\w \.-]*)*\/?$/',
                'urlB' => 'nullable|regex:/^(https?:\/\/)?([\da-z\.-]+)\.([a-z\.]{2,6})([\/\w \.-]*)*\/?$/',
                'urlC' => 'nullable|regex:/^(https?:\/\/)?([\da-z\.-]+)\.([a-z\.]{2,6})([\/\w \.-]*)*\/?$/',
                'urlD' => 'nullable|regex:/^(https?:\/\/)?([\da-z\.-]+)\.([a-z\.]{2,6})([\/\w \.-]*)*\/?$/',
                'urlE' => 'nullable|regex:/^(https?:\/\/)?([\da-z\.-]+)\.([a-z\.]{2,6})([\/\w \.-]*)*\/?$/',
                'urlF' => 'nullable|regex:/^(https?:\/\/)?([\da-z\.-]+)\.([a-z\.]{2,6})([\/\w \.-]*)*\/?$/',
            ]);
        } elseif ($request->input('richmenu_size') == 'small') {

            $height = 843;

            $request->validate([
                'name' => 'required',
                'label' => 'required',
                'richmenu_size' => 'required',
                'image' => 'required|mimes:png,jpg,jpeg|max:1024|dimensions:width=2500,height=843',
                'urlA' => 'nullable|regex:/^(https?:\/\/)?([\da-z\.-]+)\.([a-z\.]{2,6})([\/\w \.-]*)*\/?$/',
                'urlB' => 'nullable|regex:/^(https?:\/\/)?([\da-z\.-]+)\.([a-z\.]{2,6})([\/\w \.-]*)*\/?$/',
                'urlC' => 'nullable|regex:/^(https?:\/\/)?([\da-z\.-]+)\.([a-z\.]{2,6})([\/\w \.-]*)*\/?$/',
                'urlD' => 'nullable|regex:/^(https?:\/\/)?([\da-z\.-]+)\.([a-z\.]{2,6})([\/\w \.-]*)*\/?$/',
                'urlE' => 'nullable|regex:/^(https?:\/\/)?([\da-z\.-]+)\.([a-z\.]{2,6})([\/\w \.-]*)*\/?$/',
                'urlF' => 'nullable|regex:/^(https?:\/\/)?([\da-z\.-]+)\.([a-z\.]{2,6})([\/\w \.-]*)*\/?$/',
            ]);
        }

        $newImageName = 'richmenu' . '-' . $aid . '-' . uniqid() . '.' . $request->image->clientExtension();
        $request->image->move(public_path('uploads/richmenu'), $newImageName);

        RichMenu::create([
            'name' => $request->input('name'),
            'display_text' => $request->input('label'),
            'width' => '2500',
            'height' => $height,
            'image' => $newImageName,
            'text_a' => $request->input('buttonsA'),
            'text_b' => $request->input('buttonsB'),
            'text_c' => $request->input('buttonsC'),
            'text_d' => $request->input('buttonsD'),
            'text_e' => $request->input('buttonsE'),
            'text_f' => $request->input('buttonsF'),
            'url_a' => $request->input('urlA'),
            'url_b' => $request->input('urlB'),
            'url_c' => $request->input('urlC'),
            'url_d' => $request->input('urlD'),
            'url_e' => $request->input('urlE'),
            'url_f' => $request->input('urlF'),
            'multi_a' => $request->input('multiA'),
            'multi_b' => $request->input('multiB'),
            'multi_c' => $request->input('multiC'),
            'multi_d' => $request->input('multiD'),
            'multi_e' => $request->input('multiE'),
            'multi_f' => $request->input('multiF'),
            'account_id' => $aid,
        ]);


        Session::put('title', 'リッチメニュー作成完了');

        return redirect('accounts' . '/' . $aid . '/' . 'richmenu')
            ->with('message', 'リッチメニューが無事作成されました。使用するにはデフォルトとして設定してください。');
    }



    /**
     * Display the specified resource.
     *
     * @param  \App\Models\RichMenu  $richMenu
     * @return \Illuminate\Http\Response
     */
    public function show(RichMenu $richMenu)
    {
        //
    }



    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\RichMenu  $richMenu
     * @return \Illuminate\Http\Response
     */
    public function edit(RichMenu $richMenu, $aid, $id)
    {
        $account = Account::where('id', $aid)->first();
        $richmenu = RichMenu::where('id', $id)->first();
        $richmenus = RichMenu::where('account_id', $aid)->get();
        $richmenuSetting = RichmenuSetting::where('account_id', $aid)->first();


        return view('dashboard.richmenu.edit', [
            'account' => $account,
            'richmenu' => $richmenu,
            'richmenus' => $richmenus,
            'richmenuSetting' => $richmenuSetting,
        ]);
    }



    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\RichMenu  $richMenu
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, RichMenu $richMenu, $aid, $id)
    {
        if ($request->input('richmenu_size') == 'big') {

            $height = 1686;

            $request->validate([
                'name' => 'required',
                'label' => 'required',
                'richmenu_size' => 'required',
                'image' => 'mimes:png,jpg,jpeg|max:1024|dimensions:width=2500,height=1686',
                'urlA' => 'nullable|regex:/^(https?:\/\/)?([\da-z\.-]+)\.([a-z\.]{2,6})([\/\w \.@-]*)*\/?$/',
                'urlB' => 'nullable|regex:/^(https?:\/\/)?([\da-z\.-]+)\.([a-z\.]{2,6})([\/\w \.@-]*)*\/?$/',
                'urlC' => 'nullable|regex:/^(https?:\/\/)?([\da-z\.-]+)\.([a-z\.]{2,6})([\/\w \.@-]*)*\/?$/',
                'urlD' => 'nullable|regex:/^(https?:\/\/)?([\da-z\.-]+)\.([a-z\.]{2,6})([\/\w \.@-]*)*\/?$/',
                'urlE' => 'nullable|regex:/^(https?:\/\/)?([\da-z\.-]+)\.([a-z\.]{2,6})([\/\w \.@-]*)*\/?$/',
                'urlF' => 'nullable|regex:/^(https?:\/\/)?([\da-z\.-]+)\.([a-z\.]{2,6})([\/\w \.@-]*)*\/?$/',
            ]);
        } elseif ($request->input('richmenu_size') == 'small') {

            $height = 843;

            $request->validate([
                'name' => 'required',
                'label' => 'required',
                'richmenu_size' => 'required',
                'image' => 'mimes:png,jpg,jpeg|max:1024|dimensions:width=2500,height=843',
                'urlA' => 'nullable|regex:/^(https?:\/\/)?([\da-z\.-]+)\.([a-z\.]{2,6})([\/\w \.@-]*)*\/?$/',
                'urlB' => 'nullable|regex:/^(https?:\/\/)?([\da-z\.-]+)\.([a-z\.]{2,6})([\/\w \.@-]*)*\/?$/',
                'urlC' => 'nullable|regex:/^(https?:\/\/)?([\da-z\.-]+)\.([a-z\.]{2,6})([\/\w \.@-]*)*\/?$/',
                'urlD' => 'nullable|regex:/^(https?:\/\/)?([\da-z\.-]+)\.([a-z\.]{2,6})([\/\w \.@-]*)*\/?$/',
                'urlE' => 'nullable|regex:/^(https?:\/\/)?([\da-z\.-]+)\.([a-z\.]{2,6})([\/\w \.@-]*)*\/?$/',
                'urlF' => 'nullable|regex:/^(https?:\/\/)?([\da-z\.-]+)\.([a-z\.]{2,6})([\/\w \.@-]*)*\/?$/',
            ]);
        }

        $account = Account::where('id', $aid)->first();
        $richmenu = RichMenu::where('id', $id)->first();
        $richmenus = RichMenu::where('account_id', $aid)->get();

        if ($request->hasFile('image')) {
            $image_file_path = public_path('uploads/richmenu/') . $richmenu->image; // get previous image from folder
            if ($richmenu->image != null && File::exists($image_file_path)) { // unlink or remove previous image from folder
                unlink($image_file_path);
            }
            $file = $request->file('image');
            $name = 'richmenu' . '-' . $aid . '-' . uniqid() . '.' . $request->image->extension();
            $file = $file->move(public_path('uploads/richmenu'), $name);
            $richmenu->image = $name;
            $richmenu->save();
        }

        RichMenu::where('id', $id)
            ->update([
                'name' => $request->input('name'),
                'display_text' => $request->input('label'),
                'width' => '2500',
                'height' => $height,
                'text_a' => $request->input('buttonsA'),
                'text_b' => $request->input('buttonsB'),
                'text_c' => $request->input('buttonsC'),
                'text_d' => $request->input('buttonsD'),
                'text_e' => $request->input('buttonsE'),
                'text_f' => $request->input('buttonsF'),
                'url_a' => $request->input('urlA'),
                'url_b' => $request->input('urlB'),
                'url_c' => $request->input('urlC'),
                'url_d' => $request->input('urlD'),
                'url_e' => $request->input('urlE'),
                'url_f' => $request->input('urlF'),
            ]);

        Session::put('title', 'リッチメニュー更新完了');

        return redirect('accounts' . '/' . $aid . '/' . 'richmenu')
            ->with('message', 'リッチメニューが無事更新されました。使用するにはデフォルトとして設定してください。');
    }



    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\RichMenu  $richMenu
     * @return \Illuminate\Http\Response
     */
    public function destroy(RichMenu $richMenu, $aid, $id)
    {
        $richmenu = RichMenu::where('id', $id)->first();
        $richmenu->delete();

        $file_path = public_path('uploads/richmenu/') . $richmenu->image;
        unlink($file_path);

        Session::put('title', 'リッチメニュー削除');

        return redirect('accounts' . '/' . $aid . '/' . 'richmenu')
            ->with('message', 'リッチメニューが正常に削除されました。');
    }





    public function richMenuDefault($aid, Request $request)
    {
        // get account ID (aid) 
        $account = Account::where('id', $aid)->first();

        // get from richmenu table 
        $richmenuSetting = RichmenuSetting::where('account_id', $aid)->first();

        // get channel secret and access token
        $channel_secret = $account->channel_secret;
        $access_token = $account->access_token;

        // https://developers.line.biz/en/reference/messaging-api/#create-rich-menu
        // LINEBOTSDKの設定
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
                    "ここをタップ!", # Display text for rich menu
                    array( # array for actions on rich menu
                        new RichMenuAreaBuilder( # action 1
                            new RichMenuAreaBoundsBuilder(0, 0, 833, 843), # (x,y,width,height)
                            new MessageTemplateActionBuilder('m', 'メニューをみる') # reply text
                        ),
                        new RichMenuAreaBuilder( # action 2
                            new RichMenuAreaBoundsBuilder(833, 0, 833, 843), # (x,y,width,height)
                            new MessageTemplateActionBuilder('m', 'メニューをみる') # reply text
                        ),
                        new RichMenuAreaBuilder( # action 3
                            new RichMenuAreaBoundsBuilder(1666, 0, 833, 843), # (x,y,width,height)
                            new MessageTemplateActionBuilder('m', 'メニューをみる') # reply text
                        ),
                        new RichMenuAreaBuilder( # action 4
                            new RichMenuAreaBoundsBuilder(0, 843, 833, 843), # (x,y,width,height)
                            new MessageTemplateActionBuilder('m', '注文履歴') # reply text
                        ),
                        new RichMenuAreaBuilder( # action 5
                            new RichMenuAreaBoundsBuilder(833, 843, 833, 843), # (x,y,width,height)
                            new MessageTemplateActionBuilder('m', '店舗情報') # reply text
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
                    "ここをタップ!", # Display text for rich menu
                    array( # array for actions on rich menu
                        new RichMenuAreaBuilder( # action 1
                            new RichMenuAreaBoundsBuilder(0, 0, 833, 843), # (x,y,width,height)
                            new MessageTemplateActionBuilder('m', 'メニューをみる') # reply text
                        ),
                        new RichMenuAreaBuilder( # action 2
                            new RichMenuAreaBoundsBuilder(833, 0, 833, 843), # (x,y,width,height)
                            new MessageTemplateActionBuilder('m', '注文履歴') # reply text
                        ),
                        new RichMenuAreaBuilder( # action 3
                            new RichMenuAreaBoundsBuilder(1666, 0, 833, 843), # (x,y,width,height)
                            new MessageTemplateActionBuilder('m', '店舗情報') # reply text
                        ),
                        new RichMenuAreaBuilder( # action 4
                            new RichMenuAreaBoundsBuilder(0, 843, 833, 843), # (x,y,width,height)
                            new MessageTemplateActionBuilder('m', 'メニューをみる') # reply text
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
                    "ここをタップ!", # Display text for rich menu
                    array( # array for actions on rich menu
                        new RichMenuAreaBuilder( # action 1
                            new RichMenuAreaBoundsBuilder(0, 0, 833, 843), # (x,y,width,height)
                            new MessageTemplateActionBuilder('m', 'メニューをみる') # reply text
                        ),
                        new RichMenuAreaBuilder( # action 2
                            new RichMenuAreaBoundsBuilder(833, 0, 833, 843), # (x,y,width,height)
                            new MessageTemplateActionBuilder('m', 'メニューをみる') # reply text
                        ),
                        new RichMenuAreaBuilder( # action 3
                            new RichMenuAreaBoundsBuilder(1666, 0, 833, 843), # (x,y,width,height)
                            new MessageTemplateActionBuilder('m', '会員情報') # reply text
                        ),
                        new RichMenuAreaBuilder( # action 4
                            new RichMenuAreaBoundsBuilder(0, 843, 833, 843), # (x,y,width,height)
                            new MessageTemplateActionBuilder('m', '注文履歴') # reply text
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
        Session::put('title', 'リッチメニュー適応成功');

        return redirect('/accounts' . '/' . $aid . '/richmenu')->with('message', 'リッチメニューが適応されました。');
    }




    public function richMenuApply($aid, $id, Request $request)
    {
        // get from account table
        $account = Account::where('id', $aid)->first();

        // get from richmenu table 
        $richmenu = RichMenu::where('id', $id)->first();

        // get channel secret and access token
        $channel_secret = $account->channel_secret;
        $access_token = $account->access_token;

        // https://developers.line.biz/en/reference/messaging-api/#create-rich-menu
        // LINEBOTSDKの設定
        $http_client = new CurlHTTPClient($access_token);
        $bot = new LINEBot($http_client, ['channelSecret' => $channel_secret]);

        // delete the old rich menu on LINE if exists in database
        if ($account->richmenu_id) {
            $response = $bot->deleteRichMenu($account->richmenu_id);
        }

        // remove default from existing richmenu
        RichMenu::where('id', $id)
            ->update([
                'default' => false,
            ]);

        // get basic_id of account from LINE 
        $profileInfo = Http::withToken($account->access_token)->get('https://api.line.me/v2/bot/info');
        $basicId = json_decode($profileInfo)->basicId;
        $account->basic_id = $basicId;
        $account->save();
        Log::info("LOG: the basicId of new account is `$basicId`");

        // isset($richmenu->url_a) ? new UriTemplateActionBuilder($richmenu->text_a, $richmenu->url_a) : new MessageTemplateActionBuilder('m', $richmenu->text_a)
        // ($richmenu->text_a == '友達に紹介') ? new UriTemplateActionBuilder($richmenu->text_a, 'https://line.me/R/nv/recommendOA/' . $account->basic_id) : new MessageTemplateActionBuilder('m', $richmenu->text_a)
        // ($richmenu->text_a == '友達に紹介') ? new UriTemplateActionBuilder($richmenu->text_a, 'https://line.me/R/nv/recommendOA/' . $account->basicId) : (isset($richmenu->url_a) ? new UriTemplateActionBuilder($richmenu->text_a, $richmenu->url_a) : new MessageTemplateActionBuilder('m', $richmenu->text_a))

        $richmenuSetting = RichmenuSetting::where('account_id', $aid)->first();

        if ($richmenu->text_a == 'マルチボタン') {
            $replyTextA = $richmenu->multi_a;
        } else {
            $replyTextA = $richmenu->text_a;
        }
        if ($richmenu->text_b == 'マルチボタン') {
            $replyTextB = $richmenu->multi_b;
        } else {
            $replyTextB = $richmenu->text_b;
        }
        if ($richmenu->text_c == 'マルチボタン') {
            $replyTextC = $richmenu->multi_c;
        } else {
            $replyTextC = $richmenu->text_c;
        }
        if ($richmenu->text_d == 'マルチボタン') {
            $replyTextD = $richmenu->multi_d;
        } else {
            $replyTextD = $richmenu->text_d;
        }
        if ($richmenu->text_e == 'マルチボタン') {
            $replyTextE = $richmenu->multi_e;
        } else {
            $replyTextE = $richmenu->text_e;
        }
        if ($richmenu->text_f == 'マルチボタン') {
            $replyTextF = $richmenu->multi_f;
        } else {
            $replyTextF = $richmenu->text_f;
        }

        // dd($replyTextC);

        // check if big richmenu or small richmenu
        if ($richmenu->height == 843) {
            // Create richmenu
            $richMenuBuilder = new RichMenuBuilder(
                new RichMenuSizeBuilder($richmenu->height, $richmenu->width), #h,w
                true, # show rich menu as default (false to hide rich menu) 
                $richmenu->name, # name of rich menu
                $richmenu->display_text, # Display text for rich menu
                array( # array for actions on rich menu
                    new RichMenuAreaBuilder( # action A
                        new RichMenuAreaBoundsBuilder(0, 0, 833, 843), # (x,y,width,height)
                        ($richmenu->text_a == '友達に紹介') ? new UriTemplateActionBuilder($richmenu->text_a, 'https://line.me/R/nv/recommendOA/' . $account->basic_id) : (isset($richmenu->url_a) ? new UriTemplateActionBuilder($richmenu->text_a, $richmenu->url_a) : new MessageTemplateActionBuilder('m', $replyTextA))
                    ),
                    new RichMenuAreaBuilder( # action B
                        new RichMenuAreaBoundsBuilder(833, 0, 833, 843), # (x,y,width,height)
                        ($richmenu->text_b == '友達に紹介') ? new UriTemplateActionBuilder($richmenu->text_b, 'https://line.me/R/nv/recommendOA/' . $account->basic_id) : (isset($richmenu->url_b) ? new UriTemplateActionBuilder($richmenu->text_b, $richmenu->url_b) : new MessageTemplateActionBuilder('m', $replyTextB))
                    ),
                    new RichMenuAreaBuilder( # action C
                        new RichMenuAreaBoundsBuilder(1666, 0, 833, 843), # (x,y,width,height)
                        ($richmenu->text_c == '友達に紹介') ? new UriTemplateActionBuilder($richmenu->text_c, 'https://line.me/R/nv/recommendOA/' . $account->basic_id) : (isset($richmenu->url_c) ? new UriTemplateActionBuilder($richmenu->text_c, $richmenu->url_c) : new MessageTemplateActionBuilder('m', $replyTextC))
                    ),
                )
            );
        } elseif ($richmenu->height == 1686) {
            // Create richmenu
            $richMenuBuilder = new RichMenuBuilder(
                new RichMenuSizeBuilder($richmenu->height, $richmenu->width), #h,w
                true, # show rich menu as default (false to hide rich menu) 
                $richmenu->name, # name of rich menu
                $richmenu->display_text, # Display text for rich menu
                array( # array for actions on rich menu
                    new RichMenuAreaBuilder( # action A
                        new RichMenuAreaBoundsBuilder(0, 0, 833, 843), # (x,y,width,height)
                        ($richmenu->text_a == '友達に紹介') ? new UriTemplateActionBuilder($richmenu->text_a, 'https://line.me/R/nv/recommendOA/' . $account->basic_id) : (isset($richmenu->url_a) ? new UriTemplateActionBuilder($richmenu->text_a, $richmenu->url_a) : new MessageTemplateActionBuilder('m', $replyTextA))
                    ),
                    new RichMenuAreaBuilder( # action B
                        new RichMenuAreaBoundsBuilder(833, 0, 833, 843), # (x,y,width,height)
                        ($richmenu->text_b == '友達に紹介') ? new UriTemplateActionBuilder($richmenu->text_b, 'https://line.me/R/nv/recommendOA/' . $account->basic_id) : (isset($richmenu->url_b) ? new UriTemplateActionBuilder($richmenu->text_b, $richmenu->url_b) : new MessageTemplateActionBuilder('m', $replyTextB))
                    ),
                    new RichMenuAreaBuilder( # action C
                        new RichMenuAreaBoundsBuilder(1666, 0, 833, 843), # (x,y,width,height)
                        ($richmenu->text_c == '友達に紹介') ? new UriTemplateActionBuilder($richmenu->text_c, 'https://line.me/R/nv/recommendOA/' . $account->basic_id) : (isset($richmenu->url_c) ? new UriTemplateActionBuilder($richmenu->text_c, $richmenu->url_c) : new MessageTemplateActionBuilder('m', $replyTextC))
                    ),
                    new RichMenuAreaBuilder( # action D
                        new RichMenuAreaBoundsBuilder(0, 843, 833, 843), # (x,y,width,height)
                        ($richmenu->text_d == '友達に紹介') ? new UriTemplateActionBuilder($richmenu->text_d, 'https://line.me/R/nv/recommendOA/' . $account->basic_id) : (isset($richmenu->url_d) ? new UriTemplateActionBuilder($richmenu->text_d, $richmenu->url_d) : new MessageTemplateActionBuilder('m', $replyTextD))
                    ),
                    new RichMenuAreaBuilder( # action E
                        new RichMenuAreaBoundsBuilder(833, 843, 833, 843), # (x,y,width,height)
                        ($richmenu->text_e == '友達に紹介') ? new UriTemplateActionBuilder($richmenu->text_e, 'https://line.me/R/nv/recommendOA/' . $account->basic_id) : (isset($richmenu->url_e) ? new UriTemplateActionBuilder($richmenu->text_e, $richmenu->url_e) : new MessageTemplateActionBuilder('m', $replyTextE))
                    ),
                    new RichMenuAreaBuilder( # action F
                        new RichMenuAreaBoundsBuilder(1666, 843, 833, 843), # (x,y,width,height)
                        ($richmenu->text_f == '友達に紹介') ? new UriTemplateActionBuilder($richmenu->text_f, 'https://line.me/R/nv/recommendOA/' . $account->basic_id) : (isset($richmenu->url_f) ? new UriTemplateActionBuilder($richmenu->text_f, $richmenu->url_f) : new MessageTemplateActionBuilder('m', $replyTextF))
                    ),
                )
            );
        }

        // Build from created rich menu
        $response = $bot->createRichMenu($richMenuBuilder);

        // check what is sent in POST for debug
        file_put_contents(base_path() . '/postdata.txt', var_export($response, true));

        // retrieve richmenu id
        $richMenuBody = $response->getRawBody();
        $richMenuId = json_decode($richMenuBody)->richMenuId;
        Log::info('the rich menu ID is `' . $richMenuId . '`');

        // save rich menu id in rich menu table and set default
        RichMenu::where('id', $id)
            ->update([
                'richmenu_id' => $richMenuId,
                'default' => true,
            ]);

        // upload pic for richmenu
        $imagePath = public_path() . '/uploads/richmenu/' . $richmenu->image;
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

        // session 'title' with 'message'
        Session::put('title', 'リッチメニュー適応成功');

        return redirect('/accounts' . '/' . $aid . '/richmenu')->with('message', 'リッチメニューが適応されました。');
    }




    /**
     * Display a multiBtn setting.
     *
     * @return \Illuminate\Http\Response
     */
    public function multiBtn($aid)
    {
        $accounts = Account::all();
        $account = Account::where('id', $aid)->first();
        $tags = Tag::where('account_id', $aid)->get();


        $richmenuSetting = RichmenuSetting::where('account_id', $aid)->first();




        return view('dashboard.richmenu.multibtn', [
            'accounts' => $accounts,
            'account' => $account,
            'tags' => $tags,
            'richmenuSetting' => $richmenuSetting,
        ]);
    }




    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $aid
     * @return \Illuminate\Http\Response
     */
    public function updateMulti(Request $request, $aid)
    {
        $request->validate([
            'multiBtn' => 'required',
            'message' => 'required',
            'name' => ['not_regex:/^(会員情報|メニューをみる|リンク|注文履歴|店舗情報|友達に紹介)$/i'],
        ]);

        $richmenuSetting = RichmenuSetting::where('account_id', $aid)->first();

        $newAction = $request->input('action');
        $assignBtn = $request->input('multiBtn');

        switch ($assignBtn) {
            case 'multiBtnA':
                $oldActions = $richmenuSetting->multiBtnA;
                if ($oldActions && $request->filled('action')) {
                    $updatedActionsA = $oldActions . ', ' . $newAction;
                } elseif ($oldActions) {
                    $updatedActionsA = $oldActions;
                } else {
                    $updatedActionsA = $newAction;
                }
                break;

            case 'multiBtnB':
                $oldActions = $richmenuSetting->multiBtnB;
                if ($oldActions && $request->filled('action')) {
                    $updatedActionsB = $oldActions . ', ' . $newAction;
                } elseif ($oldActions) {
                    $updatedActionsB = $oldActions;
                } else {
                    $updatedActionsB = $newAction;
                }
                break;

            case 'multiBtnC':
                $oldActions = $richmenuSetting->multiBtnC;
                if ($oldActions && $request->filled('action')) {
                    $updatedActionsC = $oldActions . ', ' . $newAction;
                } elseif ($oldActions) {
                    $updatedActionsC = $oldActions;
                } else {
                    $updatedActionsC = $newAction;
                }
                break;

            default:
                break;
        }

        $setting = RichmenuSetting::where('account_id', $aid)->first();

        if (isset($updatedActionsA)) {
            $setting->multiBtnA = $updatedActionsA;
        } elseif (isset($updatedActionsB)) {
            $setting->multiBtnB = $updatedActionsB;
        } elseif (isset($updatedActionsC)) {
            $setting->multiBtnC = $updatedActionsC;
        }

        if ($assignBtn == 'multiBtnA') {
            $setting->displayTextA = $request->input('message');
        } elseif ($assignBtn == 'multiBtnB') {
            $setting->displayTextB = $request->input('message');
        } elseif ($assignBtn == 'multiBtnC') {
            $setting->displayTextC = $request->input('message');
        }

        if ($assignBtn == 'multiBtnA') {
            $setting->nameA = $request->input('name');
        } elseif ($assignBtn == 'multiBtnB') {
            $setting->nameB = $request->input('name');
        } elseif ($assignBtn == 'multiBtnC') {
            $setting->nameC = $request->input('name');
        }

        $setting->save();

        Session::put('title', 'ボタン更新完了');

        return redirect('accounts' . '/' . $aid . '/' . 'multibtn')
            ->with('message', 'マルチボタンが変更されました。');
    }




    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $aid
     * @return \Illuminate\Http\Response
     */
    public function resetMulti(Request $request, $aid)
    {
        $setting = RichmenuSetting::where('account_id', $aid)->first();

        $resetBtn = $request->input('resetBtn');

        if ($resetBtn == 'multiBtnA') {
            $setting->multiBtnA = null;
        } elseif ($resetBtn == 'multiBtnB') {
            $setting->multiBtnB = null;
        } elseif ($resetBtn == 'multiBtnC') {
            $setting->multiBtnC = null;
        }

        $setting->save();

        Session::put('title', 'マルチボタンのリセット完了');

        return redirect('accounts' . '/' . $aid . '/' . 'multibtn')
            ->with('message', 'マルチボタンがが正常にリセットされました。');
    }
}
<?php

namespace App\Http\Controllers;

use App\Models\RichMenu;
use App\Models\Account;
use App\Models\LineUser;

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

        return view('dashboard.richmenu.create', [
            'account' => $account,
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
            ]);
        } elseif ($request->input('richmenu_size') == 'small') {

            $height = 843;

            $request->validate([
                'name' => 'required',
                'label' => 'required',
                'richmenu_size' => 'required',
                'image' => 'required|mimes:png,jpg,jpeg|max:1024|dimensions:width=2500,height=843',
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
            'account_id' => $aid,
        ]);


        Session::put('title', 'リッチメニュー作成完了');

        return redirect('accounts' . '/' . $aid . '/' . 'richmenu')
            ->with('message', 'リッチメニューが無事作成されました。');
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

        return view('dashboard.richmenu.edit', [
            'account' => $account,
            'richmenu' => $richmenu,
            'richmenus' => $richmenus,
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
            ]);
        } elseif ($request->input('richmenu_size') == 'small') {

            $height = 843;

            $request->validate([
                'name' => 'required',
                'label' => 'required',
                'richmenu_size' => 'required',
                'image' => 'mimes:png,jpg,jpeg|max:1024|dimensions:width=2500,height=843',
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
            ->with('message', 'リッチメニューが無事更新されました。');
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

        // Create richmenu
        $richMenuBuilder = new RichMenuBuilder(
            new RichMenuSizeBuilder($richmenu->height, $richmenu->width), #h,w
            true, # show rich menu as default (false to hide rich menu) 
            $richmenu->name, # name of rich menu
            $richmenu->display_text, # Display text for rich menu
            array( # array for actions on rich menu
                new RichMenuAreaBuilder( # action 1
                    new RichMenuAreaBoundsBuilder(0, 0, 833, 843), # (x,y,width,height)
                    new UriTemplateActionBuilder("クリックしてね", 'https://google.com/') # reply text
                    // new MessageTemplateActionBuilder('m', 'Text A') # reply text
                ),
                new RichMenuAreaBuilder( # action 2
                    new RichMenuAreaBoundsBuilder(833, 0, 833, 843), # (x,y,width,height)
                    new MessageTemplateActionBuilder('m', 'Text B') # reply text
                ),
                new RichMenuAreaBuilder( # action 3
                    new RichMenuAreaBoundsBuilder(1666, 0, 833, 843), # (x,y,width,height)
                    new MessageTemplateActionBuilder('m', 'Text C') # reply text
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
        // choosing richmenu 01,02,03
        switch ($request->input('richmenu-btn')) {
            case ('rich01'):

                // delete the old rich menu on LINE if exists in database
                if ($account->richmenu_id) {
                    $response = $bot->deleteRichMenu($account->richmenu_id);
                }

                // Create richmenu
                $richMenuBuilder = new RichMenuBuilder(
                    new RichMenuSizeBuilder(843, 2500), #h,w
                    true, # show rich menu as default (false to hide rich menu) 
                    "Rich Menu 1", # name of rich menu
                    "ここをタップ!", # Display text for rich menu
                    array( # array for actions on rich menu
                        new RichMenuAreaBuilder( # action 1
                            new RichMenuAreaBoundsBuilder(0, 0, 833, 843), # (x,y,width,height)
                            new UriTemplateActionBuilder("クリックしてね", 'https://google.com/') # reply text
                            // new MessageTemplateActionBuilder('m', 'Text A') # reply text
                        ),
                        new RichMenuAreaBuilder( # action 2
                            new RichMenuAreaBoundsBuilder(833, 0, 833, 843), # (x,y,width,height)
                            new MessageTemplateActionBuilder('m', 'Text B') # reply text
                        ),
                        new RichMenuAreaBuilder( # action 3
                            new RichMenuAreaBoundsBuilder(1666, 0, 833, 843), # (x,y,width,height)
                            new MessageTemplateActionBuilder('m', 'Text C') # reply text
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
                    new RichMenuSizeBuilder(843, 2500), #h,w
                    true, # show rich menu as default (false to hide rich menu) 
                    "Rich Menu 1", # name of rich menu
                    "ここをタップ!", # Display text for rich menu
                    array( # array for actions on rich menu
                        new RichMenuAreaBuilder( # action 1
                            new RichMenuAreaBoundsBuilder(0, 0, 833, 843), # (x,y,width,height)
                            new MessageTemplateActionBuilder('m', 'Text A') # reply text
                        ),
                        new RichMenuAreaBuilder( # action 2
                            new RichMenuAreaBoundsBuilder(833, 0, 833, 843), # (x,y,width,height)
                            new MessageTemplateActionBuilder('m', 'Text B') # reply text
                        ),
                        new RichMenuAreaBuilder( # action 3
                            new RichMenuAreaBoundsBuilder(1666, 0, 833, 843), # (x,y,width,height)
                            new MessageTemplateActionBuilder('m', 'Text C') # reply text
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
                    new RichMenuSizeBuilder(843, 2500), #h,w
                    true, # show rich menu as default (false to hide rich menu) 
                    "Rich Menu 1", # name of rich menu
                    "ここをタップ!", # Display text for rich menu
                    array( # array for actions on rich menu
                        new RichMenuAreaBuilder( # action 1
                            new RichMenuAreaBoundsBuilder(0, 0, 833, 843), # (x,y,width,height)
                            new MessageTemplateActionBuilder('m', 'Text A') # reply text
                        ),
                        new RichMenuAreaBuilder( # action 2
                            new RichMenuAreaBoundsBuilder(833, 0, 833, 843), # (x,y,width,height)
                            new MessageTemplateActionBuilder('m', 'Text B') # reply text
                        ),
                        new RichMenuAreaBuilder( # action 3
                            new RichMenuAreaBoundsBuilder(1666, 0, 833, 843), # (x,y,width,height)
                            new MessageTemplateActionBuilder('m', 'Text C') # reply text
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
}
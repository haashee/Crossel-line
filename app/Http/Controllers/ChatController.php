<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Account;
use App\Models\LineUser;
use App\Models\Chat;
use App\Models\ChatSetting;
use Illuminate\Support\Facades\Session;

use LINE\LINEBot\HTTPClient\CurlHTTPClient;
use LINE\LINEBot;
use LINE\LINEBot\MessageBuilder\TextMessageBuilder;
use Log;

class ChatController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index($aid)
    {
        $account = Account::where('id', $aid)->first();

        $friend = LineUser::where('account_id', $aid)->first();

        $chatAccount = $account->chats()->get();
        $chatList = $chatAccount->sortByDesc('created_at')->unique('lineuser_id');

        return view('dashboard.chat.index', [
            'friend' => $friend,
            'chatList' => $chatList,
            'account' => $account,
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request, $aid, $id)
    {
        // add richmenu ID to accounts table
        Chat::where('id', $aid)
            ->updateOrCreate([
                'senderName' => $request->sender_name,
                'receiverName' => $request->receiver_name,
                'message' => $request->message,
                'lineuser_id' => $id,
            ]);

        // get account ID (aid) 
        $account = Account::where('id', $aid)->first();

        // get channel secret and access token
        $channel_secret = $account->channel_secret;
        $access_token = $account->access_token;

        // LINEBOTSDKの設定
        $http_client = new CurlHTTPClient($access_token);
        $bot = new LINEBot($http_client, ['channelSecret' => $channel_secret]);

        // Set user to send 
        $user = LineUser::where('id', $id)->first();;
        $userId = $user->line_id;

        // Set message to send
        $message = $request->message;

        // Send message
        $textMessageBuilder = new TextMessageBuilder($message);
        $response    = $bot->pushMessage($userId, $textMessageBuilder);

        // Logging error
        if ($response->isSucceeded()) {
            Log::info('Line send successful');
        } else {
            Log::error('Sending failed: ' . $response->getRawBody());
        }

        return redirect('/accounts' . '/' . $aid . '/' . 'chat' . '/' . $id);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($aid, $id)
    {
        $account = Account::where('id', $aid)->first();

        $friend = LineUser::where('account_id', $aid)->first();

        $friendList = LineUser::where('account_id', $aid)->get();

        $chatAccount = $account->chats()->get();
        $chatList = $chatAccount->sortByDesc('created_at')->unique('lineuser_id')->take(15);

        $chats = Chat::where('lineuser_id', $id)->get();

        // // データーベースの件数を取得
        // $length = Chat::where('lineuser_id', $id)->count();
        // // 表示する件数を代入
        // $display = 5;
        // $chats = Chat::offset($length - $display)->limit($display)->get();


        return view('dashboard.chat.show', [
            'friend' => $friend,
            'friendlist' => $friendList,
            'account' => $account,
            'chats' => $chats,
            'chatList' => $chatList,
            // 'chat' => $chat,
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }


    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $aid
     * @return \Illuminate\Http\Response
     */
    public function chatList($aid)
    {
        $account = Account::where('id', $aid)->first();

        $friends = LineUser::where('account_id', $aid)->get();

        $chatAccount = $account->chats()->get();
        $chatList = $chatAccount->sortByDesc('created_at')->unique('lineuser_id');

        return view('dashboard.chat.list', [
            'friends' => $friends,
            'account' => $account,
            'chatList' => $chatList,

        ]);
    }


    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $aid
     * @return \Illuminate\Http\Response
     */
    public function setting($aid)
    {
        return view('dashboard.chat.edit')
            ->with('account', Account::where('id', $aid)->first());
    }


    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $aid
     * @return \Illuminate\Http\Response
     */
    public function settingUpdate(Request $request, $aid)
    {
        $request->validate([
            'welcome_text' => 'required',
            'default_text' => 'required',
        ]);

        if ($request->has('default_text_active')) {
            $defaultFlag = true;
        } else {
            $defaultFlag = false;
        }

        if ($request->has('welcome_text_active')) {
            $welcomeFlag = true;
        } else {
            $welcomeFlag = false;
        }

        if ($request->has('notify_email')) {
            $mailFlag = true;
        } else {
            $mailFlag = false;
        }

        ChatSetting::where('account_id', $aid)
            ->update([
                'welcome_text' => $request->input('welcome_text'),
                'default_text' => $request->input('default_text'),
                'welcome_text_active' => $welcomeFlag,
                'default_text_active' => $defaultFlag,
                'notify_email' => $mailFlag,
            ]);

        Session::put('title', 'チャット設定更新完了');

        return redirect('accounts/' . $aid . '/' . 'chat')
            ->with('message', 'チャット設定が更新されました。');
    }
}
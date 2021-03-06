<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Account;
use App\Models\LineUser;
use App\Models\Chat;
use App\Models\Template;
use App\Models\ChatSetting;
use App\Models\ReceivedMedia;
use App\Models\Tag;
use Illuminate\Support\Facades\Session;

use LINE\LINEBot\HTTPClient\CurlHTTPClient;
use LINE\LINEBot;
use LINE\LINEBot\MessageBuilder\TextMessageBuilder;
use Log;

class ChatController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }



    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index($aid)
    {
        $account = Account::where('id', $aid)->first();

        $friend = LineUser::where('account_id', $aid)->first();

        $templates = Template::where('account_id', $aid)->get();

        $chatAccount = $account->chats()->get();
        $chatList = $chatAccount->sortByDesc('created_at')->unique('lineuser_id');

        return view('dashboard.chat.index', [
            'friend' => $friend,
            'chatList' => $chatList,
            'account' => $account,
            'templates' => $templates,
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
        // 
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

        // LINEBOTSDK?????????
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

        $friend = LineUser::where('id', $id)->first();

        $friendList = LineUser::where('account_id', $aid)->get();

        $templates = Template::where('account_id', $aid)->get();

        $chatAccount = $account->chats()->get();
        $chatList = $chatAccount->sortByDesc('created_at')->unique('lineuser_id')->take(15);

        $chats = Chat::where('lineuser_id', $id)->get();

        // // ???????????????????????????????????????
        // $length = Chat::where('lineuser_id', $id)->count();
        // // ???????????????????????????
        // $display = 5;
        // $chats = Chat::offset($length - $display)->limit($display)->get();


        return view('dashboard.chat.show', [
            'friend' => $friend,
            'friendlist' => $friendList,
            'account' => $account,
            'templates' => $templates,
            'chats' => $chats,
            'chatList' => $chatList,
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
        return view('dashboard.chat.settings')
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

        Session::put('title', '??????????????????????????????');

        return redirect('accounts/' . $aid . '/' . 'chat')
            ->with('message', '?????????????????????????????????????????????');
    }



    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function sendMultiple(Request $request, $aid)
    {
        // add richmenu ID to accounts table
        Chat::where('id', $aid)
            ->updateOrCreate([
                'senderName' => $request->sender_name,
                'receiverName' => $request->receiver_name,
                'message' => $request->message,
                'lineuser_id' => null,
            ]);

        // get account ID (aid) 
        $account = Account::where('id', $aid)->first();

        // get channel secret and access token
        $channel_secret = $account->channel_secret;
        $access_token = $account->access_token;

        // LINEBOTSDK?????????
        $http_client = new CurlHTTPClient($access_token);
        $bot = new LINEBot($http_client, ['channelSecret' => $channel_secret]);

        // set line users to send
        $line_id_list = ["U6f9e0ed71f65c0f07c6915788713aa5c", "U94dee02c3d6a8f0329ca869578f397f9"];

        // Set message to send
        $message = $request->message;

        // Send to multiple people
        $textMessageBuilder = new TextMessageBuilder($message);
        $response = $bot->multicast($line_id_list, $textMessageBuilder);

        // Logging error
        if ($response->isSucceeded()) {
            Log::info('Line send successful');
        } else {
            Log::error('Sending failed: ' . $response->getRawBody());
        }

        return redirect('/accounts' . '/' . $aid . '/' . 'chat' . '/');
    }




    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function media($aid)
    {
        $account = Account::where('id', $aid)->first();
        $media = ReceivedMedia::where('account_id', $aid)->get()->sortByDesc('created_at');

        return view('dashboard.chat.media', [
            'account' => $account,
            'media' => $media,
        ]);
    }
}
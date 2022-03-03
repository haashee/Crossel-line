<?php

namespace App\Http\Controllers;

use App\Models\ChatMultiple;
use App\Models\Account;
use App\Models\Tag;
use App\Models\Template;
use App\Models\Chat;

use Illuminate\Support\Facades\Session;
use LINE\LINEBot\HTTPClient\CurlHTTPClient;
use LINE\LINEBot;
use LINE\LINEBot\MessageBuilder\TextMessageBuilder;
use Log;
use Illuminate\Http\Request;

class ChatMultipleController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index($aid)
    {
        $account = Account::where('id', $aid)->first();

        $tags = Tag::where('account_id', $aid)->get();

        $templates = Template::where('account_id', $aid)->get();

        $chatAccount = $account->chats()->get();
        $chatList = $chatAccount->sortByDesc('created_at')->unique('lineuser_id')->take(15);


        return view('dashboard.chatmultiple.index', [
            'account' => $account,
            'tags' => $tags,
            'templates' => $templates,
            'chatList' => $chatList,
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
    public function store(Request $request, $aid)
    {
        // store values
        // ChatMultiple::create([
        //     'message' => $request->message,
        //     // 'tag_id' => $request->tag,
        //     'account_id' => $aid,
        // ]);

        $data = [];
        $data['tags'] = $request->input('tags');

        $chat = new ChatMultiple();
        $chat->message = $request->message;
        $chat->account_id = $aid;
        $chat->save();
        $chat->tags()->attach($data['tags']);

        // get account ID (aid) 
        $account = Account::where('id', $aid)->first();

        // get channel secret and access token
        $channel_secret = $account->channel_secret;
        $access_token = $account->access_token;

        // LINEBOTSDKの設定
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

        return redirect('/accounts' . '/' . $aid . '/multiple');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($aid)
    {
        $account = Account::where('id', $aid)->first();
        $chats = ChatMultiple::where('account_id', $aid)->get();

        return view('dashboard.chatmultiple.show', [
            'account' => $account,
            'chats' => $chats,
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
}
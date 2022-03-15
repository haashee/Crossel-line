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

use LINE\LINEBot\MessageBuilder\ImageMessageBuilder;
use LINE\LINEBot\ImagemapActionBuilder\AreaBuilder;
use LINE\LINEBot\ImagemapActionBuilder\ImagemapUriActionBuilder;
use LINE\LINEBot\MessageBuilder\Imagemap\BaseSizeBuilder;
use LINE\LINEBot\MessageBuilder\ImagemapMessageBuilder;
use Illuminate\Support\Facades\Storage;


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
        if ($request->has('image')) {
            $request->validate([
                'message' => 'required',
                'tags' => 'required',
                'image' => 'mimes:jpg,png,jpeg|max:5048',
                'image_text' => 'required',
                'image_url' => 'required|regex:/^(https?:\/\/)?([\da-z\.-]+)\.([a-z\.]{2,6})([\/\w \.-]*)*\/?$/',
            ]);
        } else {
            $request->validate([
                'message' => 'required',
                'tags' => 'required',
            ]);
        }


        // isAfter checkbox
        if ($request->isAfter == 1) {
            $isAfterFlag = true;
        } else {
            $isAfterFlag = false;
        }

        // store values and image
        $chat = new ChatMultiple();
        $chat->message = $request->message;
        $chat->isAfter = $isAfterFlag;
        $chat->account_id = $aid;
        if ($request->hasFile('image')) {
            $path = $request->file('image')->storeAs('/public/sendmedia', $aid . '-' . uniqid() . '.jpg');
            $pathImg = str_replace('public/', '/', $path);
            $chat->image = $pathImg;
            $chat->image_text = $request->image_text;
            $chat->image_url = $request->image_url;
        }
        $chat->save();

        // set value for pivot table
        $data = [];
        $data['tags'] = $request->input('tags');
        $chat->tags()->attach($data['tags']);

        // set line users to send
        $id_array = [];
        foreach ($data['tags'] as $tag_id) {
            $tag = Tag::find($tag_id);
            foreach ($tag->lineUsers as $friend) {
                if ($friend->isBlackListed) {
                    Log::warning("The user " . $friend->name  . " was not added to send list");
                    break;
                } else {
                    $line_id = $friend->line_id;
                    if ($line_id[0] == "U") {
                        array_push($id_array, $line_id);
                    }
                }
            }
        }
        // $line_id_list = ["U6f9e0ed71f65c0f07c6915788713aa5c", "U94dee02c3d6a8f0329ca869578f397f9"];
        $line_id_list = array_unique($id_array);

        // get account ID (aid) 
        $account = Account::where('id', $aid)->first();

        // get channel secret and access token
        $channel_secret = $account->channel_secret;
        $access_token = $account->access_token;

        // LINEBOTSDKの設定
        $http_client = new CurlHTTPClient($access_token);
        $bot = new LINEBot($http_client, ['channelSecret' => $channel_secret]);

        // if there is image message
        if ($request->hasFile('image')) {
            // get uploaded image from storage 
            $filename = Storage::path('public' . $chat->image);

            // get the dimensions of the image
            $data = getimagesize($filename);
            $width = $data[0];
            $height = $data[1];

            // set the image as base for the image map message
            $pathImg = "storage" . $chat->image; // change starting of url from public/ to storage/
            $alt_text =  $chat->image_text; // alt text for displaying notification
            $base_url = 'https://6ee2-223-133-69-171.ngrok.io/' . $pathImg . '?_ignore='; // url of image
            $base_size = new BaseSizeBuilder($height, $width); // base image dimensions

            // set action area builder
            $x = 0;
            $y = 0;
            $area = new AreaBuilder($x, $y, $width, $height);
            $link_url = $chat->image_url;
            $image_map_actions = [new ImagemapUriActionBuilder($link_url, $area)];

            // build image map message
            $image_map_message = new ImagemapMessageBuilder(
                $base_url,
                $alt_text,
                $base_size,
                $image_map_actions
            );
        }

        // Set message to send
        $message = $request->message;

        // build text message 
        $textMessageBuilder = new TextMessageBuilder($message);

        // set the order to send (image first or text first)
        if ($isAfterFlag && $request->hasFile('image')) {
            $response = $bot->multicast($line_id_list, $textMessageBuilder);
            $response = $bot->multicast($line_id_list, $image_map_message);
        } elseif (!$isAfterFlag && $request->hasFile('image')) {
            $response = $bot->multicast($line_id_list, $image_map_message);
            $response = $bot->multicast($line_id_list, $textMessageBuilder);
        } else {
            $response = $bot->multicast($line_id_list, $textMessageBuilder);
        }

        // Logging error
        if ($response->isSucceeded()) {
            Log::info('Line multiple send successful');
        } else {
            Log::error('Sending failed: ' . $response->getRawBody());
        }

        Session::put('title', 'メッセージ送信完了');

        return redirect('/accounts' . '/' . $aid . '/multiple')
            ->with('message', 'メッセージが送信されました。');
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
        $chats = ChatMultiple::where('account_id', $aid)->get()->sortByDesc('created_at');

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
<?php

namespace App\Http\Controllers;

use LINE\LINEBot\HTTPClient\CurlHTTPClient;
use LINE\LINEBot;
use App\Models\User;
use LINE\LINEBot\MessageBuilder\TextMessageBuilder;

use Illuminate\Http\Request;

class LineMessengerController extends Controller
{
    public function webhook(Request $request)
    {
        // LINEから送られた内容を$inputsに代入
        $inputs = $request->all();

        // そこからtypeをとりだし、$message_typeに代入
        $message_type = $inputs['events'][0]['type'];

        // define message content
        $message_content = $inputs['events'][0]['message']['text'];

        // メッセージが送られた場合、$message_typeは'message'となる。その場合処理実行。
        if ($message_type == 'message') {

            // replyTokenを取得
            $reply_token = $inputs['events'][0]['replyToken'];

            // LINEBOTSDKの設定
            $http_client = new CurlHTTPClient(config('services.line.channel_token'));
            $bot = new LINEBot($http_client, ['channelSecret' => config('services.line.messenger_secret')]);

            // 送信するメッセージの設定
            $reply_message = $message_content . 'メッセージありがとうございます';

            // if message content is `確認`
            if ($message_content == '確認') {
                $reply_message = 'ご確認ありがとうございます';
            }

            // ユーザーにメッセージを返す
            $reply = $bot->replyText($reply_token, $reply_message);



            // LINEのユーザーIDをuserIdに代入
            $userId = $request['events'][0]['source']['userId'];

            // userIdがあるユーザーを検索
            $user = User::where('line_id', $userId)->first();

            // もし見つからない場合は、データベースに保存
            if ($user == NULL) {
                $profile = $bot->getProfile($userId)->getJSONDecodedBody();

                $user = new User();
                $user->provider = 'line';
                $user->line_id = $userId;
                $user->name = $profile['displayName'];
                $user->save();
            }
            return 'ok';
        }
    }



    // メッセージ送信用
    public function message()
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
    }
}
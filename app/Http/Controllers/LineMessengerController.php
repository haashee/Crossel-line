<?php

namespace App\Http\Controllers;

use App\Models\LineUser;
use LINE\LINEBot\HTTPClient\CurlHTTPClient;
use LINE\LINEBot;
use App\Models\User;
use LINE\LINEBot\MessageBuilder\TextMessageBuilder;
use Log;


use Illuminate\Http\Request;

class LineMessengerController extends Controller
{
    public function webhook(Request $request)
    {
        // LINEから送られた内容を$inputsに代入
        $inputs = $request->all();

        // そこからtypeをとりだし、$message_typeに代入
        $message_type = $inputs['events'][0]['type'];
        Log::info("LOG: message type is " . $message_type);

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

            $user = new LineUser();
            $user->user_id = '3';
            $user->name = $profile['displayName'];
            $user->line_id = $userId;
            $user->provider = 'line';
            $user->mode = $mode;
            $user->save();
        }

        // タイプごとに分岐
        switch ($message_type) {

                // メッセージ受信
            case 'message':

                // 返答に必要なトークンを取得
                $reply_token = $inputs['events'][0]['replyToken'];

                // define message content
                $message_content = $inputs['events'][0]['message']['text'];

                // The message to send
                $message_data = "メッセージありがとうございます。ただいま準備中です";

                // if message content is `確認`
                if ($message_content == '確認') {
                    $message_data = 'ご確認ありがとうございます';
                }

                // LINEの投稿処理
                $response = $bot->replyText($reply_token, $message_data);

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

                // ユーザー固有のIDはどこかに保存しておいてください。メッセージ送信の際に必要です。
                LineUser::updateOrCreate(['line_id' => $mid]);
                Log::info("ユーザーを追加しました。 user_id = " . $mid);
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
                Log::info("the type is" . $message_type);
                break;
        }

        return;
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
<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Account;
use App\Models\LineUser;
use App\Models\Chat;
use Illuminate\Support\Facades\Session;

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

        $friendList = LineUser::where('account_id', $aid)->get();


        return view('dashboard.chat.index', [
            'friend' => $friend,
            'friendlist' => $friendList,
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


        // $chat = new Chat;
        // $form = $request->all();
        // $chat->fill($form)->save();
        // return redirect('/chat');
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

        // $chatList = Chat::all()->unique('lineuser_id');
        $chatList = Chat::all()->sortByDesc('created_at')->unique('lineuser_id');


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
}
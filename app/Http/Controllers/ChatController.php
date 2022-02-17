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
    public function index($aid, $id)
    {
        $account = Account::where('id', $aid)->first();

        $friend = LineUser::where('account_id', $aid)->first();

        $friendList = LineUser::where('account_id', $aid)->get();

        $chats = Chat::where('lineuser_id', $id)->get();

        // データーベースの件数を取得
        $length = Chat::all()->count();
        // 表示する件数を代入
        $display = 5;

        // $chats = Chat::offset($length - $display)->limit($display)->get();


        return view('dashboard.accounts.chat', [
            'friend' => $friend,
            'friendlist' => $friendList,
            'account' => $account,
            'chats' => $chats,
            // 'chat' => $chat,
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
                'name' => $request->name,
                'message' => $request->message,
                'lineuser_id' => $id,
                'user_identifier' => $request->user_identifier,
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
    public function show($id)
    {
        //
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
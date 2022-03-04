<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Account;
use App\Models\Chat;
use App\Models\Tag;
use App\Models\LineUser;
use App\Models\LineuserTag;
use Illuminate\Support\Facades\Session;



class LineUserController extends Controller
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

        $friends = LineUser::where('account_id', $aid)->get();

        return view('dashboard.friends.index', [
            'friends' => $friends,
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
    public function store(Request $request)
    {
        //
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

        return view('dashboard.friends.show', [
            'friend' => $friend,
            'account' => $account,

        ]);
    }


    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($aid, $id)
    {
        $account = Account::where('id', $aid)->first();

        $friend = LineUser::where('id', $id)->first();

        $tags = Tag::where('account_id', $aid)->get();

        return view('dashboard.friends.edit', [
            'friend' => $friend,
            'account' => $account,
            'tags' => $tags,
        ]);
    }


    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $aid, $id)
    {
        $request->validate([
            'name' => 'required',
        ]);

        // change date format
        if ($request->input('dob-year') != null && $request->input('dob-month') != null) {
            $DOB = $request->input('dob-year') . "/" . $request->input('dob-month') . "/" . $request->input('dob-day');
        } else {
            $DOB = null;
        }


        // sync updated tags
        $data = [];
        $data['tags'] = $request->input('tags');
        LineUser::find($id)->tags()->sync($data['tags']);

        LineUser::where('id', $id)
            ->update([
                'name' => $request->input('name'),
                'birthday' => $DOB,
                'phone' => $request->input('phone'),
                'postcode' => $request->input('postcode'),
                'gender' => $request->input('gender'),
                'email' => $request->input('email'),
            ]);

        Session::put('title', 'ユーザー編集完了');

        if ($request->checkbox) {
            Session::put('title', '会員情報の更新完了');
            return redirect('accounts/' . $aid . '/' . 'membership' . '/' . $id)
                ->with('message', '会員情報が更新されました。');
        } else {
            return redirect('accounts/' . $aid . '/' . 'friends' . '/' . $id . '/' . 'edit')
                ->with('message', 'ユーザー情報が無事編集されました。');
        }
    }


    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($aid, $id)
    {
        $lineUser = LineUser::where('id', $id)->first();
        $lineUser->delete();

        Session::put('title', 'ユーザー削除');

        return redirect('/accounts' . '/' . $aid . '/friends')->with('message', 'ユーザーが正常に削除されました。');
    }


    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function sendChat($aid, $id)
    {
        $account = Account::where('id', $aid)->first();

        $friend = LineUser::where('id', $id)->first();

        // check if chat for this user exists
        $chatUser = Chat::where('lineuser_id', $id)->first();

        // if does not exist then create new
        if ($chatUser == NULL) {
            $chatUser = new Chat();
            $chatUser->senderName = $account->name;
            $chatUser->receiverName = $friend->name;
            $chatUser->message = null;
            $chatUser->lineuser_id = $friend->id;
            $chatUser->user_identifier = null;
            $chatUser->save();
        }

        return redirect('accounts/' . $aid . '/' . 'chat' . '/' . $id);
    }
}
<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Account;
use App\Models\LineUser;
use Illuminate\Support\Facades\Session;



class LineUserController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index($aid)
    {
        $account = Account::where('id', $aid)->first();

        $friends = LineUser::where('account_id', $aid)->get();

        return view('dashboard.friends.show', [
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
    public function edit($aid, $id)
    {
        $account = Account::where('id', $aid)->first();

        $friend = LineUser::where('id', $id)->first();

        return view('dashboard.friends.edit', [
            'friend' => $friend,
            'account' => $account,
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

        LineUser::where('id', $id)
            ->update([
                'name' => $request->input('name'),
                'birthday' => $request->input('birthday'),
                'phone' => $request->input('phone'),
                'postcode' => $request->input('postcode'),
                'gender' => $request->input('gender'),
                'email' => $request->input('email'),
            ]);

        Session::put('title', 'ユーザー編集完了');

        return redirect('accounts/' . $aid . '/' . 'friends' . '/' . $id . '/' . 'edit')
            ->with('message', 'ユーザー情報が無事編集されました。');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $lineUser = LineUser::where('id', $id)->first();
        $lineUser->delete();

        Session::put('title', 'ユーザー削除');

        return redirect('/accounts')->with('message', 'ユーザーが正常に削除されました。');
    }
}
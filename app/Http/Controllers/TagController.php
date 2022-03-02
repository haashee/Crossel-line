<?php

namespace App\Http\Controllers;

use App\Models\Account;
use App\Models\Tag;

use Illuminate\Support\Facades\Session;
use Illuminate\Http\Request;

class TagController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index($aid)
    {
        $accounts = Account::all();
        $account = Account::where('id', $aid)->first();

        return view('dashboard.friends.settings', [
            'accounts' => $accounts,
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
    public function store(Request $request, $aid)
    {

        $request->validate([
            'name' => 'required',
            'color' => 'required',
        ]);


        Tag::create([
            'name' => $request->input('name'),
            'color' => $request->input('color'),
            'account_id' => $aid,
        ]);


        Session::put('title', 'リッチメニュー作成完了');

        return redirect('accounts' . '/' . $aid . '/' . 'tag')
            ->with('message', 'リッチメニューが無事作成されました。使用するにはデフォルトとして設定してください。');
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
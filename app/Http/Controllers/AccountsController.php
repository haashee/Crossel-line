<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Account;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Session;


class AccountsController extends Controller
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
    public function index()
    {
        $accounts = Account::all();

        return view('dashboard.accounts.accounts', [
            'accounts' => $accounts,
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {

        return view('dashboard.accounts.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $request->validate([
            'channel_secret' => 'required',
            'access_token' => 'required',
        ]);



        Account::create([
            'name' => $request->input('name'),
            'channel_secret' => $request->input('channel_secret'),
            'access_token' => $request->input('access_token'),
            'image' => 'default_profilepicture.png',
            'user_id' => auth()->user()->id,
        ]);

        Session::put('title', 'アカウント作成完了');

        return redirect('/accounts')
            ->with('message', 'アカウントが無事作成されました。');
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
        return view('dashboard.accounts.edit')
            ->with('account', Account::where('id', $id)->first());
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
        $request->validate([
            'channel_secret' => 'required',
            'access_token' => 'required',
            'image' => 'mimes:jpg,png,jpeg|max:5048'
        ]);

        $account = Account::where('id', $id)->first();

        if ($request->hasFile('image')) {
            $image_file_path = public_path('uploads/profile-pic/') . $account->image; // get previous image from folder
            if ($account->image != null && File::exists($image_file_path) && $account->image !== 'default_profilepicture.png') { // unlink or remove previous image from folder
                unlink($image_file_path);
            }
            $file = $request->file('image');
            $name = auth()->user()->id . '-' . $id . '-' . uniqid() . '.' . $request->image->extension();
            $file = $file->move(public_path('uploads/profile-pic'), $name);
            $account->image = $name;
            $account->save();
        }

        Account::where('id', $id)
            ->update([
                'name' => $request->input('name'),
                'channel_secret' => $request->input('channel_secret'),
                'access_token' => $request->input('access_token'),
                'user_id' => auth()->user()->id,
            ]);

        Session::put('title', 'アカウント編集完了');

        return redirect('/accounts' . '/' . $id . '/' . 'edit')
            ->with('message', 'アカウントが無事編集されました。');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $account = Account::where('id', $id)->first();
        $account->delete();

        if ($account->image !== 'default_profilepicture.png') {
            $file_path = public_path('uploads/profile-pic/') . $account->image;
            unlink($file_path);
        }

        Session::put('title', 'アカウント削除');

        return redirect('/accounts')->with('message', 'アカウントが正常に削除されました。');
    }
}
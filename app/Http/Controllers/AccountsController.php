<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Account;
use App\Models\AccountSetting;
use App\Models\ChatSetting;
use App\Models\RichmenuSetting;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Http;
use Log;


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

        return view('dashboard.accounts.index', [
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

    public function check($aid)
    {
        $account = Account::where('id', $aid)->first();

        return view('dashboard.accounts.create-check', [
            'account' => $account,

        ]);
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
            'name' => 'required',
            'channel_secret' => 'required',
            'access_token' => 'required',
        ]);

        $newAccount = Account::create([
            'name' => $request->input('name'),
            'channel_secret' => $request->input('channel_secret'),
            'access_token' => $request->input('access_token'),
            'liff_full' => $request->input('liff_full'),
            'liff_tall' => $request->input('liff_tall'),
            'liff_compact' => $request->input('liff_compact'),
            'image' => 'default_profilepicture.png',
            'user_id' => auth()->user()->id,
        ]);

        AccountSetting::create([
            'account_id' => $newAccount->id,
            'privacy_url' => 'プライバシーURLが登録されていません。',
            'privacy_policy' => 'プライバシー方針が登録されていません。',
            'membership_background' => '#5a9ae4',
        ]);

        ChatSetting::create([
            'account_id' => $newAccount->id,
            'welcome_text' => '友だち追加ありがとうございます! 注文するボタンからLINE上で簡単に注文を行うことができます!',
            'default_text' => 'メッセージありがとうございます。申し訳ありませんがこのアカウントから個別に返信することはできません。次回の配信をお楽しみに!',
        ]);

        RichmenuSetting::create([
            'account_id' => $newAccount->id,
            'displayTextA' => 'カテゴリを選択してください。',
            'displayTextB' => 'カテゴリを選択してください。',
            'displayTextC' => 'カテゴリを選択してください。',
        ]);

        Session::put('title', 'アカウントの初期化完了');

        return redirect('/accounts' . '/' . $newAccount->id . '/create/check')
            ->with('message', 'アカウントの作成が開始されました。');
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
        // get previous route name
        $url = url()->previous();
        $route = app('router')->getRoutes($url)->match(app('request')->create($url))->getName();

        $request->validate([
            'name' => 'required',
            'channel_secret' => 'required',
            'access_token' => 'required',
            'liff_full' => 'required',
            'liff_tall' => 'required',
            'liff_compact' => 'required',
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
                'liff_full' => $request->input('liff_full'),
                'liff_tall' => $request->input('liff_tall'),
                'liff_compact' => $request->input('liff_compact'),
            ]);


        switch ($route) {
            case 'accounts.check':
                Session::put('title', 'アカウント作成完了');
                return redirect('/accounts')
                    ->with('message', 'アカウントが無事作成されました。');
                break;
            default:
                Session::put('title', 'アカウント編集完了');
                return redirect('/accounts' . '/' . $id . '/' . 'edit')
                    ->with('message', 'アカウントが無事編集されました。');
                break;
        }
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
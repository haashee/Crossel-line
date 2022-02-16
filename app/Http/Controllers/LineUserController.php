<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Account;
use App\Models\LineUser;


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
    public function edit($id)
    {
        $account = Account::where('id', $id)->first();

        $friend = LineUser::where('account_id', $id)->first();


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
                'liff_full' => $request->input('liff_full'),
                'liff_tall' => $request->input('liff_tall'),
                'liff_compact' => $request->input('liff_compact'),
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
        //
    }
}
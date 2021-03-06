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
        $tags = Tag::where('account_id', $aid)->get();



        return view('dashboard.tag.index', [
            'accounts' => $accounts,
            'account' => $account,
            'tags' => $tags,
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


        if ($request->has('isPublic')) {
            $publicFlag = true;
        } else {
            $publicFlag = false;
        }

        Tag::create([
            'name' => $request->input('name'),
            'color' => $request->input('color'),
            'isPublic' => $publicFlag,
            'account_id' => $aid,
        ]);


        Session::put('title', 'タグ作成完了');

        return redirect('accounts' . '/' . $aid . '/' . 'tag')
            ->with('message', 'タグが無事作成されました。');
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
        $tag = Tag::where('id', $id)->first();
        $friends = $tag->lineUsers()->get();


        return view('dashboard.tag.edit', [
            'account' => $account,
            'tag' => $tag,
            'friends' => $friends,
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
            'color' => 'required',
        ]);

        if ($request->has('isPublic')) {
            $publicFlag = true;
        } else {
            $publicFlag = false;
        }

        Tag::where('id', $id)
            ->update([
                'name' => $request->input('name'),
                'color' => $request->input('color'),
                'isPublic' => $publicFlag,
            ]);

        Session::put('title', 'タグ更新完了');

        return redirect('accounts' . '/' . $aid . '/' . 'tag')
            ->with('message', 'タグが無事更新されました。');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($aid, $id)
    {
        $tag = Tag::where('id', $id)->first();
        $tag->delete();

        Session::put('title', 'タグ削除');

        return redirect('accounts' . '/' . $aid . '/' . 'tag')
            ->with('message', 'タグが正常に削除されました。');
    }
}
<?php

namespace App\Http\Controllers;

use App\Models\RichMenu;
use App\Models\Account;

use Illuminate\Support\Facades\Session;

use Illuminate\Http\Request;


class RichMenuController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index($aid)
    {
        $account = Account::where('id', $aid)->first();

        return view('dashboard.richmenu.index', [
            'account' => $account,
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create($aid)
    {
        $account = Account::where('id', $aid)->first();

        return view('dashboard.richmenu.create', [
            'account' => $account,
        ]);
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
        ]);

        if ($request->input('richmenu_size') == 'big') {
            $height = 1686;
        } elseif ($request->input('richmenu_size') == 'small') {
            $height = 843;
        }

        $newImageName = 'richmenu' . '-' . $aid . '-' . uniqid() . '.' . $request->image->clientExtension();
        $request->image->move(public_path('uploads/richmenu'), $newImageName);

        RichMenu::create([
            'name' => $request->input('name'),
            'width' => '2500',
            'height' => $height,
            'image' => $newImageName,
            // 'richmenu_id' => $request->input('richmenu_id'),
            'account_id' => $aid,
        ]);


        Session::put('title', 'リッチメニュー作成完了');

        return redirect('accounts' . '/' . $aid . '/' . 'richmenu')
            ->with('message', 'リッチメニューが無事作成されました。');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\RichMenu  $richMenu
     * @return \Illuminate\Http\Response
     */
    public function show(RichMenu $richMenu)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\RichMenu  $richMenu
     * @return \Illuminate\Http\Response
     */
    public function edit(RichMenu $richMenu)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\RichMenu  $richMenu
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, RichMenu $richMenu)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\RichMenu  $richMenu
     * @return \Illuminate\Http\Response
     */
    public function destroy(RichMenu $richMenu)
    {
        //
    }
}
<?php

namespace App\Http\Controllers;

use App\Models\RichMenu;
use App\Models\Account;

use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\File;

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
        $richmenus = RichMenu::where('account_id', $aid)->get();

        return view('dashboard.richmenu.index', [
            'account' => $account,
            'richmenus' => $richmenus,
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
        if ($request->input('richmenu_size') == 'big') {

            $height = 1686;

            $request->validate([
                'name' => 'required',
                'label' => 'required',
                'richmenu_size' => 'required',
                'image' => 'required|mimes:png,jpg,jpeg|max:1024|dimensions:width=2500,height=1686',
            ]);
        } elseif ($request->input('richmenu_size') == 'small') {

            $height = 843;

            $request->validate([
                'name' => 'required',
                'label' => 'required',
                'richmenu_size' => 'required',
                'image' => 'required|mimes:png,jpg,jpeg|max:1024|dimensions:width=2500,height=843',
            ]);
        }

        $newImageName = 'richmenu' . '-' . $aid . '-' . uniqid() . '.' . $request->image->clientExtension();
        $request->image->move(public_path('uploads/richmenu'), $newImageName);

        RichMenu::create([
            'name' => $request->input('name'),
            'display_text' => $request->input('label'),
            'width' => '2500',
            'height' => $height,
            'image' => $newImageName,
            'text_a' => $request->input('buttonsA'),
            'text_b' => $request->input('buttonsB'),
            'text_c' => $request->input('buttonsC'),
            'text_d' => $request->input('buttonsD'),
            'text_e' => $request->input('buttonsE'),
            'text_f' => $request->input('buttonsF'),
            'url_a' => $request->input('urlA'),
            'url_b' => $request->input('urlB'),
            'url_c' => $request->input('urlC'),
            'url_d' => $request->input('urlD'),
            'url_e' => $request->input('urlE'),
            'url_f' => $request->input('urlF'),
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
    public function edit(RichMenu $richMenu, $aid, $id)
    {
        $account = Account::where('id', $aid)->first();
        $richmenu = RichMenu::where('id', $id)->first();
        $richmenus = RichMenu::where('account_id', $aid)->get();

        return view('dashboard.richmenu.edit', [
            'account' => $account,
            'richmenu' => $richmenu,
            'richmenus' => $richmenus,
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\RichMenu  $richMenu
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, RichMenu $richMenu, $aid, $id)
    {
        if ($request->input('richmenu_size') == 'big') {

            $height = 1686;

            $request->validate([
                'name' => 'required',
                'label' => 'required',
                'richmenu_size' => 'required',
                'image' => 'mimes:png,jpg,jpeg|max:1024|dimensions:width=2500,height=1686',
            ]);
        } elseif ($request->input('richmenu_size') == 'small') {

            $height = 843;

            $request->validate([
                'name' => 'required',
                'label' => 'required',
                'richmenu_size' => 'required',
                'image' => 'mimes:png,jpg,jpeg|max:1024|dimensions:width=2500,height=843',
            ]);
        }

        $account = Account::where('id', $aid)->first();
        $richmenu = RichMenu::where('id', $id)->first();
        $richmenus = RichMenu::where('account_id', $aid)->get();

        if ($request->hasFile('image')) {
            $image_file_path = public_path('uploads/richmenu/') . $richmenu->image; // get previous image from folder
            if ($richmenu->image != null && File::exists($image_file_path)) { // unlink or remove previous image from folder
                unlink($image_file_path);
            }
            $file = $request->file('image');
            $name = 'richmenu' . '-' . $aid . '-' . uniqid() . '.' . $request->image->extension();
            $file = $file->move(public_path('uploads/richmenu'), $name);
            $richmenu->image = $name;
            $richmenu->save();
        }

        RichMenu::where('id', $id)
            ->update([
                'name' => $request->input('name'),
                'display_text' => $request->input('label'),
                'width' => '2500',
                'height' => $height,
                'text_a' => $request->input('buttonsA'),
                'text_b' => $request->input('buttonsB'),
                'text_c' => $request->input('buttonsC'),
                'text_d' => $request->input('buttonsD'),
                'text_e' => $request->input('buttonsE'),
                'text_f' => $request->input('buttonsF'),
                'url_a' => $request->input('urlA'),
                'url_b' => $request->input('urlB'),
                'url_c' => $request->input('urlC'),
                'url_d' => $request->input('urlD'),
                'url_e' => $request->input('urlE'),
                'url_f' => $request->input('urlF'),
            ]);

        Session::put('title', 'リッチメニュー更新完了');

        return redirect('accounts' . '/' . $aid . '/' . 'richmenu')
            ->with('message', 'リッチメニューが無事更新されました。');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\RichMenu  $richMenu
     * @return \Illuminate\Http\Response
     */
    public function destroy(RichMenu $richMenu, $aid, $id)
    {
        $richmenu = RichMenu::where('id', $id)->first();
        $richmenu->delete();

        $file_path = public_path('uploads/richmenu/') . $richmenu->image;
        unlink($file_path);

        Session::put('title', 'リッチメニュー削除');

        return redirect('accounts' . '/' . $aid . '/' . 'richmenu')
            ->with('message', 'リッチメニューが正常に削除されました。');
    }
}
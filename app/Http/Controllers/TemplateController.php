<?php

namespace App\Http\Controllers;

use App\Models\Account;
use App\Models\Template;
use App\Models\Tag;


use Illuminate\Support\Facades\Session;
use Illuminate\Http\Request;

class TemplateController extends Controller
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
        $templates = Template::where('account_id', $aid)->get();

        return view('dashboard.template.index', [
            'accounts' => $accounts,
            'account' => $account,
            'templates' => $templates,
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
            // 'text' => 'required',
        ]);


        if ($request->has('isFavorite')) {
            $favoriteFlag = true;
        } else {
            $favoriteFlag = false;
        }


        Template::create([
            'name' => $request->input('name'),
            // 'text' => $request->input('text'),
            // 'isFavorite' => $favoriteFlag,
            'account_id' => $aid,
        ]);


        Session::put('title', 'テンプレート作成完了');

        return redirect('accounts' . '/' . $aid . '/' . 'template')
            ->with('message', 'テンプレートが無事作成されました。');
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
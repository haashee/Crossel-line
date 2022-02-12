<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function dashboard()
    {
        return view('dashboard.dashboard');
    }


    public function default()
    {
        return view('dashboard.default');
    }


    public function settings()
    {
        return view('dashboard.settings');
    }


    public function billing()
    {
        return view('dashboard.billing');
    }


    public function wizard()
    {
        return view('dashboard.wizard');
    }


    public function friends()
    {
        return view('dashboard.friends');
    }


    public function accountsList()
    {
        return view('dashboard.accounts-list');
    }


    public function account()
    {
        return view('dashboard.account');
    }


    public function chat()
    {
        return view('dashboard.chat');
    }
}
<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function index()
    {
        return view('dashboard.dashboard');
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
}
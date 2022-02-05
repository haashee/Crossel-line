<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class LiffController extends Controller
{
    public function liff()
    {
        return view('liff.index');
    }
}
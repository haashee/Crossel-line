<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Account;
use App\Models\LineUser;
use Illuminate\Support\Facades\Session;

class MembershipController extends Controller
{
    public function membership($aid, $id)
    {
        $account = Account::where('id', $aid)->first();

        $friend = LineUser::where('id', $id)->first();

        return view('dashboard.membership.index', [
            'friend' => $friend,
            'account' => $account,
        ]);
    }

    public function privacy($aid)
    {
        $account = Account::where('id', $aid)->first();

        return view('dashboard.membership.privacy-policy', [
            'account' => $account,
        ]);
    }
}
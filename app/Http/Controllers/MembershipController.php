<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Account;
use App\Models\LineUser;
use App\Models\AccountSetting;
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

    public function updatePrivacy(Request $request, $aid)
    {
        $request->validate([
            // 'privacy-url' => 'required',
            // 'privacy-policy' => 'required',
        ]);

        AccountSetting::updateOrCreate(['account_id' => $aid], [
            'privacy_policy' => $request->input('privacy-policy'),
            'privacy_url' => $request->input('privacy-url'),
            'membership_background' => $request->input('color'),
        ]);

        Session::put('title', 'プライバシーポリシー更新完了');

        return redirect('accounts/' . $aid . '/' . 'edit')
            ->with('message', 'プライバシーポリシーが無事更新されました。');
    }
}
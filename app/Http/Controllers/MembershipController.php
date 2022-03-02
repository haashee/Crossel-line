<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Account;
use App\Models\Tag;
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
            'privacy-url' => 'required',
            'privacy-policy' => 'required',
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

    public function update(Request $request, $aid, $id)
    {
        $request->validate([
            'name' => 'required',
        ]);

        $account = Account::where('id', $aid)->first();

        $DOB = $request->input('dob-year') . "/" . $request->input('dob-month') . "/" . $request->input('dob-day');

        LineUser::where('id', $id)
            ->update([
                'name' => $request->input('name'),
                'birthday' => $DOB,
                'phone' => $request->input('phone'),
                'postcode' => $request->input('postcode'),
                'gender' => $request->input('gender'),
                'email' => $request->input('email'),
            ]);


        Session::put('title', '会員情報の更新完了');

        return redirect('accounts/' . $aid . '/' . 'membership' . '/' . $id)
            ->with('message', '会員情報が更新されました。');

        // return redirect('https://liff.line.me/' . $account->liff_tall)
        //     ->with('message', '会員情報が更新されました。');
    }

    public function setting($aid)
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
}
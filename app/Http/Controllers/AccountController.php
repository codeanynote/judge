<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\User;
use Maatwebsite\Excel\Facades\Excel;
use Illuminate\Support\Facades\Input;

class AccountController extends Controller {

    private $account;

    function __construct() {
        $this->middleware('auth.admin');
        $account = new User();
    }

    public function index() {
        $page_title = 'Account List';
        $accounts = User::all();
        return view('account.list', compact('page_title', 'accounts'));
    }

    public function create() {
        $page_title = "Account Add";
        return view('account.create', compact('page_title'));
    }

    public function createAction(Request $request) {
        $this->validate($request, [
            'username' => 'required|max:255',
            'email' => 'required|email|unique:judge_users',
            'password' => 'required|min:6|confirmed',
            'password_confirmation' => 'required|min:6'
        ]);
        User::create([
            'created_at' => \Carbon\Carbon::now(),
            'updated_at' => \Carbon\Carbon::now(),
            'username' => $request['username'],
            'email' => $request['email'],
            'password' => password_hash($request['password'], PASSWORD_DEFAULT)
        ]);
        return redirect()->back();
    }

    public function detail($id) {
        $page_title = 'Account Detail';
        $account = User::find($id);
        return view('account.detail', compact('page_title', 'account'));
    }

    public function edit($id) {
        $page_title = 'Account Edit';
        $account = User::find($id);
        return view('account.edit', compact('page_title', 'account'));
    }

    public function update(Request $request) {
        $this->validate($request, [
            'userid' => 'required|max:255',
            'username' => 'required|max:255',
        ]);
        $user = User::find($request['userid']);
        $user->updated_at = \Carbon\Carbon::now();
        $user->username = $request['username'];
//        $user->email = $request['email'];
        $user->update();
        return redirect()->back();
    }

    public function delete($id) {
        $account = User::find($id)->delete();
        return redirect()->back();
    }

    public function export() {

        $export_data = User::orderBy('userid', 'ASC')->get();
        $export_data = json_decode(json_encode($export_data), true);

        Excel::create('account', function($excel) use($export_data) {
            $excel->sheet('Sheet 1', function($sheet) use($export_data) {
                $sheet->fromArray($export_data);
            });
        })->export('xls');
    }

    public function printing() {
        $page_title = 'Account List';
        $accounts = User::all();
        return view('account.print', compact('page_title', 'accounts'));
    }

    public function passwordChange() {
        $page_title = 'Password Change';
        return view('account.password', compact('page_title'));
    }

    public function passwordUpdate(Request $request) {
        $this->validate($request, [
            'password' => 'required|min:6|confirmed',
            'password_confirmation' => 'required|min:6'
        ]);
        
        $account = User::find(\Auth::user()->userid)->first();
        $account->password = password_hash($request['password'], PASSWORD_DEFAULT);
        $account->update();
        $message = "Password changed.";
        return \Redirect::back()->with('message', $message);
    }

}

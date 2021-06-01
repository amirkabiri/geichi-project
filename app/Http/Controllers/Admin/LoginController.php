<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class LoginController extends Controller
{
    // redirects to this route if login was successful
    private const REDIRECT_TO = 'admin.dashboard';

    public function view(){
        return view('admin.login');
    }

    public function handle(Request $request){
        $request->validate([
            'username' => 'required|exists:admins',
            'password' => 'required',
            'remember' => 'boolean'
        ]);

        $credentials = $request->only(['username', 'password']);
        $remember = $request->get('remember', false);
        if(Auth::guard('admin')->attempt($credentials, $remember)){
            $request->session()->regenerate();

            $admin = Auth::guard('admin')->user();
            $admin->logged_in_at = Carbon::now();
            $admin->save();

            return redirect()->route(self::REDIRECT_TO);
        }

        return back()->withErrors([
            'username' => ['credentials did not match any record']
        ]);
    }
}

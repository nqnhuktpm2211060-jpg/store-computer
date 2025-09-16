<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AuthController extends Controller
{
    public function loginForm(){
        return view('pages.auth.login');
    }

    public function login(Request $request){
        $data = $request->validate([
            'email' => 'required|email',
            'password' => 'required',
        ]);
        
        if (Auth::attempt($data)) {
            if(Auth::user()->isAdmin()){
                return redirect()->route('admin.dashboard');
            }

            return redirect()->intended('/')->with('success', __('notification.log_in_successfully')); 
        }

        return redirect()->back()->withErrors([
            'loginError' => __('notification.log_in_error'),
        ]);
    }

    public function registerForm(){
        return view('pages.auth.register');
    }

    public function register(Request $request){
        $data = $request->validate([
            'name' => 'required',
            'email' => 'required|email|unique:users,email',
            'password' => 'required',
        ]);

        $data['role_id'] = 2;

        User::create($data);

        return redirect()->route('login.form')->with('success', __('notification.registered_successfully'));
    }

    public function logout() {
        if(!Auth::check()){
            return redirect()->route('login.form')->with('error', __('notification.logout_error'));
        }
        Auth::logout();
        return redirect()->route('login.form')->with('success', __('notification.logout_success'));
    }

    public function updateProfile(Request $request) {
        $user = Auth::user();

        $data = $request->validate([
            "name" => "required",
            "email" => "required|email|unique:users,email," .$user->id,
            "phone" => "required",
            "province" => "required",
            "district" => "required",
            "ward" => "required",
            "address" => "required",
        ]);

        $user->update($data);

        return redirect()->back()->with('success', 'Cập nhật thành công thông tin cá nhân');
    }
}

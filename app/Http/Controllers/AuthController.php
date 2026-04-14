<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Hash;

class AuthController extends Controller
{
    public function showLoginForm() { 
        return view('pages.login'); 
    }

    public function login(Request $request) {
        $request->validate([
            'email' => 'required|email',
            'password' => 'required'
        ]);

        $user = User::where('email', $request->email)->first();

        if ($user && Hash::check($request->password, $user->password)) {
            session(['user_id' => $user->id]);
            session(['user_name' => $user->firstname . ' ' . $user->lastname]);
            session(['email' => $user->email]);
            session(['role' => $user->role]);

            return redirect()->route('home')->with('success', 'Đăng nhập thành công!');
        } else {
            return redirect()->back()->with('error', 'Email hoặc Mật khẩu không đúng!');
        }
    }
    
    public function showRegisterForm() { 
        return view('pages.register'); 
    }

    public function register(Request $request) {
        $request->validate([
            'firstname' => 'required',
            'lastname' => 'required',
            'email' => 'required|email|unique:users,email',
            'password' => 'required|min:6',
        ]);

        $user = User::create([
            'firstname' => $request->firstname,
            'lastname' => $request->lastname,
            'email' => $request->email,
            'password' => Hash::make($request->password),
            'country' => $request->country ?? null,
            'birthdate' => $request->birthdate ?? null,
            'role' => 'user'
        ]);

        session(['user_id' => $user->id]);
        session(['user_name' => $user->firstname . ' ' . $user->lastname]);
        session(['email' => $user->email]);
        session(['role' => 'user']);

        return redirect()->route('home')->with('success', 'Đăng ký thành công!');
    }
    
    public function logout() {
        session()->flush();
        return redirect()->route('home')->with('success', 'Đăng xuất thành công!');
    }
    
    public function showResetPassword() { 
        return view('pages.reset-password'); 
    }
}

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
        ], [
            'email.required' => 'Vui lòng nhập email.',
            'email.email' => 'Địa chỉ email không đúng định dạng.',
            'password.required' => 'Vui lòng nhập mật khẩu.'
        ]);

        $user = User::where('email', $request->email)->first();

        if ($user && Hash::check($request->password, $user->password)) {
            session(['user_id' => $user->id]);
            session(['user_name' => $user->firstname . ' ' . $user->lastname]);
            session(['email' => $user->email]);
            session(['role' => $user->role]);

            if ($user->role === 'admin') {
                return redirect()->route('admin.dashboard')->with('success', 'Chào mừng Admin quay trở lại!');
            }

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
        ], [
            'firstname.required' => 'Tên không được bỏ trống.',
            'lastname.required' => 'Họ không được bỏ trống.',
            'email.required' => 'Email không được bỏ trống.',
            'email.email' => 'Địa chỉ email không đúng định dạng.',
            'email.unique' => 'Email này đã được đăng ký sử dụng.',
            'password.required' => 'Mật khẩu không được bỏ trống.',
            'password.min' => 'Mật khẩu phải có ít nhất 6 ký tự.',
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
    
    public function resetPassword(Request $request) {
        $request->validate([
            'email' => 'required|email|exists:users,email',
            'password' => 'required|min:8|regex:/^(?=.*[a-z])(?=.*[A-Z])(?=.*\d)[a-zA-Z\d\W]{8,}$/',
            'confirm_password' => 'required|same:password',
        ], [
            'email.required' => 'Vui lòng nhập email.',
            'email.email' => 'Địa chỉ email không đúng định dạng.',
            'email.exists' => 'Email không tồn tại trên hệ thống.',
            'password.required' => 'Vui lòng nhập mật khẩu mới.',
            'password.min' => 'Mật khẩu mới phải có ít nhất 8 ký tự.',
            'password.regex' => 'Mật khẩu mới chưa đủ mạnh. Phải có ít nhất 8 ký tự, bao gồm chữ hoa, chữ thường và chữ số.',
            'confirm_password.required' => 'Vui lòng xác nhận mật khẩu.',
            'confirm_password.same' => 'Xác nhận mật khẩu không khớp.',
        ]);

        $user = User::where('email', $request->email)->first();
        if ($user) {
            $user->update([
                'password' => Hash::make($request->password)
            ]);
            return redirect()->route('login')->with('success', 'Đặt lại mật khẩu thành công! Vui lòng đăng nhập.');
        }

        return redirect()->back()->with('error', 'Có lỗi xảy ra, vui lòng thử lại.');
    }
    
    public function logout() {
        session()->flush();
        return redirect()->route('home')->with('success', 'Đăng xuất thành công!');
    }
    
    public function showResetPassword() { 
        return view('pages.reset-password'); 
    }
}

<?php

namespace App\Http\Controllers;

use App\Models\AccountUser;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class AccountController extends Controller
{
    // Hiển thị form đăng ký
    public function showRegistrationForm()
    {
        return view('home.register');
    }

    // Xử lý đăng ký
    public function register(Request $request)
    {   
        // Xác thực dữ liệu từ form
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:account_users', // Email phải là duy nhất trong bảng account_users
            'password' => 'required|string|min:8|confirmed', // Yêu cầu xác nhận mật khẩu
            'age' => 'required|integer|min:18',
            'address' => 'nullable|string|max:255',
        ]);
        // Tạo người dùng mới
        AccountUser::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password), // Mã hóa mật khẩu
            'age' => $request->age,
            'address' => $request->address,
        ]);

        // Đăng nhập người dùng ngay sau khi đăng ký thành công
        // Auth::attempt($request->only('email', 'password'));

        return redirect()->route('login')->with('success', 'Registration successful!');
    }

    // Hiển thị form đăng nhập
    public function showLoginForm()
    {
        return view('home.login');
    }

    // Xử lý đăng nhập
    public function login(Request $request)
    {
        // Xác thực thông tin đăng nhập
        // var_dump($request->email);
        // die();
        $request->validate([
            'email' => 'required|email',
            'password' => 'required|string',
        ]);
        return redirect()->route('index')->with('success', 'Login successful!');

        // Kiểm tra thông tin đăng nhập
        // if (Auth::attempt($request->only('email', 'password'))) {
        //     return redirect()->route('index')->with('success', 'Login successful!');
        // }

        // return back()->withErrors(['email' => 'Invalid credentials'])->withInput();
    }

    // Đăng xuất
    public function logout()
    {
        Auth::logout();
        return redirect()->route('loginForm')->with('success', 'Logged out successfully!');
    }
}

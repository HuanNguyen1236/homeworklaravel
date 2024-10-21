<?php

namespace App\Http\Controllers;

use App\Models\AccountUser;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use App\Models\User;

class AccountController extends Controller
{
    // Hiển thị form đăng ký
    public function showRegistrationForm()
    {
        $viewData = [
            'title'=>'Register',
        ];
        return view('home.register')->with('viewData', $viewData);
    }

    // Xử lý đăng ký
    public function register(Request $request)
    { 
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:account_users', 
            'password' => 'required|string|min:8|confirmed', 
            'age' => 'required|integer|min:18',
            'address' => 'nullable|string|max:255',
            'avatar' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
        ]);
        $user = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
            'age' => $request->age,
            'address' => $request->address,
            'remember_token' => $request->_token,
        ]);
        if ($request->hasFile('avatar')) {
            $fileName = 'user_' . $user->id . '.' . $request->file('avatar')->getClientOriginalExtension();
            $request->file('avatar')->move(public_path('img'), $fileName);
            $user->update(['avatar' => 'img/' . $fileName]);
        }
        return redirect()->route('login')->with('success', 'Registration successful!');
    }
    public function showLoginForm()
    {
        $viewData = [
            'title'=>'Login',
        ];
        return view('home.login')->with('viewData', $viewData);
    }

    public function login(Request $request)
    {
        // Xác thực thông tin đăng nhập
        // var_dump($request->email);
        // die();
        $request->validate([
            'email' => 'required|email',
            'password' => 'required|string',
        ]);
        // return redirect()->route('index')->with('success', 'Login successful!');

        // Kiểm tra thông tin đăng nhập
        if (Auth::attempt($request->only('email', 'password'))) {
            return redirect()->route('index')->with('success', 'Login successful!');
        }

        // return back()->withErrors(['email' => 'Invalid credentials'])->withInput();
    }

    // Đăng xuất
    public function logout()
    {
        Auth::logout();
        return redirect()->route('loginForm')->with('success', 'Logged out successfully!');
    }
     
    public function show(string $id)
    {
        $user = User::find($id);
        $viewDatas = [
            'title' => 'Profile',
        ];
        return view('home.profile', compact('user'))->with('viewData', $viewDatas);
    }
}

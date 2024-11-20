<?php

namespace App\Http\Controllers;

use App\Models\AccountUser;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use App\Models\User;
use Illuminate\Support\Facades\Storage;


class AccountController extends Controller
{
    // Hiển thị form đăng ký
    public function showRegistrationForm()
    {
        $viewData = [
            'title' => 'Register',
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
            'balance' => 1000,
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
            'title' => 'Login',
        ];
        return view('home.login')->with('viewData', $viewData);
    }

    public function login(Request $request)
    {
        $request->validate([
            'email' => 'required|email',
            'password' => 'required|string',
        ]);
        if (Auth::attempt($request->only('email', 'password'))) {
            $user = Auth::user();
            if ($user->role === 'admin') {
                return redirect()->route('admin.dashboard')->with('success', 'Login successful!');
            } else {
                return redirect()->route('index')->with('success', 'Login successful!');
            }
        }
        return back()->withErrors(['email' => 'Invalid credentials'])->withInput();
    }

    public function logout()
    {
        Auth::logout();
        return redirect()->route('loginForm')->with('success', 'Logged out successfully!');
    }

    public function show(string $id)
    {
        $viewDatas = [
            'title' => 'Profile',
        ];
        return view('home.profile')->with('viewData', $viewDatas)->with('user', User::find($id));
    }
    public function update(Request $request)
    {
        $user = Auth::user();
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|max:255|unique:users,email,' . $user->id,
            'age' => 'required|integer|min:0',
            'address' => 'nullable|string|max:255',
            'avatar' => 'nullable|image|mimes:jpg,jpeg,png,gif|max:2048',
        ]);
        try {
            $user->name = $request->input('name');
            $user->email = $request->input('email');
            $user->age = $request->input('age');
            $user->address = $request->input('address');
            if ($request->hasFile('avatar')) {
                if ($user->avatar && file_exists(public_path($user->avatar))) {
                    unlink(public_path($user->avatar));
                }
                $fileName = 'user_' . $user->id . '.' . $request->file('avatar')->getClientOriginalExtension();
                $request->file('avatar')->move(public_path('img'), $fileName);
                $user->update(['avatar' => 'img/' . $fileName]);
            }
            $user->save();
            return redirect()->route('profile', ['id' => $user->id])->with('success', 'Profile updated successfully.');

        } catch (\Exception $e) {
            return redirect()->route('profile', ['id' => $user->id])->with('error', 'There was an error updating your profile.');
        }
    }
    public function destroy(string $id)
    {
        $user = User::find($id);
        if ($user) {
            $user->delete();
            if ($user->avatar && file_exists(public_path($user->avatar))) {
                unlink(public_path($user->avatar));
            }
            return redirect()->back()->with('success', 'User cleared successfully.');
        }
        return redirect()->back()->with('error', 'User not found.');
    }
    public function clearUser()
    {
        User::truncate();
        return redirect()->back()->with('success', 'Cart cleared successfully.');
    }
}

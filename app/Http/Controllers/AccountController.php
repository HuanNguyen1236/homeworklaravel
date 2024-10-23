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
    // public function edit()
    // {
    //     // Lấy thông tin user hiện tại
    //     $user = Auth::user();
    //     return view('profile.edit', compact('user'));
    // }

    // Xử lý chỉnh sửa profile
    public function update(Request $request)
    {
        $user = Auth::user();

        // Validation dữ liệu từ form
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|max:255|unique:users,email,' . $user->id,
            // 'date_of_birth' => 'required|date',
            'age' => 'required|integer|min:0',
            'address' => 'nullable|string|max:255',
            'avatar' => 'nullable|image|mimes:jpg,jpeg,png,gif|max:2048', // Giới hạn dung lượng file avatar
        ]);

        try {
            // Cập nhật thông tin user
            $user->name = $request->input('name');
            $user->email = $request->input('email');
            // $user->date_of_birth = $request->input('date_of_birth');
            $user->age = $request->input('age');
            $user->address = $request->input('address');

            // Nếu có file avatar được upload
            if ($request->hasFile('avatar')) {
                // Xóa ảnh cũ nếu có
                if ($user->avatar && file_exists(public_path($user->avatar))) {
                    unlink(public_path($user->avatar));
                }
            
                $fileName = 'user_' . $user->id . '.' . $request->file('avatar')->getClientOriginalExtension();
                $request->file('avatar')->move(public_path('img'), $fileName);
                $user->update(['avatar' => 'img/' . $fileName]);
            }        

            // Lưu user
            $user->save();

            // Trả về thông báo thành công
            return redirect()->route('profile', ['id' => $user->id])->with('success', 'Profile updated successfully.');

        } catch (\Exception $e) {
            // Nếu có lỗi, trả về thông báo lỗi
            return redirect()->route('profile', ['id' => $user->id])->with('error', 'There was an error updating your profile.');
        }
    }
}

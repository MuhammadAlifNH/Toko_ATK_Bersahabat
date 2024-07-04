<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\Rule;


class AuthController extends Controller
{
    public function showRegistrationForm()
    {
        return view('auth.register');
    }

    public function register(Request $request)
    {
        // dd($request->all());
        $validator = Validator::make($request->all(), [
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users',
            'password' => 'required|string|min:8|confirmed',
            'TTL' => 'required|date',
            'jenis_kelamin' => 'required|in:L,P',
        ]);
    
        if ($validator->fails()) {
            return redirect()->back()
                            ->withErrors($validator)
                            ->withInput()
                            ->with('error', 'Data sudah pernah digunakan. Silahkan login atau gunakan data lainnya.');
        }
    
        User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
            'TTL' => $request->TTL,
            'jenis_kelamin' => $request->jenis_kelamin,
            'status' => 0, // Default to user
        ]);
    
        return redirect()->route('login')->with('success', 'Registration successful. Please login.');
    }
    public function showLoginForm()
    {
        return view('auth.login');
    }
    public function login(Request $request)
   {
    $credentials = $request->only('login', 'password');

    // Check if the login is an email or name
    $fieldType = filter_var($request->login, FILTER_VALIDATE_EMAIL) ? 'email' : 'name';

    $credentials = [
        $fieldType => $request->login,
        'password' => $request->password,
    ];

    if (Auth::attempt($credentials)) {
        $user = Auth::user();

        if ($user->status == 0) {
            return redirect()->route('dashboard'); // Redirect ke dashboard user
        } elseif ($user->status == 1) {
            return redirect()->route('admin.dashboard'); // Redirect ke dashboard admin
        }
        elseif ($user->status == 2) {
            return redirect()->route('admin.dashboard'); // Redirect ke dashboard admin
        }
    } else {
        return redirect()->back()->with('error', 'Data yang anda masukkan belum terdaftar,silahkan register terlebih dahulu.')->withInput();
    }
    }
    public function dashboard()
    {
        return view('dashboard');
    }

    public function adminDashboard()
    {
        return view('admin.dashboard');
    }

    public function logout(Request $request)
    {
        Auth::logout();
        return redirect()->route('login');
    }
}



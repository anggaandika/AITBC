<?php

namespace App\Http\Controllers;

//import Model "User
use App\Models\User;

//return type View
use Illuminate\View\View;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
//return type redirectResponse
use Illuminate\Http\RedirectResponse;

use Illuminate\Http\Request;

class LoginController extends Controller
{
    public function index(): View
    {
        return view('login');
    }
  
    public function loginPost(Request $request): RedirectResponse
    {
        $credentials = $request->validate([
            'email' => 'required|email',
            'password' => 'required'
        ]);
        
        if (!Auth::attempt($credentials)) {
            return redirect()->back()->with('Email or Password salah!');
        }
        $request->session()->regenerate();
        return redirect()->intended('home');
    }

    public function register(): View
    {
        return view('register');
    }
  
    public function registerPost(Request $request): RedirectResponse
    {
        //validate form
        $this->validate($request, [
            'name'     => 'required|min:5',
            'email'     => 'required|min:5',
            'password'   => 'required|min:3',
        ]);
        User::create([
            // 'image'     => $image->hashName(),
            'name'     => $request->name,
            'email'     => $request->email,
            'password'   => Hash::make($request->password),
            'level'   => 'user'
        ]);
        return redirect()->route('login');
    }
    public function logout()
    {
        Auth::logout();
        request()->session()->invalidate();
        request()->session()->regenerateToken();
        return redirect('/');
    }
}

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
  
    public function store(Request $request): RedirectResponse
    {
        $this->validate($request, [
            'email' => 'required|email',
            'password' => 'required'
        ]);
  
        if (!Auth::attempt($request->only('email', 'password'), $request->boolean('remember'))) {
            throw ValidationException::withMessages([
                'email' => trans('auth.failed')
            ]);
        }
        $request->session()->regenerate();
        return redirect()->route('user.index')->with(['success' => 'Data Berhasil Disimpan!']);
    }

    public function register(): View
    {
        return view('register');
    }
  
    public function registers(Request $request): RedirectResponse
    {
        $this->validat($request, [
            'name' => 'required',
            'email' => 'required|email',
            'password' => 'required|confirmed'
        ])->validate();
  
        User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
            'level' => 'User'
        ]);
  
        return redirect()->route('auth.index');
    }
  
    public function show(Request $request): RedirectResponse
    {
        Auth::guard('web')->logout();
        $request->session()->invalidate();
        return redirect()->route('auth.index');
    }
 
    // public function profile()
    // {
    //     return view('profile');
    // }
}

<?php

namespace App\Http\Controllers;

//import Model "User
use App\Models\Penyakit;
use App\Models\Gejala;
use App\Models\Kasus;
use DB;
//return type View
use Illuminate\View\View;
//return type redirectResponse
use App\Http\Controllers\Controller;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Http\Request;

class UserChekingPenyakit extends Controller
{
    
    /**
     * index
     *
     * @return View
     */
    public function index()
    {
        return view('page.main');
    }

    /**
     * index
     *
     * @return View
     */
    
     public function informasi()
     {
         //get posts
        $posts = Kasus::all();
         //render view with posts
         return view('page.table', compact('posts'));
     }
    public function konsultasi()
    {
        //get posts
        $posts = Gejala::all();
        //render view with posts
        return view('page.table', compact('posts'));
    }

}

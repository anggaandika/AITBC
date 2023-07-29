<?php

namespace App\Http\Controllers;

//import Model "User
use App\Models\GejalaPenyakit;
use App\Models\JenisPenyakit;
use App\Models\Gejala;
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
    public function konsultasi()
    {
        //get posts
        $posts = Gejala::all();
        //render view with posts
        return view('pu.table', compact('posts'));
    }

}

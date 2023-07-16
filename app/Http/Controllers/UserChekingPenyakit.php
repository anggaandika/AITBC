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
        if (Auth::check()) {
            //get posts
            $posts = $data = DB::table('gejala_penyakits')
            ->join('gejalas', 'gejalas.kode', '=', 'gejala_penyakits.gejala')
            ->join('jenis_penyakits', 'jenis_penyakits.kode', '=', 'gejala_penyakits.penyakit')
            ->get();
            //render view with posts
            return view('page.main', compact('posts'));
        } else {
            return redirect()->route('auth.index');
        }
    }

}

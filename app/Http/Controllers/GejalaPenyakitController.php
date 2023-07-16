<?php

namespace App\Http\Controllers;

//import Model "User
use App\Models\GejalaPenyakit;
use App\Models\JenisPenyakit;
use App\Models\Gejala;

use App\Http\Controllers\Controller;
//return type redirectResponse
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Auth;

use Illuminate\Http\Request;

class GejalaPenyakitController extends Controller
{    
    //
    /**
     * index
     *
     * @return View
     */
    public function index()
    {
        //get posts
        $posts = GejalaPenyakit::all();
        if (Auth::check()) {
            //render view with posts
            return view('gejalapenyakit.table', compact('posts'));
        } else {
            return redirect()->route('auth.index');
        }
    }
        /**
     * create
     *
     * @return View
     */
    public function create()
    {
        $gejalas = Gejala::all();
        $penyakits = JenisPenyakit::all();
        return view('gejalapenyakit.add', compact('gejalas','penyakits'));
    }
    
    /**
     * store
     *
     * @param  mixed $request
     * @return RedirectResponse
     */
    public function store(Request $request): RedirectResponse
    {
        //validate form
        $this->validate($request, [
            'penyakit'     => 'required|min:1',
            'gejala'     => 'required|min:1',
        ]);

        //create post
        GejalaPenyakit::create([
            'penyakit'     => $request->penyakit,
            'gejala'     => $request->gejala,
        ]);

        //redirect to index
        return redirect()->route('gejalapenyakit.index')->with(['success' => 'Data Berhasil Disimpan!']);
    }
    
    /**
     * edit
     *
     * @param  mixed $id
     * @return View
     */
    public function edit(string $kode): View
    {
        //get post by ID
        $post = GejalaPenyakit::where('kode', $kode)->firstorfail();

        //render view with post
        return view('gejalapenyakit.edit', compact('post'));
    }
    
    /**
     * update
     *
     * @param  mixed $request
     * @param  mixed $id
     * @return RedirectResponse
     */
    public function update(Request $request, $kode): RedirectResponse
    {
        //validate form
        $this->validate($request, [
            'penyakit'     => 'required|min:1',
            'gejala'     => 'required|min:1',
        ]);

        //get post by ID
        GejalaPenyakit::where('kode', $kode)->update([
            'penyakit'     => $request->penyakit,
            'gejala'     => $request->gejala,
        ]);
        //redirect to index
        return redirect()->route('gejalapenyakit.index')->with(['success' => 'Data Berhasil Diubah!']);
    }

    public function destroy($kode): RedirectResponse
    {
        //get post by ID delete post
        GejalaPenyakit::where('id', $kode)->delete();

        //redirect to index
        return redirect()->route('gejalapenyakit.index')->with(['success' => 'Data Berhasil Dihapus!']);
    }
    
    public function check()
    {
        return ! is_null($this->user());
    }
}

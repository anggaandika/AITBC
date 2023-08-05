<?php

namespace App\Http\Controllers;

//import Model "User
use App\Models\Penyakit;
use App\Models\Gejala;
use App\Models\Kasus;

use App\Http\Controllers\Controller;
//return type redirectResponse
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Auth;

use Illuminate\Http\Request;

class KasusController extends Controller
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
        $posts = Kasus::all();
        //render view with posts
        return view('kasus.table', compact('posts'));
    }
        /**
     * create
     *
     * @return View
     */
    public function create()
    {
        $gejalas = Gejala::all();
        $penyakits = Penyakit::all();
        return view('kasus.add', compact('gejalas','penyakits'));
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
        Kasus::create([
            'penyakit'     => $request->penyakit,
            'gejala'     => $request->gejala,
        ]);

        //redirect to index
        return redirect()->route('kasus.index')->with(['success' => 'Data Berhasil Disimpan!']);
    }
    
    /**
     * edit
     *
     * @param  mixed $id
     * @return View
     */
    public function edit(string $kode): View
    {
        $gejalas = Gejala::all();
        $penyakits = Penyakit::all();
        //get post by ID
        $post = Kasus::where('kode', $kode)->firstorfail();

        //render view with post
        return view('kasus.edit', compact('post','gejalas','penyakits'));
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
        Kasus::where('kode', $kode)->update([
            'penyakit'     => $request->penyakit,
            'gejala'     => $request->gejala,
        ]);
        //redirect to index
        return redirect()->route('kasus.index')->with(['success' => 'Data Berhasil Diubah!']);
    }

    public function destroy($kode): RedirectResponse
    {
        //get post by ID delete post
        Kasus::where('id', $kode)->delete();

        //redirect to index
        return redirect()->route('gejalakasuspenyakit.index')->with(['success' => 'Data Berhasil Dihapus!']);
    }
    
    public function check()
    {
        return ! is_null($this->user());
    }
}

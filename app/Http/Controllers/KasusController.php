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
            'inputs.*.penyakit'     => 'required',
            'inputs.*.gejala'     => 'required',
            'inputs.*.bobot'     => 'required',
        ]);
        //create post
        foreach ($request->inputs as $key => $value) {
            Kasus::create([
                'penyakit'     => $value['penyakit'],
                'gejala'     => $value['gejala'],
                'bobot'     => str_replace(",",".",($value['bobot'] / 10)) ,
            ]);
        }

        //redirect to index
        return redirect()->route('kasus.index')->with(['success' => 'Data Berhasil Disimpan!']);
    }
    
    /**
     * edit
     *
     * @param  mixed $id
     * @return View
     */
    public function edit(string $id)
    {
        $gejalas = Gejala::all();
        $penyakits = Penyakit::all();
        //get post by ID
        $post = Kasus::findOrFail($id);

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
            'bobot'     => 'required',
        ]);

        //get post by ID
        $post = User::findOrFail($kode);
        
        $post->update([
            'penyakit'     => $request->penyakit,
            'gejala'     => $request->gejala,
            'bobot'     => str_replace(",",".",($request->bobot / 10)),
        ]);
        //redirect to index
        return redirect()->route('kasus.index')->with(['success' => 'Data Berhasil Diubah!']);
    }

    public function destroy($kode): RedirectResponse
    {
        //get post by ID delete post
        Kasus::where('id', $kode)->delete();

        //redirect to index
        return redirect()->route('kasus.index')->with(['success' => 'Data Berhasil Dihapus!']);
    }
    
    public function check()
    {
        return ! is_null($this->user());
    }
}

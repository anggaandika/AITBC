<?php

namespace App\Http\Controllers;

//import Model "User
use App\Models\Gejala;

//return type View
use Illuminate\View\View;
//return type redirectResponse
use App\Http\Controllers\Controller;
//return type redirectResponse
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Auth;

use Illuminate\Http\Request;

class GejalaController extends Controller
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
        $posts = Gejala::all();
        //render view with posts
        return view('gejala.table', compact('posts'));
    }

    /**
     * create
     *
     * @return View
     */
    public function create(): View
    {
        return view('gejala.add');
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
            'kode'     => 'required|min:1',
            'name'     => 'required|min:1',
        ]);

        //create post
        Gejala::create([
            // 'image'     => $image->hashName(),
            'kode'     => $request->kode,
            'name'     => $request->name,
        ]);

        //redirect to index
        return redirect()->route('gejala.index')->with(['success' => 'Data Berhasil Disimpan!']);
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
        $post = Gejala::where('kode', $kode)->firstorfail();

        //render view with post
        return view('gejala.edit', compact('post'));
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
            'kode'     => 'required|min:1',
            'name'     => 'required|min:1',
        ]);

        //get post by ID
        Gejala::where('kode', $kode)->update([
            'kode'     => $request->kode,
            'name'     => $request->name,
        ]);
        //redirect to index
        return redirect()->route('gejala.index')->with(['success' => 'Data Berhasil Diubah!']);
    }

    public function destroy($kode): RedirectResponse
    {
        //get post by ID delete post
        Gejala::where('kode', $kode)->delete();

        //redirect to index
        return redirect()->route('gejala.index')->with(['success' => 'Data Berhasil Dihapus!']);
    }
    
    public function check()
    {
        return ! is_null($this->user());
    }
}

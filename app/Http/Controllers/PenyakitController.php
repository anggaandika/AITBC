<?php

namespace App\Http\Controllers;

//import Model "User
use App\Models\JenisPenyakit;

//return type View
use Illuminate\View\View;
//return type redirectResponse
use App\Http\Controllers\Controller;
//return type redirectResponse
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Auth;

use Illuminate\Http\Request;

class PenyakitController extends Controller
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
        $posts = JenisPenyakit::all();

        if (Auth::check()) {
            //render view with posts
            return view('penyakit.table', compact('posts'));
        } else {
            return redirect()->route('auth.index');
        }
    }

    /**
     * create
     *
     * @return View
     */
    public function create(): View
    {
        return view('penyakit.add');
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
        JenisPenyakit::create([
            // 'image'     => $image->hashName(),
            'kode'     => $request->kode,
            'name'     => $request->name,
        ]);

        //redirect to index
        return redirect()->route('penyakit.index')->with(['success' => 'Data Berhasil Disimpan!']);
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
        $post = JenisPenyakit::where('kode', $kode)->firstorfail();

        //render view with post
        return view('penyakit.edit', compact('post'));
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
        $post = JenisPenyakit::where('kode', $kode)->update([
            'kode'     => $request->kode,
            'name'     => $request->name,
        ]);

        //redirect to index
        return redirect()->route('penyakit.index')->with(['success' => 'Data Berhasil Diubah!']);
    }

    public function destroy($kode): RedirectResponse
    {
        //get post by ID delete post
        $post = JenisPenyakit::where('kode', $kode)->delete();

        //redirect to index
        return redirect()->route('penyakit.index')->with(['success' => 'Data Berhasil Dihapus!']);
    }
    
    public function check()
    {
        return ! is_null($this->user());
    }
}

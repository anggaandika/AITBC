<?php

namespace App\Http\Controllers;

// use App\Http\Controllers\Controller;

//import Model "User
use App\Models\User;
//return type View
use Illuminate\View\View;
//return type redirectResponse
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Http\Request;

class UserController extends Controller
{
    /**
     * index
     *
     * @return View
     */
    public function index()
    {
        //get posts
        $posts = User::all();
        //render view with posts
        return view('user.table', compact('posts'));
    }

    /**
     * create
     *
     * @return View
     */
    public function create(): View
    {
        return view('user.add');
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
            // 'image'     => 'required|image|mimes:jpeg,jpg,png|max:2048',
            'name'     => 'required|min:5',
            'email'     => 'required|min:5',
            'password'   => 'required|min:3',
            'level'   => 'required'
        ]);

        //upload image
        // $image = $request->file('image');
        // $image->storeAs('public/posts', $image->hashName());

        //create post
        User::create([
            // 'image'     => $image->hashName(),
            'name'     => $request->name,
            'email'     => $request->email,
            'password'   => Hash::make($request->password),
            'level'   => $request->level
        ]);

        //redirect to index
        return redirect()->route('user.index')->with(['success' => 'Data Berhasil Disimpan!']);
    }

   
    /**
     * edit
     *
     * @param  mixed $id
     * @return View
     */
    public function edit(string $id): View
    {
        //get post by ID
        $post = User::findOrFail($id);

        //render view with post
        return view('user.edit', compact('post'));
    }
    
    /**
     * update
     *
     * @param  mixed $request
     * @param  mixed $id
     * @return RedirectResponse
     */
    public function update(Request $request, $id): RedirectResponse
    {
        //validate form
        $this->validate($request, [
            'name'     => 'required|min:5',
            'email'     => 'required|min:5',
            'password'   => 'required|min:3',
            'level'   => 'required'
        ]);

        //get post by ID
        $post = User::findOrFail($id);

        //check if image is uploaded
        // if ($request->hasFile('image')) {

            //upload new image
            // $image = $request->file('image');
            // $image->storeAs('public/posts', $image->hashName());

            //delete old image
            // Storage::delete('public/posts/'.$post->image);

            //update post with new image
            // $post->update([
            //     'name'     => $request->name,
            //     'email'     => $request->email,
            //     'password'   => Hash::make($request->password),
            //     'level'   => $request->level
            // ]);

        // } else {

            //update post without image
            $post->update([
                'name'     => $request->name,
                'email'     => $request->email,
                'password'   => Hash::make($request->password),
                'level'   => $request->level
            ]);
        // }

        //redirect to index
        return redirect()->route('user.index')->with(['success' => 'Data Berhasil Diubah!']);
    }

    public function destroy($id): RedirectResponse
    {
        //get post by ID
        $post = User::findOrFail($id);

        //delete image
        // Storage::delete('public/posts/'. $post->image);

        //delete post
        $post->delete();

        //redirect to index
        return redirect()->route('user.index')->with(['success' => 'Data Berhasil Dihapus!']);
    }
    
    public function kehalamanLogin(): RedirectResponse
    {
        return redirect()->route('auth.index')->with(['success' => 'Data Berhasil Dihapus!']);
    }
}

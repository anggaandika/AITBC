<?php

namespace App\Http\Controllers;

//import Model "User
use App\Models\Penyakit;
use App\Models\Gejala;
use App\Models\Kasus;
use App\Models\Bobot;
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
        $posts = Penyakit::all();
         //render view with posts
         return view('page.informasi.table', compact('posts'));
     }
    public function konsultasi()
    {
        //get posts
        $posts = Gejala::all();
        $bobots = Bobot::all();
        //render view with posts
        return view('page.konsultasi.table', compact('posts','bobots'));
    }
    public function datadiri(Request $request): RedirectResponse
    {
        //validate form
        $this->validate($request, [
            // 'image'     => 'required|image|mimes:jpeg,jpg,png|max:2048',
            'name'     => 'required|min:5',
            'email'     => 'required|min:5',
            'password'   => 'required|min:3',
            'level'   => 'required'
        ]);
        //create post
        User::create([
            // 'image'     => $image->hashName(),
            'name'     => $request->name,
            'email'     => $request->email,
            'password'   => Hash::make($request->password),
            'level'   => $request->level
        ]);

        //redirect to index
        return view('page.konsultasi.table', compact('posts','bobots'));
    }
    public function konsultasiPost(Request $request)
    {
        $result = $this->kalkulasiTBC($request->inputs);
        //redirect to index
        dd($result);
        return view('page.main', compact('result'));
    }
    function kalkulasiTBC($data)
    {
        $data_penyakit = [];
        $gejala_terpilih = [];
        foreach($data as $input) {
            if(!empty($input)) {
                $opts = $input['kode'];
                $kasuss = Kasus::where('gejala',$opts)->get();
                foreach ($kasuss as $kasus) {
                    $penyakits = Penyakit::where('kode',$kasus->penyakit)->get();
                    $gejalas = Gejala::where('kode',$kasus->gejala)->get();
                    foreach ($penyakits as $penyakit) {
                        if(empty($data_penyakit[$kasus->id])){
                            $data_penyakit[$kasus->id] = [$penyakit, [$gejalas, $input['milih'], $kasus->bobot]];
                        } else {
                            array_push($data_penyakit[$kasus->id], [$gejalas, $input['milih'], $kasus->bobot]);
                        }
                    }
                    foreach ($gejalas as $gejala) {
                        if(empty($gejala_terpilih[$gejala->kode])) {
                            $gejala_terpilih[$gejala->kode] = [
                                'nama' => $gejala->name,
                                'kode' => $gejala->kode,
                                'keyakinan' => $input['milih']
                            ];
                        }
                    }
                }
            }
        }
        $hasil_diagnosa = [];
        $cf_max = null;
        foreach ($data_penyakit as $final) {
            if(count($final) < 2) {
                continue;
            }

            $cf1 = null;
            $cf2 = null;
            $cf_combine = 0;
            $hasil_cf = null;
            
            foreach ($final as $key => $value) {
                if($key == 0) {
                    continue;
                }
                if($key == 1) {
                    $cf1 = $final[$key][2] * $final[$key][1];
                } else {
                    if($cf_combine != 0) {
                        $cf1 = $cf_combine;
                        $cf2 = $final[$key][2] * $final[$key][1];
                        if($cf1 < 0 || $cf2 < 0) {
                            $cf_combine = ($cf1 + $cf2) / (1 - min($cf1, $cf2));
                        } else {
                            $cf_combine = $cf1 + ($cf2 * (1 - $cf1));
                        }
                        $hasil_cf = $cf_combine;
                    } else {
                        $cf2 = $final[$key][2] * $final[$key][1];
                        if($cf1 < 0 || $cf2 < 0) {
                            $cf_combine = ($cf1 + $cf2) / (1 - min($cf1, $cf2));
                        } else {
                            $cf_combine = $cf1 + ($cf2 * (1 - $cf1));
                        }
                        $hasil_cf = $cf_combine;
                    }
                }
                if(count($final) - 1== $key) {
                    if($cf_max == null) {
                        $cf_max = [$hasil_cf, "{$final[0]->name} ({$final[0]->kode})"];
                    } else {
                        $cf_max = ($hasil_cf > $cf_max[0]) 
                            ? [$hasil_cf, "{$final[0]->name} ({$final[0]->kode})"] 
                            : $cf_max;
                    }

                    $hasil_diagnosa[$final[0]->kode]['hasil_cf'] = $hasil_cf;

                    $cf1 = null;
                    $cf2 = null;
                    $cf_combine = 0;
                    $hasil_cf = null;
                }
                
                if(empty($hasil_diagnosa[$final[0]->kode])) {
                    $hasil_diagnosa[$final[0]->kode] = [
                        'nama_penyakit' => $final[0]->name,
                        'kode_penyakit' => $final[0]->kode,
                        'gejala' => [
                            [
                                'nama' => $final[$key][0][0]->name,
                                'kode' => $final[$key][0][0]->kode,
                                'cf_user' => $final[$key][1],
                                'cf_role' => $final[$key][2],
                                'hasil_perkalian' => $final[$key][2] * $final[$key][1]
                            ]
                        ]
                    ];
                } else {          
                    array_push($hasil_diagnosa[$final[0]->kode], [
                        'nama' => $final[$key][0][0]->name,
                        'kode' => $final[$key][0][0]->kode,
                        'cf_user' => $final[$key][1],
                        'cf_role' => $final[$key][2],
                        'hasil_perkalian' => $final[$key][2] * $final[$key][1]
                    ]);
                }
            }
        }
        return [
            'hasil_diagnosa' => $hasil_diagnosa,
            'gejala_terpilih' => $gejala_terpilih,
            'cf_max' => $cf_max
        ];
    }



    public function add(Request $request)
    {
        if($request->ajax())
        {
            // Submitted books
            $books = $request->books;

            // Book records to be saved
            $book_records = [];

            // Add needed information to book records
            foreach($books as $book)
            {
                if(! empty($book))
                {
                    // Get the current time
                    $now = Carbon::now();

                    // Formulate record that will be saved
                    $book_records[] = [
                        'name' => $book,
                        'user_id' => Auth::user()->id,
                        'updated_at' => $now,  // remove if not using timestamps
                        'created_at' => $now   // remove if not using timestamps
                    ];
                }
            }

            // Insert book records
            Book::insert($book_records);
        }
    }
}

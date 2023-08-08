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

class DiagnosaController extends Controller
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
        $berats = Bobot::all();
        //render view with posts
        return view('page.konsultasi.table', compact('posts','berats'));
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
        dd($result);
        //redirect to index
        return view('page.main', compact('result'));
    }
    function kalkulasiTBC($data)
    {
        // dd($data);
        $data_penyakit = [];
        $gejala_terpilih = [];
        foreach($data as $input) {
            if(!empty($input)) {
                $opts = $input['kode'];
                $kasus = Kasus::where('gejala', $opts)->get();
                foreach($kasus as $penyakit) {
                    if(empty($data_penyakit[$penyakit->id])){
                        $data_penyakit[$penyakit->id] = [$penyakit, [$kasus, $input['milih'], $penyakit->bobot]];
                    } else {
                        array_push($data_penyakit[$penyakit->id], [$kasus, $input['milih'], $penyakit->bobot]);
                    }
                    if(empty($gejala_terpilih[$penyakit->gejala])) {
                        $gejala_terpilih[$penyakit->gejala] = [
                            'kode' => $penyakit->gejala,
                            'keyakinan' => $input['milih']
                        ];
                    }
                }
            }
        }
        $hasil_diagnosa = [];
        $cf_max = null;
        foreach ($data_penyakit as $final) {

            $dg1 = null;
            $dg2 = null;
            $dgcombine = 0;
            $hasildg = null;
            
            foreach ($final as $key => $value) {
                if($key == 0) {
                    continue;
                }
                if($key == 1) {
                    $dg1 = $final[$key][2] * $final[$key][1];
                    $dg2 = $final[$key][2];
                } else {
                    if($dgcombine != 0) {
                        $dg1 = $dg1[$key][2] +($final[$key][2] * $final[$key][1]);
                        $dg2 = $dg2 + $final[$key][2];
                    } else {
                        $dg1 = $dg1[$key][2] +($final[$key][2] * $final[$key][1]);
                        $dg2 = $dg2 + $final[$key][2];
                    }
                }
                
                if(empty($hasil_diagnosa[$final[0]->id])) {
                    $hasil_diagnosa[$final[0]->id] = [
                        'penyakit' => $final[0]->penyakit,
                        'gejala' => [
                            [
                                'gejala' => $final[$key][0][0]->gejala,
                                'cf_user' => $final[$key][1],
                                'cf_role' => $final[$key][2],
                                'hasil_perkalian' => $final[$key][2] * $final[$key][1]
                            ]
                        ]
                    ];
                } else {          
                    array_push($hasil_diagnosa[$final[0]->kode], [
                        'gejala' => $final[$key][0][0]->gejala,
                        'cf_user' => $final[$key][1],
                        'cf_role' => $final[$key][2],
                        'hasil_perkalian' => $final[$key][2] * $final[$key][1]
                    ]);
                }
            }
        }
        // dd($hasil_diagnosa);
        $predic_penyakit = null;
        $predic_penyakit2 = null;
        $hasil_perkalian = 0;
        $hasil_pertambahan = 0;
        $hasil_logic = null;
        foreach ($hasil_diagnosa as $key => $value) {
            if (empty($predic_penyakit)) {
                $predic_penyakit = $value['penyakit'];
            } else {
                if ($predic_penyakit == $value['penyakit']) {
                    $hasil_perkalian = $hasil_perkalian + $value['gejala'][0]['hasil_perkalian'];
                    $hasil_pertambahan = $hasil_pertambahan + $value['gejala'][0]['cf_role'];
                } else {
                    $hasil_logic[$value['penyakit']] = ['hasil_perkalian'=>$hasil_perkalian,'hasil_pertambahan'=>$hasil_pertambahan];
                    $predic_penyakit = $value['penyakit'];
                }
            }
        }
        dd($hasil_logic);
        $dgcombine = $dg1 / $dg2 ;
        $hasildg = $dgcombine;
        $final_logic =[];
        $index= 0;
        foreach ($hasil_logic as $key => $value) {
            $final_logic[$index] = ['hasil_logic'=> $value['hasil_perkalian'] / $value['hasil_pertambahan'],'penyakit'=> $key];
            $index++;
        }
        foreach ($final_logic as $key => $value) {
            if($cf_max == null) {
                $cf_max = [$value['hasil_logic'], $value['penyakit']];
            } else {
                $cf_max = ($hasildg > $cf_max[0]) 
                    ? [$value['hasil_logic'] , $value['penyakit']] 
                    : $cf_max;
            }
            $hasil_diagnosa[$final[0]->id]['hasildg'] = $hasildg;
        }
        return [
            'hasil_diagnosa' => $final_logic,
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

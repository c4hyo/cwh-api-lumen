<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;

class PostingController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        //
    }
    public function index()
    {
        // $posting_kegiatan = DB::table('posting_kegiatan')->get();
        $posting_kegiatan = DB::table('pengguna')
            ->join('posting_kegiatan','pengguna.id','=','posting_kegiatan.pengguna_id')
            ->select('pengguna.nama','posting_kegiatan.*')
            ->get();
        return response()->json($posting_kegiatan, 200);
    }
    public function create(Request $request)
    {
        $posting_kegiatan = DB::table('posting_kegiatan')->insert([
            'judul' => $request->input('judul'),
            'pengguna_id' => $request->input('pengguna_id'),
            'deskripsi' => $request->input('deskripsi'),
            'thumbnail' => $request->input('thumbnail'),
            'tanggal_posting' => $request->input('tanggal_posting'),
        ]);
        return response()->json(201);
    }
    public function detail($id)
    {
        $posting_kegiatan = DB::table('posting_kegiatan')->find($id);
        return response()->json($posting_kegiatan, 200);
    }
    function delete($id)
    {
        $posting_kegiatan =  DB::table('posting_kegiatan')->delete($id);
        return response()->json(201);
    }

    public function update(Request $request,$id)
    {
        $posting_kegiatan = DB::table('posting_kegiatan')->where('id',$id)->update([
            'judul' => $request->input('judul'),
            'deskripsi' => $request->input('deskripsi'),
            'thumbnail' => $request->input('thumbnail'),
            'tanggal_posting' => $request->input('tanggal_posting'),
        ]);
        return response()->json(200);
    }
    public function postBy($id)
    {
        $posting_kegiatan = DB::table('posting_kegiatan')->where('pengguna_id',$id)->get();
        return response()->json($posting_kegiatan, 200);
    }

    //
}

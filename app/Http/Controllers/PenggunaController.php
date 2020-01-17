<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\DB;
// use Illuminate\Support\Facades\Hash;
use Illuminate\Http\Request;

class PenggunaController extends Controller
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
    public function login(Request $request)
    {
        $sandi = md5(md5($request->input('sandi')));
        $pengguna = DB::table('pengguna')->where('email',$request->input('email'))->get();
        $banyak = count($pengguna);
        if($banyak = 1){
            $pengguna = DB::table('pengguna')->where('email',$request->input('email'))->first();
            if($sandi == $pengguna->sandi){
                return response()->json($pengguna, 200);
            }else{
                return response()->json(401);
            }
        }else{
            return response()->json(401);
        }
    }
    public function index()
    {
        $pengguna = DB::table('pengguna')->get();
        return response()->json($pengguna, 200);
    }
    public function indexVolunteer()
    {
        $pengguna = DB::table('pengguna')->where('role','volunteer')->get();
        return response()->json($pengguna, 200);
    }
    public function indexAdmin()
    {
        $pengguna = DB::table('pengguna')->where('role','admin')->get();
        return response()->json($pengguna, 200);
    }
    public function createVolunteer(Request $request)
    {
        $pengguna = DB::table('pengguna')->insert([
            'nama' => $request->input('nama'),
            'email' => $request->input('email'),
            'telepon' => $request->input('telepon'),
            'alamat' => $request->input('alamat'),
            'jenis_kelamin' => $request->input('jenis_kelamin'),
            'tempat_lahir' => $request->input('tempat_lahir'),
            'tanggal_lahir' => $request->input('tanggal_lahir'),
            'id_line' => $request->input('id_line'),
            'role' => 'volunteer',
        ]);
        return response()->json(201);
    }
    public function createAdmin(Request $request)
    {
        $pengguna = DB::table('pengguna')->insert([
            'nama' => $request->input('nama'),
            'email' => $request->input('email'),
            'telepon' => $request->input('telepon'),
            'alamat' => $request->input('alamat'),
            'jenis_kelamin' => $request->input('jenis_kelamin'),
            'tempat_lahir' => $request->input('tempat_lahir'),
            'tanggal_lahir' => $request->input('tanggal_lahir'),
            'id_line' => $request->input('id_line'),
            'role' => 'admin',
        ]);
        return response()->json(201);
    }
    public function detail($id)
    {
        $pengguna = DB::table('pengguna')->find($id);
        return response()->json($pengguna, 200);
    }
    function delete($id)
    {
        $pengguna =  DB::table('pengguna')->delete($id);
        return response()->json(201);
    }

    public function update(Request $request,$id)
    {
        // return response()->json($request->input('nama'), 200);
        $pengguna = DB::table('pengguna')->where('id',$id)->update([
            'nama' => $request->input('nama'),
            'email' => $request->input('email'),
            'telepon' => $request->input('telepon'),
            'alamat' => $request->input('alamat'),
            'jenis_kelamin' => $request->input('jenis_kelamin'),
            'tempat_lahir' => $request->input('tempat_lahir'),
            'tanggal_lahir' => $request->input('tanggal_lahir'),
            'id_line' => $request->input('id_line'),
        ]);
        return response()->json(200);
    }
    public function changePass(Request $request,$id)
    {
        $sandi = md5(md5($request->input('sandi')));
        $pengguna = DB::table('pengguna')->where('id',$id)->get();
        $banyak = count($pengguna);
        if($banyak = 1){
            $pengguna = DB::table('pengguna')->where('id',$id)->update([
                'sandi'=>$sandi
            ]);
            return response()->json(201);
        }else{
            return response()->json(401);
        }
    }

    //
}

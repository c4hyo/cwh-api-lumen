<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;

class EventController extends Controller
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
        $event = DB::table('event')->get();
        return response()->json($event, 200);
    }
    public function create(Request $request)
    {
        $event = DB::table('event')->insert([
            'judul' => $request->input('judul'),
            'tanggal_pelaksanaan' => $request->input('tanggal_pelaksanaan'),
            'deskripsi' => $request->input('deskripsi'),
            'thumbnail' => $request->input('thumbnail'),
            'jenis_event' => $request->input('jenis_event'),
        ]);
        return response()->json(201);
    }
    public function detail($id)
    {
        $event = DB::table('event')->find($id);
        return response()->json($event, 200);
    }
    function delete($id)
    {
        $event =  DB::table('event')->delete($id);
        return response()->json(201);
    }

    public function update(Request $request,$id)
    {
        $event = DB::table('event')->where('id',$id)->update([
            'judul' => $request->input('judul'),
            'tanggal_pelaksanaan' => $request->input('tanggal_pelaksanaan'),
            'deskripsi' => $request->input('deskripsi'),
            'thumbnail' => $request->input('thumbnail'),
            'jenis_event' => $request->input('jenis_event'),
        ]);
        return response()->json(200);
    }

    //
}

<?php
namespace App\Http\Controllers;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;
class DosenController extends Controller {
    private $dbmk;
    // $this->$dbmk = DB::table('matakuliah');
    public function __construct(){
       // $this->$dbmk = app('db')->table('matakuliah');
       $dbmk = DB::table('matakuliah'); // error tidak terdefinisi

     // return $this->$dbmk;
    }
    public function getAll(){
        $res = DB::select('select * from matakuliah');

        return response()->json($res);
    }

    public function getOne($id){
        $getid = DB::table('matakuliah')->find($id);
        //$getid = $this->$dbmk->find($id);
        if(!$getid){
            return response()->json([
                'status' => 'error',
                'message' => 'Matkul '.$id.'tidak ditemukan'
            ], 404);
        }
        return response()->json($getid);
    }
    public function deleteOne($id){
        $delmk = DB::table('matakuliah')->where('id', $id)->delete();
        if($delmk == 0){
            return response()->json([
                'status' => 'error',
                'message' => '404 Not found'
            ]);
        }

        return response()->json([
            'status' => 'success',
            'message' => 'id has been deleted'
        ]);
    }
    public function addOne(Request $request){
        $ins = DB::table('matakuliah')->insertGetId([
            'id' => $request->input('id'),
            'nama' => $request->input('nama'),
            'sks' => $request->input('sks'),
            'dosen' => $request->input('dosen'),
        ]);
        return response()->json([
            'status' => 'success',
            'message' => 'Successful added matkul',
            'id' => $ins
        ]);
    }
    public function updateOne(Request $request, $id){
    $update = [

    ];
    DB::table('matakuliah')->where('id', $id)->update(['id' => $request->input('id'),
    'nama' => $request->input('nama'),
    'sks' => $request->input('sks'),
    'dosen' => $request->input('dosen')]);



    /*   if($updatemk == 0){
        return response()->json([
            'status' => 'error',
            'message' => 'id doesnt exist '],404);
        }*/


    return redirect ('getAll');
}
}

<?php

namespace App\Http\Controllers;
use App\Models\Kelas;
use App\Models\Siswa;
use Illuminate\Http\Request;
use Illuminate\Database\Eloquent\ModelNotFoundException;

class KelasController extends Controller {
    public function getByID($id){
        return Kelas::findOrFail($id);
    }
    public function all(){
        return Kelas::all();
    }
    public function deleteKelas($id){
        try {
            $resp = Kelas::findOrFail($id)->delete();
            return response(['status' => $resp, "message" => 'Record Has been deleted successfully'], 200);
        } catch(ModuleNotFoundException $e){
            return response(['status' => 'error', "message" => $e->getMessage()], 200);
        }
    }

}

<?php

namespace App\Http\Controllers;
use App\Models\Siswa;
use Illuminate\Http\Request;
use Illuminate\Database\Eloquent\ModelNotFoundException;


class SiswaController extends Controller {

   // public function showId($id){
   //     return User::findOrFail($id);
   // }

    public function getByID($id){
        return Siswa::findOrFail($id);
    }
    public function all(){
        return Siswa::all();
    }

    public function deleteSiswa($id){
        try {
            $resp = Siswa::findOrFail($id)->delete();
            return response(['status' => $resp, "message" => 'Record Has been deleted successfully'], 200);
        } catch(ModuleNotFoundException $e){
            return response(['status' => 'error', "message" => $e->getMessage()], 200);
        }
    }
    public function updateSiswa($id, Request $request){
        $response = array();
        $parameters = $request->all();

        $rules = array(
            'name' => 'required'
        );
        $siswa_name = $parameters['name'];

        $msg = array(
            'name.required' => 'name is required'
        );

        $siswa = Siswa::findOrFail($id);
        if(empty($siswa)){
            return response()->json(["error" => "Record not found"], 400);
        }

        $validator = \Validator::make(array('name' => $siswa_name), $rules, $msg);
        if(!$validator->fails()){
            $response = Siswa::create($parameters);
            return response()->json($response, 201);
        } else {
            $errors = $validator->$errors();
            return response()->json(['error' => 'Validation error(s) occured', "message" => $errors->all()], 400);
        }
    }


    public function createSiswa(Request $request){
        $response = array();
        $parameters = $request->all();

        $rules = array(
            'name' => 'required'
        );
        $siswa_name = $parameters['name'];

        $msg = array(
            'name.required' => 'name is required'
        );

        $validator = \Validator::make(array('name' => $siswa_name), $rules, $msg);
        if(!$validator->fails()){
            $response = Siswa::create($parameters);

            return response()->json($response, 201);
        } else {
            $errors = $validator->$errors();
            return response()->json(['error' => 'Validation error(s) occured', "message" => $errors->all()], 400);
        }
    }
}

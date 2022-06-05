<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class CekInputController extends Controller
{
    public function index(){
        return view('layout-admin.cek-input.index');
    }

    public function proses(Request $request){

        $cek =[];
        $input1 = strtolower($request['input1']);
        $input2 = strtolower($request['input2']);

        $splitInput1 = str_split($input1);
        $splitInput2 = str_split($input2);

        foreach ($splitInput1 as $value1) {
            foreach ( $splitInput2 as  $value2) {
                if ($value1 == $value2) {
                    array_push($cek, $value1);
                }
            }
        }

        $response = [
            'result' => count(array_unique($cek)),
            'count_input_1' => count($splitInput1),
            'percentage' => (count(array_unique($cek)) / count($splitInput1)) * 100
        ];

        return response()->json($response);
        
    }
}

<?php

namespace App\Http\Controllers;

use App\Gaji;
use App\Karyawan;
use Illuminate\Http\Request;

class GajiController extends Controller
{
    public function findGajiById($id){
        return Gaji::with([])
            ->find($id);
    }

    public function index(){
        $gaji = Gaji::with(['karyawan'])->get();
        return view('layout-admin.gaji.index', compact('gaji'));
    }

    public function formGaji($id = null){
        $gaji      = $this->findGajiById($id);
        $karyawan  = Karyawan::all();
        return view('layout-admin.gaji.form', compact('gaji', 'karyawan'));
    }

    public function saveGaji(Request $request, $id = null){
        $result = [
            'status'  => false,
            'message' => ''
        ];
        try {
            $gaji = $this->findGajiById($id);
            if (!$gaji) {
                $gaji         = new Gaji();
            }
            $gaji->karyawan_id   = $request->karyawan_id;
            $gaji->gaji          = $request->gaji;
            $gaji->save();

            $result['status']  = true;
            $result['message'] = 'save gaji success';
            return redirect('/admin/gaji')->with(['success' => $result['message']]);
        } catch (\exception $e) {
            $result['message'] = 'function saveGaji() fail => ' . $e->getMessage();
            return redirect()->back();
        }
    }

    public function deleteGaji($id){
        $result = [
            'status'  => false,
            'message' => ''
        ];
        try {
            $gaji = $this->findGajiById($id);
            if (!$gaji) {
                return 'data gaji not found';
            }
            $gaji->delete();

            $result['status']  = true;
            $result['message'] = 'delete data success';
            return redirect('/admin/gaji')->with(['success' => $result['message']]);
        } catch (\exception $e) {
            $result['message'] = 'function deleteGaji() fail => ' . $e->getMessage();
            return redirect()->back()->with(['error' => $result['message']]);
        }
    }
}

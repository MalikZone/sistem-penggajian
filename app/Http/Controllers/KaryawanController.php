<?php

namespace App\Http\Controllers;

use App\Karyawan;
use Illuminate\Http\Request;

class KaryawanController extends Controller
{

    public function findKaryawanById($id){
        return Karyawan::with([])
            ->find($id);
    }

    public function index(){
        $karyawan = Karyawan::all();
        return view('layout-admin.karyawan.index', compact('karyawan'));
    }

    public function formKaryawan($id = null){
        $karyawan = $this->findKaryawanById($id);
        return view('layout-admin.karyawan.form', compact('karyawan'));
    }

    public function saveKaryawan(Request $request, $id = null){
        $result = [
            'status'  => false,
            'message' => ''
        ];
        try {
            $karyawan = $this->findKaryawanById($id);
            if (!$karyawan) {
                $karyawan         = new Karyawan();
            }
            $karyawan->nama       = $request->nama;
            $karyawan->tgl_lahir  = $request->tgl_lahir;
            $karyawan->divisi     = $request->divisi;
            $karyawan->email      = $request->email;
            $karyawan->telepon    = $request->no_tlp;
            $karyawan->alamat     = $request->alamat;
            $karyawan->jender     = $request->jender;
            $karyawan->save();

            $result['status']  = true;
            $result['message'] = 'save karyawan success';
            return redirect('/admin/karyawan');
        } catch (\exception $e) {
            $result['message'] = 'function saveKaryawan() fail => ' . $e;
            return redirect()->back();
        }
    }

    public function deleteKaryawan($id){
        $karyawan = $this->findKaryawanById($id);
        if (!$karyawan) {
            return 'data karyawan not found';
        }
        $karyawan->delete();
    }

}

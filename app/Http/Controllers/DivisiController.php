<?php

namespace App\Http\Controllers;

use App\Divisi;
use Illuminate\Http\Request;

class DivisiController extends Controller
{
    public function findDivisiById($id){
        return Divisi::with([])
            ->find($id);
    }

    public function index(){
        $divisi = Divisi::all();
        return view('layout-admin.divisi.index', compact('divisi'));
    }

    public function formDivisi($id = null){
        $divisi = $this->findDivisiById($id);
        return view('layout-admin.divisi.form', compact('divisi'));
    }

    public function savedivisi(Request $request, $id = null){
        $result = [
            'status'  => false,
            'message' => ''
        ];
        try {
            $divisi = $this->findDivisiById($id);
            if (!$divisi) {
                $divisi         = new Divisi();
            }
            $divisi->divisi       = $request->divisi;
            $divisi->save();

            $result['status']  = true;
            $result['message'] = 'save divisi success';
            return redirect('/admin/divisi');
        } catch (\exception $e) {
            $result['message'] = 'function savedivisi() fail => ' . $e->getMessage();
            return redirect()->back();
        }
    }

    // public function deleteKaryawan($id){
    //     $karyawan = $this->findKaryawanById($id);
    //     if (!$karyawan) {
    //         return 'data karyawan not found';
    //     }
    //     $karyawan->delete();
    // }
}

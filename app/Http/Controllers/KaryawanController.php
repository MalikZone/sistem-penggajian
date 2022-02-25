<?php

namespace App\Http\Controllers;

use App\Divisi;
use App\Golongan;
use App\Karyawan;
use Illuminate\Http\Request;

class KaryawanController extends Controller
{

    public function findKaryawanById($id){
        return Karyawan::with([])
            ->find($id);
    }

    public function karyawanList($filters = []){
        $karyawan = Karyawan::with(['divisi', 'gaji', 'golongan']);
        if (isset($filters['nama'])) {
			$karyawan = $karyawan->where('nama', 'like', '%' . $filters['nama'] . '%');
		}
        return $karyawan->get();
    }

    public function index(Request $request){
        $filters    = $request->only([
            'nama'
        ]);
        $karyawan       = $this->karyawanList($filters);
        // $karyawan = Karyawan::with(['divisi', 'gaji'])->get();
        return view('layout-admin.karyawan.index', compact('karyawan'));
    }

    public function formKaryawan($id = null){
        $karyawan = $this->findKaryawanById($id);
        $divisi   = Divisi::all();
        $golongan = Golongan::all();
        return view('layout-admin.karyawan.form', compact('karyawan', 'divisi', 'golongan'));
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
            $karyawan->divisi_id    = $request->divisi_id;
            $karyawan->golongan_id  = $request->golongan_id;
            $karyawan->nama         = $request->nama;
            $karyawan->tgl_lahir    = $request->tgl_lahir;
            $karyawan->email        = $request->email;
            $karyawan->telepon      = $request->no_tlp;
            $karyawan->alamat       = $request->alamat;
            $karyawan->jender       = $request->jender;
            $karyawan->save();

            $result['status']  = true;
            $result['message'] = 'save karyawan success';
            return redirect('/admin/karyawan')->with(['success' => $result['message']]);
        } catch (\exception $e) {
            $result['message'] = 'function saveKaryawan() fail => ' . $e->getMessage();
            return redirect()->back()->with(['error' => $result['message']]);
        }
    }

    public function deleteKaryawan($id){
        $result = [
            'status'  => false,
            'message' => ''
        ];
        try {
            $karyawan = $this->findKaryawanById($id);
            if (!$karyawan) {
                return 'data karyawan not found';
            }
            $karyawan->delete();

            $result['status']  = true;
            $result['message'] = 'delete data success';
            return redirect('/admin/karyawan')->with(['success' => $result['message']]);
        } catch (\exception $e) {
            $result['message'] = 'function deleteKaryawan() fail => ' . $e->getMessage();
            return redirect()->back()->with(['error' => $result['message']]);
        }
    }

}

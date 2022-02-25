<?php

namespace App\Http\Controllers;

use App\Divisi;
use App\Golongan;
use App\Karyawan;
use Illuminate\Http\Request;
use App\User;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\DB;
use Exception;

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
        // dd($request);
        $result = [
            'status'  => false,
            'message' => ''
        ];
        try {
            DB::beginTransaction();
            $karyawan = $this->findKaryawanById($id);
            $user = User::with([])->where('id', $karyawan->user_id)->first();
            $user->name = $request->nama;
            $user->email = $request->email;
            $user->role = "karyawan";
            $user->save();
            $user->password = Hash::make($request->password);
            if (!$karyawan) {
                $karyawan         = new Karyawan();
            }

            $karyawan->golongan_id  = $request->golongan_id;
            $karyawan->nama       = $request->nama;
            $karyawan->tgl_lahir  = $request->tgl_lahir;
            $karyawan->divisi_id  = $request->divisi_id;
            $karyawan->email      = $request->email;
            $karyawan->user_id    = $user->id;
            $karyawan->telepon    = $request->no_tlp;
            $karyawan->alamat     = $request->alamat;
            $karyawan->jender     = $request->jender;
            $karyawan->save();
            DB::commit();

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

    public function storeKaryawan(Request $request)
    {
        try {
            DB::beginTransaction();
            $user = new User();
            $user->name = $request->nama;
            $user->email = $request->email;
            $user->role = "karyawan";
            $user->password = Hash::make($request->password);
            $user->save();
            
            $karyawan = new Karyawan();
            $karyawan->golongan_id  = $request->golongan_id;
            $karyawan->nama       = $request->nama;
            $karyawan->tgl_lahir  = $request->tgl_lahir;
            $karyawan->divisi_id  = $request->divisi_id;
            $karyawan->email      = $request->email;
            $karyawan->user_id    = $user->id;
            $karyawan->telepon    = $request->no_tlp;
            $karyawan->alamat     = $request->alamat;
            $karyawan->jender     = $request->jender;
            $karyawan->save();

            $result['status']  = true;
            $result['message'] = 'save karyawan success';
            return redirect('/admin/karyawan')->with(['success' => $result['message']]);
        } catch (Exception $e) {
            $result['message'] = 'function saveKaryawan() fail => ' . $e->getMessage();
            return redirect()->back()->with(['error' => $result['message']]);
        }
        
    }

}

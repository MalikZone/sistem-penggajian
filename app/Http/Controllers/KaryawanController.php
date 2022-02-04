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

		if (isset($filters['email'])) {
			$karyawan = $karyawan->where("email", "LIKE" ,"%".$filters['email']."%");
        }
        
        return $karyawan->get();
    }

    public function index(Request $request){
        $filters    = $request->only([
            'nama','email','telepon'
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
            $user = new User();
            $user->name = $request->nama;
            $user->email = $request->email;
            $user->role = "karyawan";
            $user->save();

            $user->password = Hash::make($request->password);
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
            
            DB::commit();

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

    public function storeKaryawan(Request $request)
    {
        try {
            $user = new User();
            $user->name = $request->nama;
            $user->email = $request->email;
            $user->role = "karyawan";
            $user->password = Hash::make('q1w2e3r4');
            $user->save();
            
            $karyawan = new Karyawan();
            $karyawan->nama       = $request->nama;
            $karyawan->tgl_lahir  = $request->tgl_lahir;
            $karyawan->divisi_id  = $request->divisi_id;
            $karyawan->email      = $request->email;
            $karyawan->user_id    = $user->id;
            $karyawan->telepon    = $request->no_tlp;
            $karyawan->alamat     = $request->alamat;
            $karyawan->jender     = $request->jender;
            $karyawan->save();
            return redirect('/admin/karyawan');
        } catch (Exception $e) {
            //throw $th;
        }
        
    }

}

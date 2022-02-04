<?php

namespace App\Http\Controllers;

use App\Potongan;
use Illuminate\Http\Request;

class PotonganController extends Controller
{
    public function findPotonganById($id){
        return Potongan::with([])
            ->find($id);
    }

    public function index(){
        $potongan = Potongan::with([])
                    ->orderBy('id', 'DESC')
                    ->get();
        return view('layout-admin.potongan.index', compact('potongan'));
    }

    public function formPotongan($id = null){
        $potongan = $this->findPotonganById($id);
        return view('layout-admin.potongan.form', compact('potongan'));
    }

    public function savePotongan(Request $request, $id = null){
        $result = [
            'status'  => false,
            'message' => ''
        ];
        try {
            $potongan = $this->findPotonganById($id);
            if (!$potongan) {
                $potongan         = new Potongan();
            }
            $potongan->keterangan   = $request->keterangan;
            $potongan->potongan     = $request->jumlah;
            $potongan->save();

            $result['status']  = true;
            $result['message'] = 'save potongan success';
            return redirect('/admin/potongan');
        } catch (\exception $e) {
            $result['message'] = 'function savePotongan() fail => ' . $e->getMessage();
            return redirect()->back();
        }
    }
}

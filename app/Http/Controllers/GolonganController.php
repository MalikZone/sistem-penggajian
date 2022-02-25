<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Golongan;

class GolonganController extends Controller
{
    public function index()
    {
        $golongan = Golongan::with([])->orderBy('id', 'DESC')->get();
        return view('layout-admin.golongan.index', compact('golongan'));
    }

    public function findGolonganById($id){
        return Golongan::with([])
            ->find($id);
    }

    public function store(Request $request, $id = null)
    {
        $result = [
            'status'  => false,
            'message' => ''
        ];
        try {
            $golongan = $this->findGolonganById($id);
            if (!$golongan) {
                $golongan = new Golongan();
            }
            $golongan->golongan = $request->golongan;
            $golongan->tunjangan = $request->tunjangan;
            $golongan->save();


            $result['status']  = true;
            $result['message'] = 'save golongan success';
            return redirect('/admin/golongan')->with(['success' => $result['message']]);
        } catch (\exception $e) {
            $result['message'] = 'function saveGolongan() fail => ' . $e->getMessage();
            return redirect()->back()->with(['error' => $result['message']]);
        }
    }

    // public function delete($id)
    // {

    // }
}

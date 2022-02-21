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

    public function store(Request $request, $id = null)
    {
        $golongan = new Golongan();
        $golongan->golongan = $request->golongan;
        $golongan->tunjangan = $request->tunjangan;
        $golongan->save();

        return redirect()->back();
    }

    public function delete($id)
    {

    }
}

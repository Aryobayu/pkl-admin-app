<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Controllers\FormulirController;

class FormulirController extends Controller



{
    public function create()
    {
        return view('formulir'); // atau 'admin.formulir' jika di folder /views/admin
    }

    public function store(Request $request)
    {
        $request->validate([
            'nama' => 'required|string|max:255',
            'email' => 'required|email',
            'jabatan' => 'required',
            'jenis_kelamin' => 'required',
            'alamat' => 'required|string',
        ]);

        // Simpan ke database jika perlu

        return redirect()->back()->with('success', 'Data berhasil dikirim!');
    }
}

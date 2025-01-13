<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Pasien;

class PasienController extends Controller
{
    public function index()
    {
        $pasiens = Pasien::paginate(10);
        if (!in_array(auth()->user()->role, ['admin', 'dokter', 'perawat'])) {
            abort(403, 'Anda tidak memiliki hak akses untuk membuat data pasien.');
        }
        return view('pasiens.index', compact('pasiens'));
    }

    public function create()
    {
        if (!in_array(auth()->user()->role, ['admin', 'perawat'])) {
            abort(403, 'Anda tidak memiliki hak akses untuk membuat data pasien.');
        }
        return view('pasiens.form');
    }

    public function store(Request $request)
    {
        if (!in_array(auth()->user()->role, ['admin', 'perawat'])) {
            abort(403, 'Anda tidak memiliki hak akses untuk membuat data pasien.');
        }
        $request->validate([
            'nm_pasien' => 'required|string|max:255',
            'j_kel' => 'required|string',
            'agama' => 'required|string',
            'alamat' => 'required|string',
            'tgl_lhr' => 'required|date',
            'usia' => 'required|integer|min:0',
            'no_tlp' => 'required|string',
            'nm_kk' => 'required|string',
            'hub_kel' => 'required|string',
        ]);

        Pasien::create($request->all());
        return redirect()->route('pasiens.index')->with('success', 'Pasien berhasil ditambahkan.');
    }

    public function edit(Pasien $pasien)
    {
        if (!in_array(auth()->user()->role, ['admin', 'dokter'])) {
            abort(403, 'Anda tidak memiliki hak akses untuk membuat data pasien.');
        }
        return view('pasiens.form', compact('pasien'));
    }

    public function update(Request $request, Pasien $pasien)
    {
        if (!in_array(auth()->user()->role, ['admin', 'dokter'])) {
            abort(403, 'Anda tidak memiliki hak akses untuk membuat data pasien.');
        }
        $request->validate([
            'nm_pasien' => 'required|string|max:255',
            'j_kel' => 'required|string',
            'agama' => 'required|string',
            'alamat' => 'required|string',
            'tgl_lhr' => 'required|date',
            'usia' => 'required|integer|min:0',
            'no_tlp' => 'required|string',
            'nm_kk' => 'required|string',
            'hub_kel' => 'required|string',
        ]);

        $pasien->update($request->all());
        return redirect()->route('pasiens.index')->with('success', 'Pasien berhasil diperbarui.');
    }

    public function destroy(Pasien $pasien)
    {
        if (!in_array(auth()->user()->role, ['admin'])) {
            abort(403, 'Anda tidak memiliki hak akses untuk membuat data pasien.');
        }
        $pasien->delete();
        return redirect()->route('pasiens.index')->with('success', 'Pasien berhasil dihapus.');
    }
}

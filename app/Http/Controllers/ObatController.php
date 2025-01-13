<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Obat;

class ObatController extends Controller
{
    public function index()
    {
        if (!in_array(auth()->user()->role, ['admin', 'farmasi'])) {
            abort(403, 'Anda tidak memiliki hak akses untuk membuat data pasien.');
        }
        $obats = Obat::paginate(10);
        return view('obats.index', compact('obats'));
    }

    public function create()
    {
        if (!in_array(auth()->user()->role, ['admin', 'farmasi'])) {
            abort(403, 'Anda tidak memiliki hak akses untuk membuat data pasien.');
        }
        return view('obats.form');
    }

    public function store(Request $request)
    {
        if (!in_array(auth()->user()->role, ['admin', 'farmasi'])) {
            abort(403, 'Anda tidak memiliki hak akses untuk membuat data pasien.');
        }
        $request->validate([
            'nm_obat' => 'required|string|max:255',
            'jml_obat' => 'required|integer|min:0',
            'ukuran' => 'required|string',
            'harga' => 'required|numeric|min:0',
        ]);

        Obat::create($request->all());
        return redirect()->route('obats.index')->with('success', 'Obat berhasil ditambahkan.');
    }

    public function edit(Obat $obat)
    {
        if (!in_array(auth()->user()->role, ['admin', 'farmasi'])) {
            abort(403, 'Anda tidak memiliki hak akses untuk membuat data pasien.');
        }
        return view('obats.form', compact('obat'));
    }

    public function update(Request $request, Obat $obat)
    {
        if (!in_array(auth()->user()->role, ['admin', 'farmasi'])) {
            abort(403, 'Anda tidak memiliki hak akses untuk membuat data pasien.');
        }
        $request->validate([
            'nm_obat' => 'required|string|max:255',
            'jml_obat' => 'required|integer|min:0',
            'ukuran' => 'required|string',
            'harga' => 'required|numeric|min:0',
        ]);

        $obat->update($request->all());
        return redirect()->route('obats.index')->with('success', 'Obat berhasil diperbarui.');
    }

    public function destroy(Obat $obat)
    {
        if (!in_array(auth()->user()->role, ['admin', 'farmasi'])) {
            abort(403, 'Anda tidak memiliki hak akses untuk membuat data pasien.');
        }
        $obat->delete();
        return redirect()->route('obats.index')->with('success', 'Obat berhasil dihapus.');
    }
}

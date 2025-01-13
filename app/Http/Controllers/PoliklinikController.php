<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Poliklinik;

class PoliklinikController extends Controller
{
    public function index()
    {
        if (!in_array(auth()->user()->role, ['admin'])) {
            abort(403, 'Anda tidak memiliki hak akses untuk membuat data pasien.');
        }
        $polikliniks = Poliklinik::paginate(10);
        return view('polikliniks.index', compact('polikliniks'));
    }

    public function create()
    {
        if (!in_array(auth()->user()->role, ['admin'])) {
            abort(403, 'Anda tidak memiliki hak akses untuk membuat data pasien.');
        }
        return view('polikliniks.form');
    }

    public function store(Request $request)
    {
        if (!in_array(auth()->user()->role, ['admin'])) {
            abort(403, 'Anda tidak memiliki hak akses untuk membuat data pasien.');
        }
        $request->validate([
            'nm_poli' => 'required|string|max:255',
            'lantai' => 'required|integer|min:0',
        ]);

        Poliklinik::create($request->all());
        return redirect()->route('polikliniks.index')->with('success', 'Poliklinik berhasil ditambahkan.');
    }

    public function edit(Poliklinik $poliklinik)
    {
        if (!in_array(auth()->user()->role, ['admin'])) {
            abort(403, 'Anda tidak memiliki hak akses untuk membuat data pasien.');
        }
        return view('polikliniks.form', compact('poliklinik'));
    }

    public function update(Request $request, Poliklinik $poliklinik)
    {
        if (!in_array(auth()->user()->role, ['admin'])) {
            abort(403, 'Anda tidak memiliki hak akses untuk membuat data pasien.');
        }
        $request->validate([
            'nm_poli' => 'required|string|max:255',
            'lantai' => 'required|integer|min:0',
        ]);

        $poliklinik->update($request->all());
        return redirect()->route('polikliniks.index')->with('success', 'Poliklinik berhasil diperbarui.');
    }

    public function destroy(Poliklinik $poliklinik)
    {
        if (!in_array(auth()->user()->role, ['admin'])) {
            abort(403, 'Anda tidak memiliki hak akses untuk membuat data pasien.');
        }
        $poliklinik->delete();
        return redirect()->route('polikliniks.index')->with('success', 'Poliklinik berhasil dihapus.');
    }
}

<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Tindakan;

class TindakanController extends Controller
{
    public function index()
    {
        if (!in_array(auth()->user()->role, ['admin', 'perawat', 'dokter'])) {
            abort(403, 'Anda tidak memiliki hak akses untuk membuat data pasien.');
        }
        $tindakans = Tindakan::paginate(10);
        return view('tindakans.index', compact('tindakans'));
    }

    public function create()
    {
        if (!in_array(auth()->user()->role, ['admin', 'perawat', 'dokter'])) {
            abort(403, 'Anda tidak memiliki hak akses untuk membuat data pasien.');
        }
        return view('tindakans.form');
    }

    public function store(Request $request)
    {
        if (!in_array(auth()->user()->role, ['admin', 'perawat', 'dokter'])) {
            abort(403, 'Anda tidak memiliki hak akses untuk membuat data pasien.');
        }
        $request->validate([
            'nm_tindakan' => 'required|string|max:255',
            'ket' => 'nullable|string',
        ]);

        Tindakan::create($request->all());
        return redirect()->route('tindakans.index')->with('success', 'Tindakan berhasil ditambahkan.');
    }

    public function edit(Tindakan $tindakan)
    {
        if (!in_array(auth()->user()->role, ['admin', 'perawat', 'dokter'])) {
            abort(403, 'Anda tidak memiliki hak akses untuk membuat data pasien.');
        }
        return view('tindakans.form', compact('tindakan'));
    }

    public function update(Request $request, Tindakan $tindakan)
    {
        if (!in_array(auth()->user()->role, ['admin', 'perawat', 'dokter'])) {
            abort(403, 'Anda tidak memiliki hak akses untuk membuat data pasien.');
        }
        $request->validate([
            'nm_tindakan' => 'required|string|max:255',
            'ket' => 'nullable|string',
        ]);

        $tindakan->update($request->all());
        return redirect()->route('tindakans.index')->with('success', 'Tindakan berhasil diperbarui.');
    }

    public function destroy(Tindakan $tindakan)
    {
        if (!in_array(auth()->user()->role, ['admin', 'perawat', 'dokter'])) {
            abort(403, 'Anda tidak memiliki hak akses untuk membuat data pasien.');
        }
        $tindakan->delete();
        return redirect()->route('tindakans.index')->with('success', 'Tindakan berhasil dihapus.');
    }
}

<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Laboratorium;
use App\Models\RekamMedis;

class LaboratoriumController extends Controller
{
    public function index()
    {
        $laboratoriums = Laboratorium::with('rekamMedis')->paginate(10);
        if (!in_array(auth()->user()->role, ['admin', 'dokter', 'laboratorium'])) {
            abort(403, 'Anda tidak memiliki hak akses untuk membuat data pasien.');
        }
        return view('laboratoriums.index', compact('laboratoriums'));
    }

    public function create()
    {
        if (!in_array(auth()->user()->role, ['admin', 'laboratorium'])) {
            abort(403, 'Anda tidak memiliki hak akses untuk membuat data pasien.');
        }
        $rekamMedis = RekamMedis::all();
        return view('laboratoriums.form', compact('rekamMedis'));
    }

    public function store(Request $request)
    {
        if (!in_array(auth()->user()->role, ['admin', 'laboratorium'])) {
            abort(403, 'Anda tidak memiliki hak akses untuk membuat data pasien.');
        }
        $request->validate([
            'no_rm' => 'required|exists:rekam_medis,no_rm',
            'hasil_lab' => 'required|string',
            'ket' => 'nullable|string',
        ]);

        Laboratorium::create($request->all());
        return redirect()->route('laboratoriums.index')->with('success', 'Data laboratorium berhasil ditambahkan.');
    }

    public function edit(Laboratorium $laboratorium)
    {
        if (!in_array(auth()->user()->role, ['admin', 'laboratorium'])) {
            abort(403, 'Anda tidak memiliki hak akses untuk membuat data pasien.');
        }
        $rekamMedis = RekamMedis::all();
        return view('laboratoriums.form', compact('laboratorium', 'rekamMedis'));
    }

    public function update(Request $request, Laboratorium $laboratorium)
    {
        if (!in_array(auth()->user()->role, ['admin', 'laboratorium'])) {
            abort(403, 'Anda tidak memiliki hak akses untuk membuat data pasien.');
        }
        $request->validate([
            'no_rm' => 'required|exists:rekam_medis,no_rm',
            'hasil_lab' => 'required|string',
            'ket' => 'nullable|string',
        ]);

        $laboratorium->update($request->all());
        return redirect()->route('laboratoriums.index')->with('success', 'Data laboratorium berhasil diperbarui.');
    }

    public function destroy(Laboratorium $laboratorium)
    {
        if (!in_array(auth()->user()->role, ['admin', 'laboratorium'])) {
            abort(403, 'Anda tidak memiliki hak akses untuk membuat data pasien.');
        }
        $laboratorium->delete();
        return redirect()->route('laboratoriums.index')->with('success', 'Data laboratorium berhasil dihapus.');
    }
}
<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Dokter;
use App\Models\Poliklinik;
use App\Models\User;

class DokterController extends Controller
{
    public function index()
    {
        if (!in_array(auth()->user()->role, ['admin', 'dokter'])) {
            abort(403, 'Anda tidak memiliki hak akses untuk membuat data pasien.');
        }
        $dokters = Dokter::paginate(10);
        return view('dokters.index', compact('dokters'));
    }

    public function create()
    {
        if (!in_array(auth()->user()->role, ['admin'])) {
            abort(403, 'Anda tidak memiliki hak akses untuk membuat data pasien.');
        }
        $polikliniks = Poliklinik::all();
        $users = User::all();
        return view('dokters.form', compact('polikliniks', 'users'));
    }

    public function store(Request $request)
    {
        if (!in_array(auth()->user()->role, ['admin'])) {
            abort(403, 'Anda tidak memiliki hak akses untuk membuat data pasien.');
        }
        $request->validate([
            'kd_poli' => 'required|exists:polikliniks,kd_poli',
            'kd_user' => 'required|exists:users,kd_user',
            'nm_dokter' => 'required|string|max:255',
            'SIP' => 'required|string|max:50',
            'tgl_kunjungan' => 'required|date',
            'tmpat_lhr' => 'required|string',
            'no_tlp' => 'required|string',
            'alamat' => 'required|string',
        ]);

        Dokter::create($request->all());
        return redirect()->route('dokters.index')->with('success', 'Dokter berhasil ditambahkan.');
    }

    public function edit(Dokter $dokter)
    {
        if (!in_array(auth()->user()->role, ['admin'])) {
            abort(403, 'Anda tidak memiliki hak akses untuk membuat data pasien.');
        }
        $polikliniks = Poliklinik::all();
        $users = User::all();
        return view('dokters.form', compact('dokter', 'polikliniks', 'users'));
    }

    public function update(Request $request, Dokter $dokter)
    {
        if (!in_array(auth()->user()->role, ['admin'])) {
            abort(403, 'Anda tidak memiliki hak akses untuk membuat data pasien.');
        }
        $request->validate([
            'kd_poli' => 'required|exists:polikliniks,kd_poli',
            'kd_user' => 'required|exists:users,kd_user',
            'nm_dokter' => 'required|string|max:255',
            'SIP' => 'required|string|max:50',
            'tgl_kunjungan' => 'required|date',
            'tmpat_lhr' => 'required|string',
            'no_tlp' => 'required|string',
            'alamat' => 'required|string',
        ]);

        $dokter->update($request->all());
        return redirect()->route('dokters.index')->with('success', 'Dokter berhasil diperbarui.');
    }

    public function destroy(Dokter $dokter)
    {
        if (!in_array(auth()->user()->role, ['admin'])) {
            abort(403, 'Anda tidak memiliki hak akses untuk membuat data pasien.');
        }
        $dokter->delete();
        return redirect()->route('dokters.index')->with('success', 'Dokter berhasil dihapus.');
    }
}
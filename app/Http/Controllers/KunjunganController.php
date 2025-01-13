<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Kunjungan;
use App\Models\Pasien;
use App\Models\Poliklinik;

class KunjunganController extends Controller
{
    public function index()
    {
        if (!in_array(auth()->user()->role, ['admin', 'dokter', 'perawat'])) {
            abort(403, 'Anda tidak memiliki hak akses untuk membuat data pasien.');
        }
        $kunjungans = Kunjungan::paginate(10);
        return view('kunjungans.index', compact('kunjungans'));
    }

    public function create()
    {
        if (!in_array(auth()->user()->role, ['admin', 'dokter'])) {
            abort(403, 'Anda tidak memiliki hak akses untuk membuat data pasien.');
        }
        $pasiens = Pasien::all();
        $polikliniks = Poliklinik::all();
        return view('kunjungans.form', compact('pasiens', 'polikliniks'));
    }

    public function store(Request $request)
    {
        if (!in_array(auth()->user()->role, ['admin', 'dokter'])) {
            abort(403, 'Anda tidak memiliki hak akses untuk membuat data pasien.');
        }
        $request->validate([
            'no_pasien' => 'required|exists:pasiens,no_pasien',
            'kd_poli' => 'required|exists:polikliniks,kd_poli',
            'tgl_kunjungan' => 'required|date',
            'jam_kunjungan' => 'required',
        ]);

        Kunjungan::create($request->all());

        return redirect()->route('kunjungans.index')->with('success', 'Kunjungan berhasil ditambahkan.');
    }

    public function edit(Kunjungan $kunjungan)
    {
        if (!in_array(auth()->user()->role, ['admin', 'dokter'])) {
            abort(403, 'Anda tidak memiliki hak akses untuk membuat data pasien.');
        }
        $pasiens = Pasien::all();
        $polikliniks = Poliklinik::all();
        return view('kunjungans.form', compact('kunjungan', 'pasiens', 'polikliniks'));
    }

    public function update(Request $request, Kunjungan $kunjungan)
    {
        if (!in_array(auth()->user()->role, ['admin', 'dokter'])) {
            abort(403, 'Anda tidak memiliki hak akses untuk membuat data pasien.');
        }
        $request->validate([
            'no_pasien' => 'required|exists:pasiens,no_pasien',
            'kd_poli' => 'required|exists:polikliniks,kd_poli',
            'tgl_kunjungan' => 'required|date',
            'jam_kunjungan' => 'required',
        ]);

        $kunjungan->update($request->all());

        return redirect()->route('kunjungans.index')->with('success', 'Kunjungan berhasil diperbarui.');
    }

    public function destroy(Kunjungan $kunjungan)
    {
        if (!in_array(auth()->user()->role, ['admin', 'dokter'])) {
            abort(403, 'Anda tidak memiliki hak akses untuk membuat data pasien.');
        }
        $kunjungan->delete();
        return redirect()->route('kunjungans.index')->with('success', 'Kunjungan berhasil dihapus.');
    }
}

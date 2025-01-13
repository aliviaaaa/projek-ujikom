<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\RekamMedis;
use App\Models\Pasien;
use App\Models\Tindakan;
use App\Models\Obat;

class RekamMedisController extends Controller
{
    public function index()
    {
        if (!in_array(auth()->user()->role, ['admin', 'dokter', 'perawat', 'pasien', 'farmasi', 'laboratorium'])) {
            abort(403, 'Anda tidak memiliki hak akses untuk membuat data pasien.');
        }
        $rekamMedis = RekamMedis::with('pasien', 'tindakan', 'obat')->paginate(10);
        return view('rekam-medis.index', compact('rekamMedis'));
    }

    public function create()
    {
        if (!in_array(auth()->user()->role, ['admin', 'dokter'])) {
            abort(403, 'Anda tidak memiliki hak akses untuk membuat data pasien.');
        }
        $pasiens = Pasien::all();
        $tindakans = Tindakan::all();
        $obats = Obat::all();
        return view('rekam-medis.form', compact('pasiens', 'tindakans', 'obats'));
    }

    public function store(Request $request)
    {
        if (!in_array(auth()->user()->role, ['admin', 'dokter'])) {
            abort(403, 'Anda tidak memiliki hak akses untuk membuat data pasien.');
        }
        $request->validate([
            'no_pasien' => 'required|exists:pasiens,no_pasien',
            'kd_tindakan' => 'required|exists:tindakans,kd_tindakan',
            'kd_obat' => 'required|exists:obats,kd_obat',
            'diagnosa' => 'required|string',
            'resep' => 'required|string',
            'keluhan' => 'required|string',
            'tgl_pemeriksaan' => 'required|date',
        ]);

        RekamMedis::create(array_merge($request->all(), ['kd_user' => auth()->id()]));
        return redirect()->route('rekam-medis.index')->with('success', 'Rekam medis berhasil ditambahkan.');
    }

    public function edit(RekamMedis $rekamMedis)
    {
        if (!in_array(auth()->user()->role, ['admin', 'dokter'])) {
            abort(403, 'Anda tidak memiliki hak akses untuk membuat data pasien.');
        }
        $pasiens = Pasien::all();
        $tindakans = Tindakan::all();
        $obats = Obat::all();
        return view('rekam-medis.form', compact('rekamMedis', 'pasiens', 'tindakans', 'obats'));
    }

    public function update(Request $request, RekamMedis $rekamMedis)
    {
        if (!in_array(auth()->user()->role, ['admin', 'dokter'])) {
            abort(403, 'Anda tidak memiliki hak akses untuk membuat data pasien.');
        }
        $request->validate([
            'no_pasien' => 'required|exists:pasiens,no_pasien',
            'kd_tindakan' => 'required|exists:tindakans,kd_tindakan',
            'kd_obat' => 'required|exists:obats,kd_obat',
            'diagnosa' => 'required|string',
            'resep' => 'required|string',
            'keluhan' => 'required|string',
            'tgl_pemeriksaan' => 'required|date',
        ]);

        $rekamMedis->update(array_merge($request->all(), ['kd_user' => auth()->id()]));
        return redirect()->route('rekam-medis.index')->with('success', 'Rekam medis berhasil diperbarui.');
    }

    public function destroy(RekamMedis $rekamMedis)
    {
        if (!in_array(auth()->user()->role, ['admin', 'dokter'])) {
            abort(403, 'Anda tidak memiliki hak akses untuk membuat data pasien.');
        }
        $rekamMedis->delete();
        return redirect()->route('rekam-medis.index')->with('success', 'Rekam medis berhasil dihapus.');
    }
}
<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function dashboard()
    {
        $role = auth()->user()->role;

        // Contoh data untuk grafik
        $userRoleData = [
            'Admin' => 10,
            'Dokter' => 20,
            'Laboratorium' => 5,
            'Farmasi' => 15,
            'Perawat' => 25,
            'Pasien' => 30,
        ];

        $monthlyActivityData = [
            'January' => 65,
            'February' => 59,
            'March' => 80,
            'April' => 81,
            'May' => 56,
            'June' => 55,
            'July' => 40,
        ];

        return view('dashboard.index', compact('role', 'userRoleData', 'monthlyActivityData'));
    }
}

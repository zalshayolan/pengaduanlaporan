<?php

namespace App\Http\Controllers;

use App\Models\Pengaduan;
use Illuminate\Http\Request;

class SiswaController extends Controller
{
    /**
     * Dashboard Siswa
     */
    public function dashboard()
    {
        // ✅ Pastikan user login
        if (!session('login')) {
            return redirect()->route('login');
        }

        // ✅ Pastikan role siswa
        if (session('role') !== 'siswa') {
            abort(403, 'Akses ditolak');
        }

        // Ambil pengaduan milik siswa login
        $data = Pengaduan::where('user_id', session('user_id'))
                    ->latest()
                    ->get();

        return view('siswa.dashboard', [
            'totalPengaduan'     => $data->count(),
            'pengaduanMenunggu'  => $data->where('status', 'menunggu')->count(),
            'pengaduanProses'    => $data->where('status', 'diproses')->count(),
            'pengaduanSelesai'   => $data->where('status', 'selesai')->count(),
            'pengaduanTerbaru'   => $data->take(5), // ✅ biar dashboard tidak error
        ]);
    }
}

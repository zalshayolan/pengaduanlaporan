<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Pengaduan;
use Illuminate\Support\Facades\Hash;

class AdminController extends Controller
{
public function dashboard()

    {
        // Statistik
        $totalPengaduan = Pengaduan::count();
        $menunggu = Pengaduan::where('status', 'menunggu')->count();
        $diproses = Pengaduan::where('status', 'diproses')->count();
        $selesai = Pengaduan::where('status', 'selesai')->count();

        $totalSiswa = User::where('role', 'siswa')->count();
        $totalAdmin = User::where('role', 'admin')->count();

        // ✅ PENGADUAN TERBARU (INI YANG ERROR TADI)
        $pengaduanTerbaru = Pengaduan::latest()->take(5)->get();

        // kirim ke view
        return view('admin.dashboard', compact(
            'totalPengaduan',
            'menunggu',
            'diproses',
            'selesai',
            'totalSiswa',
            'totalAdmin',
            'pengaduanTerbaru'
        ));
    }


    public function __construct()
{
    if (session('role') != 'admin') {
        abort(403, 'Akses khusus admin');
    }
}


   
    
    // 👥 DATA SISWA - Index
    public function siswa()
    {
        $data = User::where('role', 'siswa')->latest()->get();
        return view('admin.siswa.index', compact('data'));
    }

    // 👥 DATA SISWA - Create Form
    public function siswaCreate()
    {
        return view('admin.siswa.create');
    }

    // 👥 DATA SISWA - Store
    public function siswaStore(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:users',
            'password' => 'required|min:6',
          
        ]);

        User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
            'role' => 'siswa',
          
        ]);

        return redirect()->route('admin.siswa.index')
                        ->with('success', 'Siswa berhasil ditambahkan!');
    }

    // 👥 DATA SISWA - Edit Form
    public function siswaEdit($id)
    {
        $siswa = User::findOrFail($id);
        return view('admin.siswa.edit', compact('siswa'));
    }

    // 👥 DATA SISWA - Update ✅ FIX: Tambah validasi password
    public function siswaUpdate(Request $request, $id)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:users,email,'.$id,
            
            // ✅ Password validation (hanya jika diisi)
            'password' => 'nullable|min:6|confirmed',
        ]);

        $siswa = User::findOrFail($id);
        $siswa->update([
            'name' => $request->name,
            'email' => $request->email,
            
        ]);

        // ✅ Update password hanya jika diisi dan valid
        if ($request->filled('password')) {
            $siswa->update(['password' => Hash::make($request->password)]);
        }

        return redirect()->route('admin.siswa.index')
                        ->with('success', 'Data siswa berhasil diperbarui!');
    }

    // 👥 DATA SISWA - Delete
    public function siswaDelete($id)
    {
        User::findOrFail($id)->delete();
        return redirect()->route('admin.siswa.index')
                        ->with('success', 'Siswa berhasil dihapus!');
    }
}
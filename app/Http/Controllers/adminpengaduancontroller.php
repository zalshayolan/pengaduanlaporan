<?php

namespace App\Http\Controllers;

use App\Models\Pengaduan;
use Illuminate\Http\Request;

class AdminPengaduanController extends Controller
{
    /**
     * LIST SEMUA PENGADUAN (DENGAN FILTER)
     */
    public function index(Request $request)
    {
        $query = Pengaduan::with('user');

        // 🔍 Filter Nama Siswa
        if ($request->filled('nama')) {
            $query->whereHas('user', function($q) use ($request) {
                $q->where('name', 'like', '%' . $request->nama . '%');
            });
        }

        // 📅 Filter Tanggal Dari
        if ($request->filled('tanggal_dari')) {
            $query->whereDate('created_at', '>=', $request->tanggal_dari);
        }

        // 🏷️ Filter Status (PENGGANTI Tanggal Sampai)
        if ($request->filled('status')) {
            $query->where('status', $request->status);
        }

        // Urutkan terbaru
        $query->latest();

        // Ambil data (tanpa pagination sesuai request)
        $data = $query->get();

        return view('admin.pengaduan.index', compact('data'));
    }

    /**
     * DETAIL PENGADUAN
     */
    public function show($id)
    {
        $pengaduan = Pengaduan::with('user')->findOrFail($id);
        return view('admin.pengaduan.show', compact('pengaduan'));
    }

    /**
     * FORM EDIT STATUS PENGADUAN
     */
    public function edit($id)
    {
        $pengaduan = Pengaduan::with('user')->findOrFail($id);
        return view('admin.pengaduan.edit', compact('pengaduan'));
    }

    /**
     * UPDATE DATA PENGADUAN
     */
    public function update(Request $request, $id)
    {
        $request->validate([
            'status' => 'required|in:menunggu,proses,selesai',
            'tanggapan_admin' => 'nullable|string|max:1000'
        ]);

        $pengaduan = Pengaduan::findOrFail($id);
        $pengaduan->status = $request->status;
        $pengaduan->tanggapan_admin = $request->tanggapan_admin;
        $pengaduan->save();

        return redirect()
            ->route('admin.pengaduan.show', $id)
            ->with('success', 'Pengaduan berhasil diperbarui ✅');
    }

    /**
     * HAPUS PENGADUAN
     */
    public function destroy($id)
    {
        $pengaduan = Pengaduan::findOrFail($id);
        $pengaduan->delete();

        return redirect()
            ->route('admin.pengaduan.index')
            ->with('success', 'Pengaduan berhasil dihapus');
    }
}
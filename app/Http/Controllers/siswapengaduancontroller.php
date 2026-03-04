<?php

namespace App\Http\Controllers;

use App\Models\Pengaduan;
use Illuminate\Http\Request;

class SiswaPengaduanController extends Controller
{
    public function index()
    {
        $data = Pengaduan::where('user_id', session('user_id'))->latest()->get();
        return view('siswa.pengaduan.index', compact('data'));
    }

    public function create()
    {
        return view('siswa.pengaduan.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'judul' => 'required',
            'kategori' => 'required',
            'lokasi' => 'required',
            'deskripsi' => 'required',
            'foto' => 'nullable|image|mimes:jpg,jpeg,png|max:2048'
            ]);

            $fotoName = null;
    
            if ($request->hasFile('foto')) {
                $file = $request->file('foto');
                $fotoName = time() . '_' . $file->getClientOriginalName();
                $file->move(public_path('uploads'), $fotoName);
            }
    
            Pengaduan::create([
                'user_id' => session('user_id'),
                'judul' => $request->judul,
                'kategori' => $request->kategori,
                'lokasi' => $request->lokasi,
                'deskripsi' => $request->deskripsi,
                'foto' => $fotoName,
                'status' => 'menunggu'
            ]);
    
            return redirect('/siswa/pengaduan')->with('success', 'Pengaduan berhasil dikirim!');
        }
    
        public function show($id)
        {
            $pengaduan = Pengaduan::where('user_id', session('user_id'))->findOrFail($id);
            return view('siswa.pengaduan.show', compact('pengaduan'));
        }
    
        public function delete($id)
        {
            $pengaduan = Pengaduan::where('user_id', session('user_id'))->findOrFail($id);
    
            // hapus foto
            if ($pengaduan->foto && file_exists(public_path('uploads/'.$pengaduan->foto))) {
                unlink(public_path('uploads/'.$pengaduan->foto));
            }
    
            $pengaduan->delete();
            return redirect('/siswa/pengaduan')->with('success', 'Pengaduan berhasil dihapus');
        }
    }
    
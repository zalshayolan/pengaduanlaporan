{{-- resources/views/siswa/pengaduan/show.blade.php --}}
<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Detail Pengaduan - Sistem Pengaduan</title>
    
    <!-- Bootstrap CSS (URL fixed: tanpa spasi) -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.0/font/bootstrap-icons.css">
    
    <style>
        body { background-color: #f8f9fa; padding-top: 20px; font-family: 'Segoe UI', sans-serif; }
        .sidebar {
            background-color: #1976d2;
            min-height: 100vh;
            padding: 20px 0;
            color: white;
        }
        .sidebar-brand {
            font-size: 1.2rem;
            font-weight: bold;
            margin-bottom: 20px;
            padding: 0 15px;
        }
        .sidebar-brand span {
            display: block;
            font-size: 0.9rem;
            font-weight: normal;
            opacity: 0.8;
        }
        .sidebar-link {
            color: rgba(255, 255, 255, 0.85);
            padding: 12px 15px;
            border-radius: 5px;
            margin: 5px 10px;
            display: block;
            transition: all 0.3s;
            font-size: 1rem;
            text-decoration: none;
        }
        .sidebar-link:hover {
            background-color: rgba(255, 255, 255, 0.15);
            color: white;
        }
        .sidebar-link.active {
            background-color: rgba(255, 255, 255, 0.2);
            color: white;
            font-weight: 500;
        }
        .sidebar-link i {
            margin-right: 10px;
            width: 20px;
            text-align: center;
        }
        .main-content { padding: 20px; }
        .header {
            background: linear-gradient(135deg, #1976d2 0%, #2196f3 100%);
            color: white;
            padding: 20px 30px;
            border-radius: 10px 10px 0 0;
            margin: -30px -30px 20px -30px;
        }
        .header h1 { margin: 0; font-size: 1.8rem; font-weight: 600; }
        .header .subtitle { font-size: 1.1rem; opacity: 0.9; margin-top: 5px; }
        .detail-card {
            background: white;
            border-radius: 10px;
            box-shadow: 0 4px 6px rgba(0,0,0,0.05);
            margin-bottom: 20px;
        }
        .detail-card .card-header {
            background: linear-gradient(135deg, #1976d2 0%, #2196f3 100%);
            color: white;
            padding: 15px 20px;
            border-radius: 10px 10px 0 0;
            font-weight: 600;
        }
        .detail-card .card-body { padding: 25px; }
        .detail-row {
            display: flex;
            padding: 12px 0;
            border-bottom: 1px solid #eee;
        }
        .detail-row:last-child { border-bottom: none; }
        .detail-label {
            width: 150px;
            font-weight: 600;
            color: #6c757d;
        }
        .detail-value {
            flex: 1;
            color: #343a40;
        }
        .status-badge {
            padding: 6px 15px;
            border-radius: 20px;
            font-size: 0.9rem;
            font-weight: 500;
            display: inline-block;
        }
        .foto-preview {
            max-width: 100%;
            height: auto;
            border-radius: 10px;
            border: 3px solid #e9ecef;
            box-shadow: 0 4px 6px rgba(0,0,0,0.1);
        }
        .back-btn { margin-bottom: 20px; }
        .tanggapan-box {
            background: #e3f2fd;
            border-left: 4px solid #2196f3;
            padding: 15px 20px;
            border-radius: 0 5px 5px 0;
            margin-top: 10px;
        }
        .tanggapan-box.empty {
            background: #fff3e0;
            border-left-color: #ff9800;
            color: #6c757d;
            font-style: italic;
        }
    </style>
</head>
<body>
    <div class="container-fluid">
        <div class="row">
            <!-- Sidebar -->
            <div class="col-md-2 sidebar">
                <div class="sidebar-brand">
                    Siswa Panel
                    <span>Sistem Pengaduan</span>
                </div>
                <ul class="nav flex-column">
                    <li class="nav-item">
                        <a href="{{ route('siswa.dashboard') }}" class="sidebar-link">
                            <i class="bi bi-speedometer2"></i> Dashboard
                        </a>
                    </li>
                    <li class="nav-item">
                        <a href="{{ route('siswa.pengaduan.index') }}" class="sidebar-link">
                            <i class="bi bi-chat-text"></i> Pengaduanku
                        </a>
                    </li>
                    <li class="nav-item">
                        <a href="{{ route('siswa.pengaduan.create') }}" class="sidebar-link">
                            <i class="bi bi-plus-circle"></i> Buat Pengaduan
                        </a>
                    </li>
                    <li class="nav-item mt-4">
                        <form action="{{ route('logout') }}" method="POST" class="px-2">
                            @csrf
                            <button type="submit" class="sidebar-link w-100 text-start border-0 bg-transparent text-white">
                                <i class="bi bi-box-arrow-right"></i> Logout
                            </button>
                        </form>
                    </li>
                </ul>
            </div>
            
            <!-- Main Content -->
            <div class="col-md-10 main-content">
                <!-- Header -->
                <div class="header">
                    <h1>📋 Detail Pengaduan</h1>
                    <div class="subtitle">Lihat informasi lengkap pengaduan Anda</div>
                </div>
                
                <!-- Back Button -->
                <a href="{{ route('siswa.pengaduan.index') }}" class="btn btn-outline-secondary back-btn">
                    <i class="bi bi-arrow-left"></i> Kembali ke Daftar Pengaduan
                </a>
                
                <!-- Detail Card -->
                <div class="detail-card">
                    <div class="card-header">
                        <i class="bi bi-info-circle me-2"></i>Informasi Pengaduan
                    </div>
                    <div class="card-body">
                        <!-- Judul -->
                        <div class="detail-row">
                            <div class="detail-label">📌 Judul</div>
                            <div class="detail-value fw-semibold">{{ $pengaduan->judul ?? $pengaduan->isi }}</div>
                        </div>
                        
                        <!-- Kategori -->
                        <div class="detail-row">
                            <div class="detail-label">📁 Kategori</div>
                            <div class="detail-value">
                                <span class="badge bg-primary">{{ $pengaduan->kategori ?? 'Umum' }}</span>
                            </div>
                        </div>
                        
                        <!-- Lokasi -->
                        <div class="detail-row">
                            <div class="detail-label">📍 Lokasi</div>
                            <div class="detail-value">{{ $pengaduan->lokasi ?? '-' }}</div>
                        </div>
                        
                        <!-- Deskripsi -->
                        <div class="detail-row align-items-start">
                            <div class="detail-label">📝 Deskripsi</div>
                            <div class="detail-value">
                                <p class="mb-0">{{ $pengaduan->deskripsi ?? $pengaduan->isi ?? 'Tidak ada deskripsi' }}</p>
                            </div>
                        </div>
                        
                        <!-- Status -->
                        <div class="detail-row">
                            <div class="detail-label">📊 Status</div>
                            <div class="detail-value">
                                @if(($pengaduan->status ?? '') == 'selesai')
                                    <span class="status-badge bg-success text-white">✅ Selesai</span>
                                @elseif(($pengaduan->status ?? '') == 'proses')
                                    <span class="status-badge bg-info text-white">🔄 Dalam Proses</span>
                                @else
                                    <span class="status-badge bg-warning text-dark">⏳ Menunggu Konfirmasi</span>
                                @endif
                            </div>
                        </div>
                        
                        <!-- Tanggapan Admin -->
                        <div class="detail-row align-items-start">
                            <div class="detail-label">💬 Tanggapan Admin</div>
                            <div class="detail-value">
                                @if(!empty($pengaduan->tanggapan_admin))
                                    <div class="tanggapan-box">
                                        <i class="bi bi-chat-quote me-2"></i>
                                        {{ $pengaduan->tanggapan_admin }}
                                    </div>
                                @else
                                    <div class="tanggapan-box empty">
                                        <i class="bi bi-hourglass-split me-2"></i>
                                        Belum ada tanggapan dari admin
                                    </div>
                                @endif
                            </div>
                        </div>
                        
                        <!-- Tanggal -->
                        <div class="detail-row">
                            <div class="detail-label">📅 Dibuat</div>
                            <div class="detail-value">
                                {{ $pengaduan->created_at->format('d F Y, H:i') }}
                            </div>
                        </div>
                        
                        <!-- Foto -->
                        <div class="detail-row align-items-start">
                            <div class="detail-label">🖼️ Foto Bukti</div>
                            <div class="detail-value">
                                @if(!empty($pengaduan->foto))
                                    <a href="{{ asset('uploads/'.$pengaduan->foto) }}" target="_blank">
                                        <img src="{{ asset('uploads/'.$pengaduan->foto) }}" 
                                             class="foto-preview" 
                                             alt="Foto Bukti"
                                             onerror="this.src='https://via.placeholder.com/400x300?text=Foto+Tidak+Ditemukan'">
                                    </a>
                                    <div class="mt-2">
                                        <a href="{{ asset('uploads/'.$pengaduan->foto) }}" 
                                           class="btn btn-sm btn-outline-primary" 
                                           target="_blank">
                                            <i class="bi bi-zoom-in"></i> Lihat Full Size
                                        </a>
                                    </div>
                                @else
                                    <span class="text-muted">📷 Tidak ada foto terlampir</span>
                                @endif
                            </div>
                        </div>
                    </div>
                </div>
                
                <!-- Action Buttons -->
                <div class="d-flex gap-2">
                    <a href="{{ route('siswa.pengaduan.index') }}" class="btn btn-secondary">
                        <i class="bi bi-list"></i> Daftar Pengaduan
                    </a>
                    @if(empty($pengaduan->tanggapan_admin) && ($pengaduan->status ?? '') == 'menunggu')
                    <a href="#" class="btn btn-warning" onclick="return confirm('Batalkan pengaduan ini?')">
                        <i class="bi bi-x-circle"></i> Batalkan Pengaduan
                    </a>
                    @endif
                </div>
                
                <!-- Footer Info -->
                <div class="text-center text-muted mt-4">
                    <small>
                        ID Pengaduan: #{{ str_pad($pengaduan->id, 6, '0', STR_PAD_LEFT) }} 
                        | Diperbarui: {{ now()->format('d/m/Y H:i') }}
                    </small>
                </div>
            </div>
        </div>
    </div>

    <!-- Bootstrap JS (URL fixed: tanpa spasi) -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
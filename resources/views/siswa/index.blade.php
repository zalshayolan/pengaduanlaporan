{{-- resources/views/admin/siswa/index.blade.php --}}
<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Data Siswa - Admin Panel</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.0/font/bootstrap-icons.css">
    <style>
        body { background-color: #f8f9fa; padding-top: 20px; font-family: 'Segoe UI', sans-serif; }
        .sidebar { background-color: #0d47a1; min-height: 100vh; padding: 20px 0; color: white; }
        .sidebar-brand { font-size: 1.2rem; font-weight: bold; margin-bottom: 20px; padding: 0 15px; }
        .sidebar-brand span { display: block; font-size: 0.9rem; font-weight: normal; opacity: 0.8; }
        .sidebar-link { color: rgba(255,255,255,0.85); padding: 12px 15px; border-radius: 5px; margin: 5px 10px; display: block; text-decoration: none; }
        .sidebar-link:hover { background-color: rgba(255,255,255,0.15); color: white; }
        .sidebar-link.active { background-color: rgba(255,255,255,0.2); color: white; font-weight: 500; }
        .sidebar-link i { margin-right: 10px; width: 20px; text-align: center; }
        .main-content { padding: 20px; }
        .header { background: linear-gradient(135deg, #0d47a1 0%, #1565c0 100%); color: white; padding: 20px 30px; border-radius: 10px 10px 0 0; margin: -30px -30px 20px -30px; }
        .header h1 { margin: 0; font-size: 1.8rem; font-weight: 600; }
        .header .subtitle { font-size: 1.1rem; opacity: 0.9; margin-top: 5px; }
        .action-btn { margin-right: 5px; }
    </style>
</head>
<body>
    <div class="container-fluid">
        <div class="row">
            <!-- Sidebar -->
            <div class="col-md-2 sidebar">
                <div class="sidebar-brand">Admin Panel<span>Sistem Pengaduan</span></div>
                <ul class="nav flex-column">
                    <li><a href="{{ route('admin.dashboard') }}" class="sidebar-link"><i class="bi bi-speedometer2"></i> Dashboard</a></li>
                    <li><a href="{{ route('admin.pengaduan.index') }}" class="sidebar-link"><i class="bi bi-chat-text"></i> Data Pengaduan</a></li>
                    <li><a href="{{ route('admin.siswa.index') }}" class="sidebar-link active"><i class="bi bi-person"></i> Data Siswa</a></li>
                    <li class="mt-4">
                        <form action="{{ route('logout') }}" method="POST" class="px-2">@csrf
                            <button type="submit" class="sidebar-link w-100 text-start border-0 bg-transparent text-white"><i class="bi bi-box-arrow-right"></i> Logout</button>
                        </form>
                    </li>
                </ul>
            </div>
            
            <!-- Main Content -->
            <div class="col-md-10 main-content">
                <div class="header">
                    <h1>👥 Data Siswa</h1>
                    <div class="subtitle">Kelola data siswa terdaftar</div>
                </div>
                
                @if(session('success'))
                <div class="alert alert-success alert-dismissible fade show"><i class="bi bi-check-circle me-2"></i>{{ session('success') }}
                    <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
                </div>
                @endif
                
                <div class="d-flex justify-content-end mb-3">
                    <a href="{{ route('admin.siswa.create') }}" class="btn btn-primary btn-sm"><i class="bi bi-person-plus"></i> Tambah Siswa</a>
                </div>
                
                <div class="card shadow-sm">
                    <div class="card-body p-0">
                        <div class="table-responsive">
                            <table class="table table-bordered table-hover mb-0">
                                <thead class="table-success">
                                    <tr>
                                        <th width="5%" class="text-center">No</th>
                                        <th width="15%">NISN</th>
                                        <th width="25%">Nama</th>
                                        <th width="30%">Email</th>
                                        <th width="15%">Terdaftar</th>
                                        <th width="10%" class="text-center">Aksi</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @forelse($data as $item)
                                    <tr>
                                        <td class="text-center">{{ $loop->iteration }}</td>
                                        <td>{{ $item->nisn ?? '-' }}</td>
                                        <td>
                                            <div class="d-flex align-items-center">
                                                <div class="bg-success text-white rounded-circle d-flex align-items-center justify-content-center me-2" style="width:32px;height:32px;font-size:0.9rem;">
                                                    {{ strtoupper(substr($item->name ?? 'S', 0, 1)) }}
                                                </div>
                                                <span class="fw-semibold">{{ $item->name }}</span>
                                            </div>
                                        </td>
                                        <td>{{ $item->email }}</td>
                                        <td>{{ $item->created_at->format('d/m/Y') }}</td>
                                        <td class="text-center">
                                            <a href="{{ route('admin.siswa.edit', $item->id) }}" class="btn btn-sm btn-warning action-btn"><i class="bi bi-pencil"></i></a>
                                            <form action="{{ route('admin.siswa.delete', $item->id) }}" method="POST" style="display:inline" onsubmit="return confirm('Hapus siswa ini?')">@csrf @method('DELETE')
                                                <button type="submit" class="btn btn-sm btn-danger action-btn"><i class="bi bi-trash"></i></button>
                                            </form>
                                        </td>
                                    </tr>
                                    @empty
                                    <tr><td colspan="6" class="text-center text-muted py-5">
                                        <i class="bi bi-inbox fs-1 d-block mb-3"></i>
                                        <p class="mb-0">Belum ada data siswa</p>
                                    </td></tr>
                                    @endforelse
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
                
                <div class="text-center text-muted mt-3">
                    <small>Menampilkan {{ $data->count() }} siswa | Diperbarui: {{ now()->format('d/m/Y H:i') }}</small>
                </div>
            </div>
        </div>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
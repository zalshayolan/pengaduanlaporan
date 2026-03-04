<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Data Pengaduan - Admin Panel</title>
    
    <!-- Bootstrap CSS (FIXED: hapus spasi di URL) -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <!-- Bootstrap Icons (FIXED: hapus spasi di URL) -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.0/font/bootstrap-icons.css">
    
    <style>
        body { background-color: #f8f9fa; padding-top: 20px; font-family: 'Segoe UI', sans-serif; }
        
        /* Sidebar Styles */
        .sidebar{
            background:linear-gradient(180deg,#ffffff 0%,#f8f9fa 100%);
            min-height:100vh;
            position:fixed;
            width:280px;
            box-shadow:2px 0 10px rgba(0,0,0,.05);
            z-index: 1040;
            transition: transform 0.3s ease;
            left: 0;
            top: 0;
        }

        .sidebar-header{ padding:25px 20px; border-bottom:2px solid #f0f0f0; }
        .sidebar-brand{ display:flex; gap:12px; text-decoration:none; }

        .brand-icon{
            width:45px; height:45px; border-radius:12px;
            display:flex; align-items:center; justify-content:center;
            color:white; font-size:1.5rem;
            background:linear-gradient(135deg,#667eea,#764ba2);
        }

        .brand-text h1{ font-size:1.3rem; margin:0; font-weight:700; color: #2d3748; }
        .brand-text span{ font-size:.85rem; color:#718096; }

        .sidebar-nav{ list-style:none; padding:20px 15px; }

        .nav-link{
            display:flex; gap:12px; padding:14px 18px;
            border-radius:12px; text-decoration:none;
            color:#4a5568; font-weight:500; transition:.3s;
        }

        .nav-link:hover{ background:#edf2f7; transform:translateX(5px); }
        .nav-link.active{ background:linear-gradient(135deg,#667eea,#764ba2); color:white; }

        .nav-divider{ height:1px; background:#e2e8f0; margin:20px 15px; }

        .user-badge{
            background:#edf2f7; margin:15px; padding:15px;
            border-radius:12px; display:flex; gap:12px;
        }

        .user-avatar{
            width:40px; height:40px; border-radius:50%;
            background:linear-gradient(135deg,#667eea,#764ba2);
            color:white; display:flex; align-items:center;
            justify-content:center; font-weight:bold;
        }

        /* Main Content */
        .main-content{ margin-left:280px; padding:30px; transition: margin-left 0.3s ease; }
        .page-header{
            background:white; padding:25px; border-radius:15px;
            box-shadow:0 2px 10px rgba(0,0,0,.05); margin-bottom:25px;
        }

        /* Table Card */
        .table-card{
            background:white; border-radius:15px; padding:25px;
            box-shadow:0 2px 10px rgba(0,0,0,.05);
        }

        .table thead th{ background:#f8f9fa; border:none; font-weight:600; }
        .table tbody td{ vertical-align:middle; border-top:1px solid #f1f1f1; }

        /* Avatar & Badge */
        .student-avatar{
            width:42px; height:42px; border-radius:50%;
            background:linear-gradient(135deg,#667eea,#764ba2);
            color:white; display:flex; align-items:center;
            justify-content:center; font-weight:bold; margin-right: 12px;
        }

        /* Status Badge */
        .status-badge {
            padding: 6px 14px; border-radius: 20px;
            font-size: 0.8rem; font-weight: 600;
            display: inline-flex; align-items: center; gap: 5px;
        }
        .status-menunggu { background: #fff3cd; color: #856404; }
        .status-proses { background: #cce5ff; color: #004085; }
        .status-selesai { background: #d4edda; color: #155724; }

        /* Action Buttons */
        .action-btn {
            width: 34px; height: 34px; padding: 0;
            display: inline-flex; align-items: center; justify-content: center;
            border-radius: 8px; margin: 2px; transition: transform 0.2s;
            border: none;
        }
        .action-btn:hover { transform: translateY(-2px); }
        .btn-view { background: #17a2b8; color: white !important; }
        .btn-edit { background: #ffc107; color: white !important; }
        .btn-delete { background: #dc3545; color: white !important; }

        /* Image */
        .table-img {
            width: 70px; height: 50px; object-fit: cover;
            border-radius: 6px; border: 1px solid #dee2e6;
            cursor: pointer;
        }

        /* Toggle Button & Overlay (Mobile) */
        .sidebar-toggle {
            display: none; position: fixed; top: 20px; left: 20px;
            z-index: 1050; background: linear-gradient(135deg, #667eea, #764ba2);
            color: white; border: none; width: 45px; height: 45px;
            border-radius: 10px; font-size: 1.3rem;
            box-shadow: 0 4px 15px rgba(102, 126, 234, 0.4);
            cursor: pointer; align-items: center; justify-content: center;
        }
        .sidebar-overlay {
            display: none; position: fixed; top: 0; left: 0; right: 0; bottom: 0;
            background: rgba(0,0,0,0.5); z-index: 1030;
        }

        /* Empty State */
        .empty-state { text-align: center; padding: 50px 20px; color: #6c757d; }
        .empty-state i { font-size: 4rem; color: #dee2e6; margin-bottom: 15px; }

        /* Responsive */
        @media (max-width: 992px) {
            .sidebar { transform: translateX(-100%); }
            .sidebar.active { transform: translateX(0); }
            .main-content { margin-left: 0; padding: 80px 20px 30px; }
            .sidebar-toggle { display: flex; }
            .sidebar-overlay.active { display: block; }
            .page-header { padding: 20px; }
        }
        @media (max-width: 576px) {
            .table-responsive { font-size: 0.85rem; }
            .action-btn { width: 30px; height: 30px; font-size: 0.85rem; }
            .table-img { width: 60px; height: 45px; }
        }
    </style>
</head>
<body>

    <!-- Toggle Button Mobile -->
    <button class="sidebar-toggle" onclick="toggleSidebar()">
        <i class="bi bi-list"></i>
    </button>
    <div class="sidebar-overlay" onclick="toggleSidebar()"></div>

    <!-- SIDEBAR -->
    <aside class="sidebar" id="sidebar">
        <div class="sidebar-header">
            <div class="sidebar-brand">
                <div class="brand-icon"><i class="bi bi-shield-lock"></i></div>
                <div class="brand-text">
                    <h1>Admin Panel</h1>
                    <span>Sistem Pengaduan</span>
                </div>
            </div>
        </div>

        <div class="user-badge">
            <div class="user-avatar">
                {{ strtoupper(substr(session('user_name','A'),0,1)) }}
            </div>
            <div>
                <div class="fw-semibold">{{ session('user_name') ?? 'Administrator' }}</div>
                <small class="text-muted">Admin</small>
            </div>
        </div>

        <ul class="sidebar-nav">
            <li>
                <a href="{{ route('admin.dashboard') }}" 
                   class="nav-link {{ request()->routeIs('admin.dashboard') ? 'active' : '' }}">
                    <i class="bi bi-speedometer2"></i> Dashboard
                </a>
            </li>
            <li>
                <a href="{{ route('admin.pengaduan.index') }}" 
                   class="nav-link {{ request()->routeIs('admin.pengaduan.*') ? 'active' : '' }}">
                    <i class="bi bi-chat-text"></i> Data Pengaduan
                </a>
            </li>
            <li>
                <a href="{{ route('admin.siswa.index') }}" 
                   class="nav-link {{ request()->routeIs('admin.siswa.*') ? 'active' : '' }}">
                    <i class="bi bi-people"></i> Data Siswa
                </a>
            </li>
            <div class="nav-divider"></div>
            <li>
                <a href="{{ route('logout') }}" class="nav-link text-danger"
                   onclick="event.preventDefault(); confirmLogout()">
                    <i class="bi bi-box-arrow-right"></i> Logout
                </a>
                <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display:none;">@csrf</form>
            </li>
        </ul>
    </aside>

    <!-- MAIN CONTENT -->
    <main class="main-content">
        <!-- Header -->
        <div class="page-header">
            <h2>📋 Data Pengaduan</h2>
            <div class="subtitle">Kelola semua pengaduan dari siswa</div>
        </div>
        
        <!-- User Info -->
        <div class="d-flex justify-content-between align-items-center mb-3">
            <small class="text-muted">
                Login sebagai: <strong>{{ auth()->user()->name ?? session('user_name') }}</strong>
            </small>
            <span class="badge bg-primary">{{ $data->count() }} Data</span>
        </div>
        
        <!-- Alert Messages -->
        @if(session('success'))
        <div class="alert alert-success alert-dismissible fade show" role="alert">
            <i class="bi bi-check-circle me-2"></i>{{ session('success') }}
            <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
        </div>
        @endif
        @if(session('error'))
        <div class="alert alert-danger alert-dismissible fade show" role="alert">
            <i class="bi bi-exclamation-triangle me-2"></i>{{ session('error') }}
            <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
        </div>
        @endif
        
        <!-- Action Buttons & Filter Toggle -->
        <div class="d-flex justify-content-between align-items-center mb-3">
            <div>
                <button class="btn btn-outline-primary btn-sm" type="button" data-bs-toggle="collapse" data-bs-target="#filterCollapse">
                    <i class="bi bi-funnel"></i> Filter
                </button>
                <a href="{{ route('admin.pengaduan.index') }}" class="btn btn-outline-secondary btn-sm ms-1">
                    <i class="bi bi-x-circle"></i> Reset
                </a>
            </div>
        </div>

        <!-- Filter Form (Collapse) -->
        <div class="collapse mb-3" id="filterCollapse">
            <div class="card card-body">
                <form action="{{ route('admin.pengaduan.index') }}" method="GET">
                    <div class="row g-3">
                        <!-- Nama Siswa -->
                        <div class="col-md-4">
                            <label class="form-label">Nama Siswa</label>
                            <input type="text" name="nama" class="form-control" 
                                   placeholder="Cari nama..." value="{{ request('nama') }}">
                        </div>
                        <!-- Tanggal Dari -->
                        <div class="col-md-3">
                            <label class="form-label">Tanggal Dari</label>
                            <input type="date" name="tanggal_dari" class="form-control" 
                                   value="{{ request('tanggal_dari') }}">
                        </div>
                        <!-- Status (PENGGANTI Tanggal Sampai) -->
                        <div class="col-md-3">
                            <label class="form-label">Status</label>
                            <select name="status" class="form-select">
                                <option value="">Semua Status</option>
                                <option value="menunggu" {{ request('status') == 'menunggu' ? 'selected' : '' }}>Menunggu</option>
                                <option value="proses" {{ request('status') == 'proses' ? 'selected' : '' }}>Proses</option>
                                <option value="selesai" {{ request('status') == 'selesai' ? 'selected' : '' }}>Selesai</option>
                            </select>
                        </div>
                        <!-- Tombol Cari -->
                        <div class="col-md-2 d-flex align-items-end">
                            <button type="submit" class="btn btn-primary w-100">
                                <i class="bi bi-search"></i> Cari
                            </button>
                        </div>
                    </div>
                </form>
            </div>
        </div>

        <!-- Show Active Filters -->
        @if(request()->anyFilled(['nama', 'tanggal_dari', 'status']))
        <div class="alert alert-info d-flex align-items-center mb-3">
            <i class="bi bi-info-circle me-2"></i>
            <div>
                <strong>Filter Aktif:</strong>
                @if(request('nama'))
                    <span class="badge bg-primary ms-2">Nama: {{ request('nama') }}</span>
                @endif
                @if(request('tanggal_dari'))
                    <span class="badge bg-primary ms-2">Tanggal: {{ request('tanggal_dari') }}</span>
                @endif
                @if(request('status'))
                    <span class="badge bg-primary ms-2">Status: {{ ucfirst(request('status')) }}</span>
                @endif
                <a href="{{ route('admin.pengaduan.index') }}" class="ms-2 text-danger"><i class="bi bi-x-circle"></i></a>
            </div>
        </div>
        @endif
        
        <!-- Tabel Data Pengaduan -->
        <div class="table-card">
            <div class="table-responsive">
                <table class="table table-hover mb-0">
                    <thead>
                        <tr>
                            <th width="5%" class="text-center">No</th>
                            <th width="22%">Nama Siswa</th>
                            <th width="25%">Judul Pengaduan</th>
                            <th width="12%" class="text-center">Status</th>
                            <th width="13%" class="text-center">Foto</th>
                            <th width="13%" class="text-center">Tanggal</th>
                            <th width="10%" class="text-center">Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($data as $item)
                        <tr>
                            <td class="text-center">{{ $loop->iteration }}</td>
                            
                            <td>
                                <div class="d-flex align-items-center">
                                    <div class="student-avatar">
                                        {{ strtoupper(substr($item->user->name ?? 'U', 0, 1)) }}
                                    </div>
                                    <div>
                                        <div class="fw-semibold">{{ $item->user->name ?? 'N/A' }}</div>
                                        <small class="text-muted">{{ $item->user->email ?? '-' }}</small>
                                    </div>
                                </div>
                            </td>
                            
                            <td>
                                <div class="fw-semibold">{{ $item->judul ?? \Str::limit($item->isi, 40) }}</div>
                                <small class="text-muted">
                                    <i class="bi bi-clock"></i> {{ $item->created_at->format('d/m/Y H:i') }}
                                </small>
                            </td>
                            
                            <td class="text-center">
                                @if($item->status == 'selesai')
                                    <span class="status-badge status-selesai">✅ Selesai</span>
                                @elseif($item->status == 'proses')
                                    <span class="status-badge status-proses">🔄 Proses</span>
                                @else
                                    <span class="status-badge status-menunggu">⏳ Menunggu</span>
                                @endif
                            </td>
                            
                            <td class="text-center">
                                @if($item->foto)
                                    <img src="{{ asset('uploads/'.$item->foto) }}" 
                                         class="table-img" alt="Foto"
                                         onerror="this.src='https://via.placeholder.com/70x50?text=No+Img'">
                                @else
                                    <span class="text-muted small">-</span>
                                @endif
                            </td>
                            
                            <td class="text-center">
                                <small>{{ $item->created_at->format('d/m/y') }}</small><br>
                                <span class="text-muted" style="font-size: 0.75rem;">{{ $item->created_at->format('H:i') }}</span>
                            </td>
                            
                            <td class="text-center">
                                <a href="{{ route('admin.pengaduan.show', $item->id) }}" 
                                   class="action-btn btn-view" title="Lihat Detail">
                                    <i class="bi bi-eye"></i>
                                </a>
                                <a href="{{ route('admin.pengaduan.edit', $item->id) }}" 
                                   class="action-btn btn-edit" title="Edit Status">
                                    <i class="bi bi-pencil"></i>
                                </a>
                                <button type="button" class="action-btn btn-delete" 
                                        onclick="confirmDelete({{ $item->id }})" title="Hapus">
                                    <i class="bi bi-trash"></i>
                                </button>
                            </td>
                        </tr>
                        @empty
                        <tr>
                            <td colspan="7">
                                <div class="empty-state">
                                    <i class="bi bi-inbox"></i>
                                    <h5 class="mt-3">Belum Ada Pengaduan</h5>
                                    <p class="mb-0 small">Pengaduan dari siswa akan muncul di sini</p>
                                </div>
                            </td>
                        </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>
        
        <!-- Footer Info -->
        <div class="text-center text-muted mt-4">
            <small>
                Menampilkan {{ $data->count() }} pengaduan 
                | Diperbarui: {{ now()->format('d/m/Y H:i') }}
            </small>
        </div>
    </main>

    <!-- Bootstrap JS (FIXED: hapus spasi di URL) -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    
    <!-- Custom JS -->
    <script>
        // Toggle Sidebar Mobile
        function toggleSidebar() {
            document.getElementById('sidebar').classList.toggle('active');
            document.querySelector('.sidebar-overlay').classList.toggle('active');
        }

        // Close sidebar when clicking link (mobile)
        document.querySelectorAll('.nav-link').forEach(link => {
            link.addEventListener('click', () => {
                if (window.innerWidth <= 992) {
                    toggleSidebar();
                }
            });
        });

        // Confirm Delete
        function confirmDelete(id) {
            if (confirm('Yakin ingin menghapus pengaduan ini?')) {
                const form = document.createElement('form');
                form.method = 'POST';
                form.action = `/admin/pengaduan/${id}`;
                form.innerHTML = `@csrf @method('DELETE')`;
                document.body.appendChild(form);
                form.submit();
            }
        }

        // Confirm Logout
        function confirmLogout() {
            if (confirm('Apakah Anda yakin ingin logout?')) {
                document.getElementById('logout-form').submit();
            }
        }

        // Auto-hide alerts
        document.addEventListener('DOMContentLoaded', function() {
            const alerts = document.querySelectorAll('.alert');
            alerts.forEach(alert => {
                setTimeout(() => {
                    const bsAlert = bootstrap.Alert.getOrCreateInstance(alert);
                    bsAlert.close();
                }, 5000);
            });
        });

        // Reset sidebar on desktop resize
        window.addEventListener('resize', function() {
            if (window.innerWidth > 992) {
                document.getElementById('sidebar').classList.remove('active');
                document.querySelector('.sidebar-overlay').classList.remove('active');
            }
        });
    </script>
</body>
</html>
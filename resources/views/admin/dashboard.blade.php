<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard - Admin Panel</title>
    
    <!-- Bootstrap 5 CSS (FIXED: hapus spasi di URL) -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <!-- Bootstrap Icons (FIXED: hapus spasi di URL) -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.0/font/bootstrap-icons.css">
    
    <style>
        * { margin: 0; padding: 0; box-sizing: border-box; }

        body {
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            background-color: #f8f9fa;
        }

        /* ===== SIDEBAR STYLES ===== */
        .sidebar {
            background: linear-gradient(180deg, #ffffff 0%, #f8f9fa 100%);
            min-height: 100vh;
            box-shadow: 2px 0 10px rgba(0, 0, 0, 0.05);
            transition: all 0.3s ease;
            position: fixed;
            left: 0;
            top: 0;
            z-index: 1000;
            width: 280px;
        }

        .sidebar-header {
            padding: 25px 20px;
            border-bottom: 2px solid #f0f0f0;
        }

        .sidebar-brand {
            display: flex;
            align-items: center;
            gap: 12px;
            text-decoration: none;
        }

        .brand-icon {
            width: 45px;
            height: 45px;
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            border-radius: 12px;
            display: flex;
            align-items: center;
            justify-content: center;
            color: white;
            font-size: 1.5rem;
        }

        .brand-text h1 {
            font-size: 1.3rem;
            font-weight: 700;
            color: #2d3748;
            margin: 0;
            line-height: 1.2;
        }

        .brand-text span {
            font-size: 0.85rem;
            color: #718096;
            font-weight: 500;
        }

        /* Navigation Menu */
        .sidebar-nav { padding: 20px 15px; list-style: none; }
        .nav-item { margin-bottom: 5px; }

        .nav-link {
            display: flex;
            align-items: center;
            gap: 12px;
            padding: 14px 18px;
            color: #4a5568;
            text-decoration: none;
            border-radius: 12px;
            transition: all 0.3s ease;
            font-weight: 500;
            font-size: 0.95rem;
        }

        .nav-link i { font-size: 1.2rem; width: 24px; text-align: center; }

        .nav-link:hover {
            background-color: #edf2f7;
            color: #2d3748;
            transform: translateX(5px);
        }

        .nav-link.active {
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            color: white;
            box-shadow: 0 4px 15px rgba(102, 126, 234, 0.4);
        }

        .nav-link.active i { color: white; }

        .nav-divider {
            height: 1px;
            background-color: #e2e8f0;
            margin: 20px 15px;
        }

        .logout-btn { color: #e53e3e !important; }
        .logout-btn:hover {
            background-color: #fff5f5 !important;
            color: #c53030 !important;
        }

        /* ===== MAIN CONTENT ===== */
        .main-content {
            margin-left: 280px;
            padding: 30px;
            transition: all 0.3s ease;
            min-height: 100vh;
        }

        /* ===== HEADER ===== */
        .page-header {
            background: white;
            padding: 25px 30px;
            border-radius: 15px;
            box-shadow: 0 2px 10px rgba(0, 0, 0, 0.05);
            margin-bottom: 30px;
        }

        .page-header h2 {
            font-size: 1.8rem;
            font-weight: 700;
            color: #2d3748;
            margin: 0;
        }

        .page-header .subtitle {
            color: #718096;
            margin-top: 5px;
            font-size: 0.95rem;
        }

        /* ===== STATS CARDS ===== */
        .stat-card {
            background: white;
            border-radius: 15px;
            padding: 25px;
            box-shadow: 0 2px 10px rgba(0, 0, 0, 0.05);
            transition: transform 0.3s ease;
            border: none;
            height: 100%;
        }

        .stat-card:hover {
            transform: translateY(-5px);
            box-shadow: 0 5px 20px rgba(0, 0, 0, 0.1);
        }

        .stat-icon {
            width: 50px;
            height: 50px;
            border-radius: 12px;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 1.5rem;
            margin-bottom: 15px;
        }

        .stat-icon.blue { background: linear-gradient(135deg, #667eea 0%, #764ba2 100%); color: white; }
        .stat-icon.yellow { background: linear-gradient(135deg, #f6d365 0%, #fda085 100%); color: white; }
        .stat-icon.green { background: linear-gradient(135deg, #84fab0 0%, #8fd3f4 100%); color: white; }
        .stat-icon.red { background: linear-gradient(135deg, #fa709a 0%, #fee140 100%); color: white; }

        .stat-label { font-size: 0.9rem; color: #718096; font-weight: 500; margin-bottom: 8px; }
        .stat-value { font-size: 2rem; font-weight: 700; color: #2d3748; }

        /* ===== TOGGLE & OVERLAY ===== */
        .sidebar-toggle {
            display: none;
            position: fixed;
            top: 20px;
            left: 20px;
            z-index: 1001;
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            color: white;
            border: none;
            width: 45px;
            height: 45px;
            border-radius: 10px;
            font-size: 1.3rem;
            box-shadow: 0 4px 15px rgba(102, 126, 234, 0.4);
            cursor: pointer;
            align-items: center;
            justify-content: center;
        }

        .sidebar-overlay {
            display: none;
            position: fixed;
            top: 0; left: 0; right: 0; bottom: 0;
            background: rgba(0,0,0,0.5);
            z-index: 999;
        }

        /* ===== RESPONSIVE ===== */
        @media (max-width: 992px) {
            .sidebar { transform: translateX(-100%); }
            .sidebar.active { transform: translateX(0); }
            .main-content { margin-left: 0; padding: 80px 20px 30px; }
            .sidebar-toggle { display: flex; }
            .sidebar-overlay.active { display: block; }
        }

        @media (max-width: 576px) {
            .page-header { padding: 20px; }
            .page-header h2 { font-size: 1.4rem; }
            .stat-card { margin-bottom: 15px; }
        }

        /* ===== USER BADGE ===== */
        .user-badge {
            background: #edf2f7;
            padding: 15px 20px;
            border-radius: 12px;
            margin: 15px;
            display: flex;
            align-items: center;
            gap: 12px;
        }

        .user-avatar {
            width: 40px;
            height: 40px;
            border-radius: 50%;
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            display: flex;
            align-items: center;
            justify-content: center;
            color: white;
            font-weight: 600;
        }

        .user-info { flex: 1; }
        .user-name { font-weight: 600; color: #2d3748; font-size: 0.9rem; }
        .user-role { font-size: 0.8rem; color: #718096; }

        /* ===== TABLE STYLES ===== */
        .table-card {
            background: white;
            border-radius: 15px;
            padding: 25px;
            box-shadow: 0 2px 10px rgba(0, 0, 0, 0.05);
        }

        .table-card h5 { font-weight: 700; color: #2d3748; margin-bottom: 20px; }

        .table thead th {
            background-color: #f8f9fa;
            border: none;
            font-weight: 600;
            color: #4a5568;
        }

        .table tbody td { vertical-align: middle; }

        .badge-status {
            padding: 8px 15px;
            border-radius: 20px;
            font-weight: 500;
            font-size: 0.85rem;
        }
    </style>
</head>
<body>

    <!-- Toggle Button Mobile -->
    <button class="sidebar-toggle" onclick="toggleSidebar()">
        <i class="bi bi-list fs-4"></i>
    </button>

    <!-- Overlay -->
    <div class="sidebar-overlay" onclick="toggleSidebar()"></div>

    <!-- Sidebar -->
    <aside class="sidebar" id="sidebar">
        <!-- Sidebar Header -->
        <div class="sidebar-header">
            <a href="#" class="sidebar-brand">
                <div class="brand-icon">
                    <i class="bi bi-shield-lock"></i>
                </div>
                <div class="brand-text">
                    <h1>Admin Panel</h1>
                    <span>Sistem Pengaduan</span>
                </div>
            </a>
        </div>

        <!-- User Badge -->
        <div class="user-badge">
            <div class="user-avatar">A</div>
            <div class="user-info">
                <div class="user-name">{{ auth()->user()->name ?? session('user_name', 'Administrator') }}</div>
                <div class="user-role">Admin</div>
            </div>
        </div>

        <!-- Navigation (FIXED: active class dinamis) -->
        <ul class="sidebar-nav">
            <li class="nav-item">
                <a href="{{ route('admin.dashboard') }}" 
                   class="nav-link {{ request()->routeIs('admin.dashboard') ? 'active' : '' }}">
                    <i class="bi bi-speedometer2"></i>
                    <span>Dashboard</span>
                </a>
            </li>
            
            <li class="nav-item">
                <a href="{{ route('admin.pengaduan.index') }}" 
                   class="nav-link {{ request()->routeIs('admin.pengaduan.*') ? 'active' : '' }}">
                    <i class="bi bi-chat-text"></i>
                    <span>Data Pengaduan</span>
                </a>
            </li>
            
            <li class="nav-item">
                <a href="{{ route('admin.siswa.index') }}" 
                   class="nav-link {{ request()->routeIs('admin.siswa.*') ? 'active' : '' }}">
                    <i class="bi bi-people"></i>
                    <span>Data Siswa</span>
                </a>
            </li>

            <div class="nav-divider"></div>

            <!-- Logout (FIXED: dengan form + JS handler) -->
            <li class="nav-item">
                <a href="{{ route('logout') }}" 
                   class="nav-link logout-btn"
                   onclick="event.preventDefault(); confirmLogout()">
                    <i class="bi bi-box-arrow-right"></i>
                    <span>Logout</span>
                </a>
                <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                    @csrf
                </form>
            </li>
        </ul>
    </aside>

    <!-- Main Content -->
    <main class="main-content">
        <!-- Page Header -->
        <div class="page-header">
            <h2><i class="bi bi-bar-chart-line me-2"></i>Dashboard</h2>
            <div class="subtitle">Ringkasan Sistem Pengaduan Sekolah</div>
            <div class="mt-2 text-muted small">
                Login sebagai: <strong>{{ auth()->user()->name ?? session('user_name', 'Administrator') }}</strong>
            </div>
        </div>

        <!-- Stats Cards -->
        <div class="row g-4 mb-4">
            <div class="col-xl-3 col-md-6">
                <div class="stat-card">
                    <div class="stat-icon blue">
                        <i class="bi bi-chat-square-text"></i>
                    </div>
                    <div class="stat-label">Total Pengaduan</div>
                    <div class="stat-value">{{ $totalPengaduan ?? 0 }}</div>
                </div>
            </div>
            
            <div class="col-xl-3 col-md-6">
                <div class="stat-card">
                    <div class="stat-icon yellow">
                        <i class="bi bi-clock-history"></i>
                    </div>
                    <div class="stat-label">Menunggu</div>
                    <div class="stat-value">{{ $menunggu ?? 0 }}</div>
                </div>
            </div>
            
            <div class="col-xl-3 col-md-6">
                <div class="stat-card">
                    <div class="stat-icon green">
                        <i class="bi bi-check-circle"></i>
                    </div>
                    <div class="stat-label">Diproses</div>
                    <div class="stat-value">{{ $diproses ?? 0 }}</div>
                </div>
            </div>

            <div class="col-xl-3 col-md-6">
                <div class="stat-card">
                    <div class="stat-icon red">
                        <i class="bi bi-x-circle"></i>
                    </div>
                    <div class="stat-label">Selesai</div>
                    <div class="stat-value">{{ $selesai ?? 0 }}</div>
                </div>
            </div>
        </div>

        <!-- Recent Complaints Table -->
        <div class="table-card">
            <div class="d-flex justify-content-between align-items-center mb-4">
                <h5><i class="bi bi-list-ul me-2"></i>Pengaduan Terbaru</h5>
                <a href="{{ route('admin.pengaduan.index') }}" class="btn btn-sm btn-primary">
                    Lihat Semua <i class="bi bi-arrow-right ms-1"></i>
                </a>
            </div>
            
            <div class="table-responsive">
                <table class="table table-hover">
                    <thead>
                        <tr>
                            <th>No</th>
                            <th>Nama Siswa</th>
                        
                            <th>Tanggal</th>
                            <th>Status</th>
                            <th>Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($pengaduanTerbaru ?? [] as $index => $pengaduan)
                        <tr>
                            <td>{{ $index + 1 }}</td>
                            
                            <!-- FIXED: Nama Siswa dengan fallback multi-relasi -->
                            <td>
                                {{ 
                                    $pengaduan->siswa->nama ?? 
                                    $pengaduan->siswa->name ?? 
                                    $pengaduan->user->name ?? 
                                    $pengaduan->user->nama ?? 
                                    $pengaduan->nama_siswa ?? 
                                    'N/A' 
                                }}
                            </td>
                            
                            <!-- FIXED: Kelas dengan fallback -->
                           
                            
                            <td>{{ $pengaduan->created_at->format('d M Y') }}</td>
                            
                            <td>
                                @if($pengaduan->status == 'menunggu')
                                    <span class="badge bg-warning badge-status">Menunggu</span>
                                @elseif($pengaduan->status == 'diproses')
                                    <span class="badge bg-primary badge-status">Diproses</span>
                                @else
                                    <span class="badge bg-success badge-status">Selesai</span>
                                @endif
                            </td>
                            
                            <td>
                                <a href="{{ route('admin.pengaduan.show', $pengaduan->id) }}" 
                                   class="btn btn-sm btn-info text-white">
                                    <i class="bi bi-eye"></i> Lihat
                                </a>
                            </td>
                        </tr>
                        @empty
                        <tr>
                            <td colspan="6" class="text-center text-muted py-4">
                                <i class="bi bi-inbox fs-1 d-block mb-2"></i>
                                Belum ada pengaduan
                            </td>
                        </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>
    </main>

    <!-- Bootstrap 5 JS (FIXED: hapus spasi di URL) -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    
    <script>
        // Toggle Sidebar for Mobile
        function toggleSidebar() {
            document.getElementById('sidebar').classList.toggle('active');
            document.querySelector('.sidebar-overlay').classList.toggle('active');
        }

        // Close sidebar when clicking on a link (mobile)
        document.querySelectorAll('.nav-link').forEach(link => {
            link.addEventListener('click', () => {
                if (window.innerWidth <= 992) {
                    toggleSidebar();
                }
            });
        });

        // FIXED: Logout handler dengan CSRF
        function confirmLogout() {
            if (confirm('Apakah Anda yakin ingin logout?')) {
                document.getElementById('logout-form').submit();
            }
        }
    </script>
</body>
</html>
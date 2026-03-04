{{-- resources/views/siswa/dashboard.blade.php --}}
<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard Siswa - Sistem Pengaduan</title>

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.0/font/bootstrap-icons.css">

<style>
body{
    background:linear-gradient(135deg,#667eea 0%,#764ba2 100%);
    min-height:100vh;
}

.sidebar{
    background:white;
    min-height:100vh;
    padding:30px 0;
    box-shadow:4px 0 10px rgba(0,0,0,.1);
}

.sidebar-brand{
    font-size:22px;
    font-weight:bold;
    color:#667eea;
    padding:0 25px;
    margin-bottom:30px;
}

.sidebar-link{
    display:block;
    padding:14px 25px;
    margin:8px 15px;
    border-radius:12px;
    text-decoration:none;
    color:#64748b;
    transition:.3s;
}

.sidebar-link:hover{
    background:#f1f5f9;
    color:#667eea;
}

.sidebar-link.active{
    background:linear-gradient(135deg,#667eea,#764ba2);
    color:white;
}

.main-content{
    padding:30px;
}

.stats-card{
    background:white;
    border-radius:18px;
    padding:25px;
    box-shadow:0 4px 20px rgba(0,0,0,.08);
}

.value{
    font-size:32px;
    font-weight:bold;
}
</style>
</head>

<body>

<div class="container-fluid">
<div class="row">

{{-- SIDEBAR --}}
<div class="col-md-2 sidebar">

    <div class="sidebar-brand">
        🎓 Siswa Panel
    </div>

    <a href="{{ route('siswa.dashboard') }}" class="sidebar-link active">
        <i class="bi bi-speedometer2"></i> Dashboard
    </a>

    <a href="{{ route('siswa.pengaduan.index') }}" class="sidebar-link">
        <i class="bi bi-chat-text"></i> Pengaduanku
    </a>

    <a href="{{ route('siswa.pengaduan.create') }}" class="sidebar-link">
        <i class="bi bi-plus-circle"></i> Buat Pengaduan
    </a>

    <form action="{{ route('logout') }}" method="POST" class="px-3 mt-4">
        @csrf
        <button class="sidebar-link border-0 bg-transparent w-100 text-start text-danger">
            <i class="bi bi-box-arrow-right"></i> Logout
        </button>
    </form>

</div>

{{-- MAIN --}}
<div class="col-md-10 main-content">

{{-- WELCOME --}}
<div class="bg-white p-4 rounded-4 shadow-sm mb-4">
    <h4>
        👋 Selamat Datang,
        <b>{{ session('user_name') ?? 'Siswa' }}</b>
    </h4>
    <small class="text-muted">Dashboard Sistem Pengaduan Sekolah</small>
</div>

{{-- STATISTIK --}}
<div class="row g-4">

<div class="col-md-3">
<div class="stats-card text-center">
    <p>Total Pengaduan</p>
    <div class="value">{{ $totalPengaduan ?? 0 }}</div>
</div>
</div>

<div class="col-md-3">
<div class="stats-card text-center">
    <p class="text-warning">Menunggu</p>
    <div class="value text-warning">{{ $pengaduanMenunggu ?? 0 }}</div>
</div>
</div>

<div class="col-md-3">
<div class="stats-card text-center">
    <p class="text-primary">Diproses</p>
    <div class="value text-primary">{{ $pengaduanProses ?? 0 }}</div>
</div>
</div>

<div class="col-md-3">
<div class="stats-card text-center">
    <p class="text-success">Selesai</p>
    <div class="value text-success">{{ $pengaduanSelesai ?? 0 }}</div>
</div>
</div>

</div>

{{-- AKSI CEPAT --}}
<div class="bg-white p-4 rounded-4 shadow-sm mt-4">
    <h5>⚡ Aksi Cepat</h5>

    <a href="{{ route('siswa.pengaduan.create') }}" class="btn btn-primary">
        ➕ Buat Pengaduan
    </a>

    <a href="{{ route('siswa.pengaduan.index') }}" class="btn btn-secondary">
        📄 Lihat Pengaduan
    </a>
</div>

</div>
</div>
</div>

</body>
</html>

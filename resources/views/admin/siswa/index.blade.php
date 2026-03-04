<!DOCTYPE html>
<html lang="id">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>Data Siswa - Admin</title>

<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.0/font/bootstrap-icons.css">

<style>

body{
    background:#f4f6f9;
    font-family:'Segoe UI',sans-serif;
}

/* ================= SIDEBAR ================= */

.sidebar{
    background:linear-gradient(180deg,#ffffff 0%,#f8f9fa 100%);
    min-height:100vh;
    position:fixed;
    width:280px;
    box-shadow:2px 0 10px rgba(0,0,0,.05);
}

.sidebar-header{
    padding:25px 20px;
    border-bottom:2px solid #f0f0f0;
}

.sidebar-brand{
    display:flex;
    gap:12px;
    text-decoration:none;
}

.brand-icon{
    width:45px;
    height:45px;
    border-radius:12px;
    display:flex;
    align-items:center;
    justify-content:center;
    color:white;
    font-size:1.5rem;
    background:linear-gradient(135deg,#667eea,#764ba2);
}

.brand-text h1{
    font-size:1.3rem;
    margin:0;
    font-weight:700;
}

.brand-text span{
    font-size:.85rem;
    color:#718096;
}

.sidebar-nav{
    list-style:none;
    padding:20px 15px;
}

.nav-link{
    display:flex;
    gap:12px;
    padding:14px 18px;
    border-radius:12px;
    text-decoration:none;
    color:#4a5568;
    font-weight:500;
    transition:.3s;
}

.nav-link:hover{
    background:#edf2f7;
    transform:translateX(5px);
}

.nav-link.active{
    background:linear-gradient(135deg,#667eea,#764ba2);
    color:white;
}

.nav-divider{
    height:1px;
    background:#e2e8f0;
    margin:20px 15px;
}

.user-badge{
    background:#edf2f7;
    margin:15px;
    padding:15px;
    border-radius:12px;
    display:flex;
    gap:12px;
}

.user-avatar{
    width:40px;
    height:40px;
    border-radius:50%;
    background:linear-gradient(135deg,#667eea,#764ba2);
    color:white;
    display:flex;
    align-items:center;
    justify-content:center;
    font-weight:bold;
}

/* ================= MAIN ================= */

.main-content{
    margin-left:280px;
    padding:30px;
}

.page-header{
    background:white;
    padding:25px;
    border-radius:15px;
    box-shadow:0 2px 10px rgba(0,0,0,.05);
    margin-bottom:25px;
}

/* TABLE CARD (TABLE LUAR) */
.table-card{
    background:white;
    border-radius:15px;
    padding:25px;
    box-shadow:0 2px 10px rgba(0,0,0,.05);
}

/* TABLE STYLE */
.table thead th{
    background:#f8f9fa;
    border:none;
    font-weight:600;
}

.table tbody td{
    vertical-align:middle;
    border-top:1px solid #f1f1f1;
}

/* AVATAR */
.student-avatar{
    width:42px;
    height:42px;
    border-radius:50%;
    background:linear-gradient(135deg,#667eea,#764ba2);
    color:white;
    display:flex;
    align-items:center;
    justify-content:center;
    font-weight:bold;
}

/* BADGE */
.student-badge{
    background:#f1f3ff;
    color:#4c51bf;
    padding:7px 14px;
    border-radius:999px;
    font-size:.85rem;
    display:inline-flex;
    align-items:center;
    gap:6px;
}

/* ACTION */
.action-bubble{
    background:#f8f9fa;
    padding:6px 10px;
    border-radius:999px;
    display:inline-flex;
    gap:6px;
}

</style>
</head>

<body>

{{-- PROTEKSI ADMIN --}}
@if(session('role')!='admin')
<script>window.location.href="/login";</script>
@endif

<!-- SIDEBAR -->
<aside class="sidebar">

<div class="sidebar-header">
<div class="sidebar-brand">
<div class="brand-icon">
<i class="bi bi-shield-lock"></i>
</div>
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
<a href="{{ route('admin.dashboard') }}" class="nav-link">
<i class="bi bi-speedometer2"></i> Dashboard
</a>
</li>

<li>
<a href="{{ route('admin.pengaduan.index') }}" class="nav-link">
<i class="bi bi-chat-text"></i> Data Pengaduan
</a>
</li>

<li>
<a href="{{ route('admin.siswa.index') }}" class="nav-link active">
<i class="bi bi-people"></i> Data Siswa
</a>
</li>

<div class="nav-divider"></div>

<li>
<form action="{{ route('logout') }}" method="POST">
@csrf
<button class="nav-link w-100 border-0 bg-transparent text-start text-danger">
<i class="bi bi-box-arrow-right"></i> Logout
</button>
</form>
</li>

</ul>
</aside>

<!-- MAIN -->
<main class="main-content">

<div class="page-header">
<h4>👥 Data Siswa</h4>
<small class="text-muted">Kelola data siswa terdaftar</small>
</div>

 <!-- User Info -->
                <div class="d-flex justify-content-between align-items-center mb-3">
                    <small class="text-muted">
                        Login sebagai admin: <strong>{{ auth()->user()->name ?? session('user_name') }}</strong>
                    </small>
                </div>

<div class="d-flex justify-content-end mb-3">
<a href="{{ route('admin.siswa.create') }}" class="btn btn-primary btn-sm">
<i class="bi bi-person-plus"></i> Tambah Siswa
</a>
</div>

<div class="table-card">

<div class="table-responsive">
<table class="table align-middle">

<thead>
<tr>
<th width="60">No</th>
<th>Nama</th>
<th>Email</th>
<th>Terdaftar</th>
<th class="text-center">Aksi</th>
</tr>
</thead>

<tbody>

@forelse($data as $item)
<tr>

<td class="text-center fw-semibold">
{{ $loop->iteration }}
</td>

<td>
<div class="d-flex align-items-center gap-3">
<div class="student-avatar">
{{ strtoupper(substr($item->name,0,1)) }}
</div>
<div>
<div class="fw-semibold">{{ $item->name }}</div>
<small class="text-muted">Siswa</small>
</div>
</div>
</td>

<td>
<span class="student-badge">
<i class="bi bi-envelope"></i>
{{ $item->email }}
</span>
</td>

<td>
<span class="student-badge">
<i class="bi bi-calendar"></i>
{{ $item->created_at->format('d M Y') }}
</span>
</td>

<td class="text-center">
<div class="action-bubble">

<a href="{{ route('admin.siswa.edit',$item->id) }}"
class="btn btn-warning btn-sm">
<i class="bi bi-pencil"></i>
</a>

<form action="{{ route('admin.siswa.delete',$item->id) }}"
method="POST"
onsubmit="return confirm('Hapus siswa ini?')">
@csrf
@method('DELETE')

<button class="btn btn-danger btn-sm">
<i class="bi bi-trash"></i>
</button>
</form>

</div>
</td>

</tr>

@empty
<tr>
<td colspan="5" class="text-center py-5 text-muted">
Belum ada data siswa
</td>
</tr>
@endforelse

</tbody>

</table>
</div>

</div>

</main>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>

</body>
</html>

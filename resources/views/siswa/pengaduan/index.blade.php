<!DOCTYPE html>
<html lang="id">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>Pengaduanku</title>

<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.0/font/bootstrap-icons.css">

<style>
body{
    background:linear-gradient(135deg,#667eea,#764ba2);
    font-family:'Segoe UI',sans-serif;
}

/* SIDEBAR */
.sidebar{
    background:white;
    min-height:100vh;
    padding:30px 0;
    box-shadow:4px 0 15px rgba(0,0,0,.05);
    position:fixed;
    width:250px;
}

.sidebar-brand{
    font-size:22px;
    font-weight:bold;
    color:#667eea;
    padding:0 25px;
}

.sidebar-sub{
    font-size:14px;
    color:#94a3b8;
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
    font-weight:500;
}

.sidebar-link i{
    margin-right:10px;
}

.sidebar-link:hover{
    background:#f1f5f9;
    color:#667eea;
}

.sidebar-link.active{
    background:linear-gradient(135deg,#667eea,#764ba2);
    color:white;
}

.logout-btn{
    color:#ef4444 !important;
}

.main-content{
    margin-left:250px;
    padding:30px;
}

/* CARD */
.card-box{
    background:white;
    border-radius:20px;
    padding:30px;
    box-shadow:0 4px 20px rgba(0,0,0,.1);
}

/* Responsive */
@media(max-width:992px){
    .sidebar{
        position:relative;
        width:100%;
        min-height:auto;
    }
    .main-content{
        margin-left:0;
    }
}
</style>
</head>

<body>

<div class="sidebar">

    <div class="sidebar-brand">🎓 Siswa Panel</div>
    <div class="sidebar-sub">Sistem Pengaduan</div>

    <a href="{{ route('siswa.dashboard') }}" class="sidebar-link">
        <i class="bi bi-speedometer2"></i> Dashboard
    </a>

    <a href="{{ route('siswa.pengaduan.index') }}" class="sidebar-link active">
        <i class="bi bi-chat-text"></i> Pengaduanku
    </a>

    <a href="{{ route('siswa.pengaduan.create') }}" class="sidebar-link">
        <i class="bi bi-plus-circle"></i> Buat Pengaduan
    </a>

    <form action="{{ route('logout') }}" method="POST" class="px-3 mt-4">
        @csrf
        <button class="sidebar-link logout-btn border-0 bg-transparent w-100 text-start">
            <i class="bi bi-box-arrow-right"></i> Logout
        </button>
    </form>

</div>

<div class="main-content">

    <div class="card-box">
        <h4 class="mb-4">📋 Pengaduanku</h4>

        <table class="table table-bordered">
            <thead class="table-light">
                <tr>
                    <th>No</th>
                    <th>Judul</th>
                    <th>Status</th>
                    <th>Tanggal</th>
                </tr>
            </thead>
            <tbody>
                @forelse($data as $item)
                <tr>
                    <td>{{ $loop->iteration }}</td>
                    <td>{{ $item->judul }}</td>
                    <td>
                        @if($item->status=='selesai')
                            <span class="badge bg-success">Selesai</span>
                        @elseif($item->status=='proses')
                            <span class="badge bg-info">Diproses</span>
                        @else
                            <span class="badge bg-warning text-dark">Menunggu</span>
                        @endif
                    </td>
                    <td>{{ $item->created_at->format('d/m/Y') }}</td>
                </tr>
                @empty
                <tr>
                    <td colspan="4" class="text-center">Belum ada pengaduan</td>
                </tr>
                @endforelse
            </tbody>
        </table>

    </div>

</div>

</body>
</html>
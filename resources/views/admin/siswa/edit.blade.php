{{-- resources/views/admin/siswa/edit.blade.php --}}
<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Siswa - Admin Panel</title>
    
    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.0/font/bootstrap-icons.css">
    
    <style>
        body { background-color: #f8f9fa; padding-top: 20px; font-family: 'Segoe UI', sans-serif; }
        .sidebar {
            background-color: #0d47a1;
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
            background: linear-gradient(135deg, #0d47a1 0%, #1565c0 100%);
            color: white;
            padding: 20px 30px;
            border-radius: 10px 10px 0 0;
            margin: -30px -30px 20px -30px;
        }
        .header h1 { margin: 0; font-size: 1.8rem; font-weight: 600; }
        .header .subtitle { font-size: 1.1rem; opacity: 0.9; margin-top: 5px; }
        .form-card {
            background: white;
            border-radius: 10px;
            box-shadow: 0 4px 6px rgba(0,0,0,0.05);
            padding: 25px;
            margin-bottom: 20px;
        }
        .form-label { font-weight: 500; color: #495057; }
        .form-control:focus {
            border-color: #0d47a1;
            box-shadow: 0 0 0 0.2rem rgba(13, 71, 161, 0.15);
        }
        .btn-primary {
            background-color: #0d47a1;
            border-color: #0d47a1;
        }
        .btn-primary:hover {
            background-color: #08357a;
            border-color: #08357a;
        }
        .info-box {
            background: #e3f2fd;
            border-left: 4px solid #2196f3;
            padding: 12px 15px;
            border-radius: 0 5px 5px 0;
            margin-bottom: 20px;
            font-size: 0.9rem;
        }
    </style>
</head>
<body>
    <div class="container-fluid">
        <div class="row">
            <!-- Sidebar -->
            <div class="col-md-2 sidebar">
                <div class="sidebar-brand">
                    Admin Panel
                    <span>Sistem Pengaduan</span>
                </div>
                <ul class="nav flex-column">
                    <li class="nav-item">
                        <a href="{{ route('admin.dashboard') }}" class="sidebar-link">
                            <i class="bi bi-speedometer2"></i> Dashboard
                        </a>
                    </li>
                    <li class="nav-item">
                        <a href="{{ route('admin.pengaduan.index') }}" class="sidebar-link">
                            <i class="bi bi-chat-text"></i> Data Pengaduan
                        </a>
                    </li>
                    <li class="nav-item">
                        <a href="{{ route('admin.siswa.index') }}" class="sidebar-link active">
                            <i class="bi bi-person"></i> Data Siswa
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
                    <h1>✏️ Edit Siswa</h1>
                    <div class="subtitle">Perbarui data siswa</div>
                </div>
                
                <!-- Back Button -->
                <a href="{{ route('admin.siswa.index') }}" class="btn btn-outline-secondary mb-3">
                    <i class="bi bi-arrow-left"></i> Kembali ke Daftar Siswa
                </a>
                
                <!-- Info Box -->
                <div class="info-box">
                    <i class="bi bi-info-circle me-2"></i>
                    <strong>Catatan:</strong> Kosongkan field password jika tidak ingin mengubah password siswa.
                </div>
                
                <!-- Form Card -->
                <div class="form-card">
                    <form action="{{ route('admin.siswa.update', $siswa->id) }}" method="POST">
                        @csrf
                        @method('PUT')
                        
                        <!-- Nama -->
                        <div class="mb-3">
                            <label for="name" class="form-label">Nama Lengkap <span class="text-danger">*</span></label>
                            <input type="text" 
                                   class="form-control @error('name') is-invalid @enderror" 
                                   id="name" 
                                   name="name" 
                                   value="{{ old('name', $siswa->name) }}" 
                                   placeholder="Masukkan nama siswa"
                                   required>
                            @error('name')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                        
                        
                        
                        <!-- Email -->
                        <div class="mb-3">
                            <label for="email" class="form-label">Email <span class="text-danger">*</span></label>
                            <input type="email" 
                                   class="form-control @error('email') is-invalid @enderror" 
                                   id="email" 
                                   name="email" 
                                   value="{{ old('email', $siswa->email) }}" 
                                   placeholder="contoh: siswa@sekolah.sch.id"
                                   required>
                            @error('email')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                        
                        <!-- Password (Optional) -->
                        <div class="mb-3">
                            <label for="password" class="form-label">Password Baru <span class="text-muted">(opsional)</span></label>
                            <input type="password" 
                                   class="form-control @error('password') is-invalid @enderror" 
                                   id="password" 
                                   name="password" 
                                   placeholder="Kosongkan jika tidak ingin mengubah">
                            @error('password')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                            <small class="text-muted">Minimal 6 karakter. Kosongkan untuk tetap menggunakan password lama.</small>
                        </div>
                        
                        <!-- Confirm Password -->
                        <div class="mb-4">
                            <label for="password_confirmation" class="form-label">Konfirmasi Password Baru</label>
                            <input type="password" 
                                   class="form-control" 
                                   id="password_confirmation" 
                                   name="password_confirmation" 
                                   placeholder="Ulangi password baru">
                        </div>
                        
                        <!-- Submit Buttons -->
                        <div class="d-flex gap-2">
                            <button type="submit" class="btn btn-primary">
                                <i class="bi bi-check-circle"></i> Update Data
                            </button>
                            <a href="{{ route('admin.siswa.index') }}" class="btn btn-secondary">
                                <i class="bi bi-x-circle"></i> Batal
                            </a>
                        </div>
                    </form>
                </div>
                
                <!-- Footer Info -->
                <div class="text-center text-muted mt-3">
                    <small>
                        ID Siswa: #{{ $siswa->id }} | Diperbarui: {{ now()->format('d/m/Y H:i') }}
                    </small>
                </div>
            </div>
        </div>
    </div>

    <!-- Bootstrap JS -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    
    <!-- Custom JS: Auto hide validation errors after 5 seconds -->
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const invalidFields = document.querySelectorAll('.is-invalid');
            if (invalidFields.length > 0) {
                // Scroll to first error
                invalidFields[0].scrollIntoView({ behavior: 'smooth', block: 'center' });
            }
        });
    </script>
</body>
</html>
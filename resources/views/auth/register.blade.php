{{-- resources/views/auth/register.blade.php --}}
<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Register Siswa - Sistem Pengaduan</title>
    
    <!-- Bootstrap CSS (URL fixed: tanpa spasi) -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.0/font/bootstrap-icons.css">
    
    <style>
        body {
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            min-height: 100vh;
            display: flex;
            align-items: center;
            justify-content: center;
            font-family: 'Segoe UI', sans-serif;
            padding: 20px;
        }
        .auth-card {
            background: white;
            border-radius: 15px;
            box-shadow: 0 10px 40px rgba(0,0,0,0.2);
            padding: 40px;
            width: 100%;
            max-width: 450px;
        }
        .auth-header {
            text-align: center;
            margin-bottom: 30px;
        }
        .auth-header h1 {
            color: #667eea;
            font-size: 1.8rem;
            font-weight: 700;
            margin-bottom: 5px;
        }
        .auth-header p {
            color: #6c757d;
            font-size: 0.95rem;
        }
        .form-label {
            font-weight: 500;
            color: #495057;
            margin-bottom: 8px;
        }
        .form-control {
            border-radius: 10px;
            padding: 12px 15px;
            border: 2px solid #e9ecef;
            transition: all 0.3s;
        }
        .form-control:focus {
            border-color: #667eea;
            box-shadow: 0 0 0 0.2rem rgba(102, 126, 234, 0.15);
        }
        .form-control.is-invalid {
            border-color: #dc3545;
        }
        .invalid-feedback {
            font-size: 0.85rem;
            margin-top: 5px;
        }
        .btn-primary {
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            border: none;
            border-radius: 10px;
            padding: 12px;
            font-weight: 600;
            width: 100%;
            transition: transform 0.2s;
        }
        .btn-primary:hover {
            transform: translateY(-2px);
            box-shadow: 0 5px 20px rgba(102, 126, 234, 0.4);
        }
        .auth-footer {
            text-align: center;
            margin-top: 25px;
            color: #6c757d;
            font-size: 0.9rem;
        }
        .auth-footer a {
            color: #667eea;
            text-decoration: none;
            font-weight: 500;
        }
        .auth-footer a:hover {
            text-decoration: underline;
        }
        .alert-success {
            border-radius: 10px;
            border: none;
            background: #d4edda;
            color: #155724;
            padding: 12px 15px;
            margin-bottom: 20px;
        }
        .password-hint {
            font-size: 0.8rem;
            color: #6c757d;
            margin-top: 5px;
        }
    </style>
</head>
<body>
    <div class="auth-card">
        <!-- Header -->
        <div class="auth-header">
            <h1>🎓 Register Siswa</h1>
            <p>Buat akun untuk mengakses sistem pengaduan</p>
        </div>
        
        <!-- Success Message -->
        @if(session('success'))
        <div class="alert-success">
            <i class="bi bi-check-circle me-2"></i>{{ session('success') }}
        </div>
        @endif
        
        <!-- Register Form -->
        <form method="POST" action="{{ route('register.post') }}">
            @csrf
            
            <!-- Nama -->
            <div class="mb-3">
                <label for="name" class="form-label">Nama Lengkap</label>
                <input type="text" 
                       class="form-control @error('name') is-invalid @enderror" 
                       id="name" 
                       name="name" 
                       value="{{ old('name') }}" 
                       placeholder="Masukkan nama lengkap"
                       required
                       autofocus>
                @error('name')
                    <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>
            
            <!-- Email -->
            <div class="mb-3">
                <label for="email" class="form-label">Email</label>
                <input type="email" 
                       class="form-control @error('email') is-invalid @enderror" 
                       id="email" 
                       name="email" 
                       value="{{ old('email') }}" 
                       placeholder="contoh: siswa@sekolah.sch.id"
                       required>
                @error('email')
                    <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>
            
            <!-- Password -->
            <div class="mb-3">
                <label for="password" class="form-label">Password</label>
                <input type="password" 
                       class="form-control @error('password') is-invalid @enderror" 
                       id="password" 
                       name="password" 
                       placeholder="Minimal 6 karakter"
                       required>
                @error('password')
                    <div class="invalid-feedback">{{ $message }}</div>
                @enderror
                <div class="password-hint">
                    <i class="bi bi-info-circle me-1"></i>Gunakan password yang kuat
                </div>
            </div>
            
            <!-- Confirm Password -->
            <div class="mb-4">
                <label for="password_confirmation" class="form-label">Konfirmasi Password</label>
                <input type="password" 
                       class="form-control" 
                       id="password_confirmation" 
                       name="password_confirmation" 
                       placeholder="Ulangi password"
                       required>
            </div>
            
            <!-- Submit Button -->
            <button type="submit" class="btn btn-primary">
                <i class="bi bi-person-plus me-2"></i>Daftar Sekarang
            </button>
        </form>
        
        <!-- Footer -->
        <div class="auth-footer">
            Sudah punya akun? <a href="{{ route('login') }}">Login disini</a>
        </div>
    </div>

    <!-- Bootstrap JS (URL fixed: tanpa spasi) -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    
    <!-- Custom JS: Auto focus first error field -->
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const firstError = document.querySelector('.is-invalid');
            if (firstError) {
                firstError.focus();
            }
        });
    </script>
</body>
</html>
<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        Schema::table('pengaduans', function (Blueprint $table) {
            // Tambah kolom user_id jika belum ada
            if (!Schema::hasColumn('pengaduans', 'user_id')) {
                $table->unsignedBigInteger('user_id')->nullable()->after('id');
                $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');
            }
            
            // Tambah kolom judul jika belum ada
            if (!Schema::hasColumn('pengaduans', 'judul')) {
                $table->string('judul')->nullable()->after('user_id');
            }
            
            // Tambah kolom kategori jika belum ada
            if (!Schema::hasColumn('pengaduans', 'kategori')) {
                $table->string('kategori')->nullable()->after('judul');
            }
            
            // Tambah kolom lokasi jika belum ada
            if (!Schema::hasColumn('pengaduans', 'lokasi')) {
                $table->string('lokasi')->nullable()->after('kategori');
            }
            
            // Tambah kolom deskripsi jika belum ada
            if (!Schema::hasColumn('pengaduans', 'deskripsi')) {
                $table->text('deskripsi')->nullable()->after('lokasi');
            }
            
            // Tambah kolom foto jika belum ada
            if (!Schema::hasColumn('pengaduans', 'foto')) {
                $table->string('foto')->nullable()->after('deskripsi');
            }
            
            // Tambah kolom status jika belum ada
            if (!Schema::hasColumn('pengaduans', 'status')) {
                $table->enum('status', ['menunggu', 'diproses', 'selesai', 'ditolak'])->default('menunggu')->after('foto');
            }
            
            // Tambah kolom tanggapan_admin jika belum ada
            if (!Schema::hasColumn('pengaduans', 'tanggapan_admin')) {
                $table->text('tanggapan_admin')->nullable()->after('status');
            }
        });
    }

    public function down(): void
    {
        Schema::table('pengaduans', function (Blueprint $table) {
            // Drop foreign key
            $table->dropForeign(['user_id']);
            
            // Drop semua kolom yang ditambahkan
            $table->dropColumn([
                'user_id',
                'judul',
                'kategori',
                'lokasi',
                'deskripsi',
                'foto',
                'status',
                'tanggapan_admin'
            ]);
        });
    }
};
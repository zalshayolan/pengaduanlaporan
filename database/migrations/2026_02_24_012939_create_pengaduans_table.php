<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        Schema::table('pengaduans', function (Blueprint $table) {
            // Langsung tambah kolom (akan skip jika sudah ada di Laravel 10+)
            $table->unsignedBigInteger('user_id')->nullable()->after('id')->change();
        });
        
        Schema::table('pengaduans', function (Blueprint $table) {
            // Tambah foreign key
            $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');
        });
    }

    public function down(): void
    {
        Schema::table('pengaduans', function (Blueprint $table) {
            $table->dropForeign(['user_id']);
            $table->dropColumn('user_id');
        });
    }
};
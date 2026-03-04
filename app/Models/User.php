<?php
// app/Models/User.php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class User extends Model
{
    // Nama tabel (jika tidak sesuai konvensi Laravel)
    protected $table = 'users';
    
    // Field yang boleh di-mass assign
    protected $fillable = [
        'name',
        'email',
        'password',
        'role',
    ];
    
    // Field yang harus di-hash otomatis
    protected $hidden = [
        'password',
    ];
}
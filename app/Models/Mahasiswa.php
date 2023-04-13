<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Mahasiswa extends Model
{
    use HasFactory;
    protected $table = 'table_mahasiswa';
    protected $primaryKey = 'nim';
    protected $fillable = ['nim','nama_mhs','email','jurusan'];
}

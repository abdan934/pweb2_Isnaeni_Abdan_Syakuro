<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Dosen extends Model
{
    use HasFactory;
    protected $table = 'table_dosen';
    protected $primaryKey = 'nidn';
    protected $fillable = ['nidn','nama_dosen','email','jurusan'];
}

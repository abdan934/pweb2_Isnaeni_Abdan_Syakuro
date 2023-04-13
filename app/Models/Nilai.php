<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Nilai extends Model
{
    use HasFactory;
    protected $table = "table_nilai";
    protected $primaryKey = 'no_matkul';
    protected $fillable = ['nim','id_matkul','angka','predikat','tahun_ajaran','semester'];
}

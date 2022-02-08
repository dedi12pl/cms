<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PenyelenggaraModel extends Model
{
    use HasFactory;

    protected $table = 'penyelenggara';

    protected $fillable = [
        'kd_penyelenggara',
        'nama_penyelenggara',
        'alamat_penyelenggara',
    ];
}

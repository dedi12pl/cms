<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PersyaratanModel extends Model
{
    use HasFactory;

    protected $table = 'persyaratan';

    protected $fillable = [
        'id_layanan',
        'persyaratan'
    ];
}

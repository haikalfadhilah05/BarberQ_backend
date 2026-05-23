<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Barber extends Model
{
    use HasFactory;

    protected $fillable = [
        'nama_barber',
        'spesialisasi',
        'no_hp',
        'status_aktif'
    ];
}

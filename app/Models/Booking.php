<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Booking extends Model
{
    use HasFactory;

    protected $fillable = [
        'nama_customer',
        'no_hp',
        'barber_name',
        'layanan',
        'tanggal_booking',
        'jam_booking',
        'status',
        'user_id'
    ];
}

<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Customer extends Model
{
    use HasFactory;

    // Kolom yang dapat diisi secara mass-assignment
    protected $fillable = [
        'user_id',
        'full_name',   // Nama lengkap pelanggan
        'gender',  // Jenis kelamin pelanggan (misalnya: laki-laki, perempuan)
        'email',          // Email pelanggan
        'phone_number',       // Nomor HP pelanggan
        'address',         // Alamat pelanggan
        'profile_picture',    // URL atau path foto profil pelanggan
    ];

    // Relasi dengan tabel Transactions
    public function transactions()
    {
        return $this->hasMany(Transaction::class);
    }

    // Relasi dengan users
    public function users()
    {
        return $this->belongsTo(User::class);
    }
}

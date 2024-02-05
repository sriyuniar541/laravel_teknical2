<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Kategori extends Model
{
    use HasFactory;

    protected $fillable = [
        'nama'
    ];

    protected $table = 'kategori';

    public function coa()
    {
        return $this->hasMany(Coa::class);
    }

    public function transaksi()
    {
        return $this->hasMany(Transaksi::class);
    }

    public function laporan()
    {
        return $this->hasMany(Laporan::class);
    }
}

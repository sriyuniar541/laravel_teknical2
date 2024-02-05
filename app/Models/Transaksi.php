<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Transaksi extends Model
{
    use HasFactory;

    protected $fillable = [
        'coa_id',
        'desc',
        'debit',
        'credit'
    ];

    protected $table = 'transaksi';

    public function coa()
    {
        return $this->belongsTo(Coa::class, 'coa_id');
    }

    public function kategori()
    {
        return $this->belongsTo(Kategori::class);
    }
}

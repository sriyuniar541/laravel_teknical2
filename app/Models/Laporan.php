<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Laporan extends Model
{
    use HasFactory;

    protected $fillable = [
        'kategori_id',
        'total'
    ];

    protected $table = 'laporan';

    public function kategori()
    {
        return $this->belongsTo(Kategori::class);
    }
}

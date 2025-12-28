<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Media extends Model
{
    use HasFactory;

    protected $table = 'media';
    protected $primaryKey = 'id_media';

    protected $fillable = [
        'judul',
        'file_path',
        'thumb_path',
        'tipe',
        'aktif',
        'urutan',
        'durasi'
    ];
}

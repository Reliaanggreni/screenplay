<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Playlist extends Model
{
    use HasFactory;

    protected $table = 'playlists';
    protected $primaryKey = 'id_playlist';

    protected $fillable = [
        'judul',
        'aktif',
    ];

    public function media()
    {
        return $this->belongsToMany(
            Media::class,
            'playlist_media',
            'id_playlist',
            'id_media'
        )
            ->withPivot(['durasi', 'urutan'])
            ->orderBy('pivot_urutan');
    }
}

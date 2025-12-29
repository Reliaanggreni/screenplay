<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PlaylistMedia extends Model
{
    use HasFactory;

    protected $table = 'playlist_media';

    protected $fillable = [
        'id_playlist',
        'id_media',
        'durasi',
        'urutan',
    ];

    public $timestamps = false;

    public function playlist()
    {
        return $this->belongsTo(Playlist::class, 'id_playlist', 'id_playlist');
    }

    public function media()
    {
        return $this->belongsTo(Media::class, 'id_media', 'id_media');
    }
}

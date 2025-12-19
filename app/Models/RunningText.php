<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class RunningText extends Model
{
    use HasFactory;

    protected $table = 'running_text';
    protected $primaryKey = 'id_running_text';

    protected $fillable = [
        'isi_teks',
        'aktif',
    ];
}

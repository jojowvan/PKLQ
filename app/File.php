<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class File extends Model
{
    protected $table = 'file';

    protected $fillable = [
        'id_cabang', 'id_alat', 'nama_file', 'created_at',
    ];
}

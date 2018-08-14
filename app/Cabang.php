<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Cabang extends Model
{
  protected $table = 'cabang';
  protected $fillable = [
      'nama_cabang', 'ip_server', 'longitude', 'latitude',
  ];
}

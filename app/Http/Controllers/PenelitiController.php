<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;
use App\Alat;
use App\Cabang;
use App\File;
use App\sidebar;
use Hash;
use Auth;
use Alert;

class PenelitiController extends KapusController
{

    public function __construct()
    {
        $this->middleware('auth');
    }

    public function lihatChartPeneliti($id)
    {
      $side = sidebar::orderBy('id_cabang')->get();
      $file = File::orderBy('id_file')->get();
      $alat = Alat::orderBy('id_alat')->get();
      session()->put('file', $file);
      session()->put('id', $id);
      session()->put('alat', $alat);
      return view('Peneliti/agam', compact('side'));
    }

    public function profilPeneliti()
    {
      $side   = sidebar::orderBy('id_cabang')->get();
      return view('Peneliti/profile', compact('side'));
    }

    public function daftarAlatPeneliti()
    {
      $alat = Alat::orderBy('id_alat')->get();
      $cabang = Cabang::orderBy('id_cabang')->get();
      return view('DaftarAlat2', compact('alat'), compact('cabang'));
    }

    public function lihatFilePeneliti()
    {
      $file = File::orderBy('id_file')->get();
      $cabang = Cabang::orderBy('id_cabang')->get();
      $alat = Alat::orderBy('id_alat')->get();
      return view('lihatFile1', compact('file'), compact('cabang'), compact('alat'));
    }
}

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

class KapusController extends Controller
{
  public function gantiPassword(Request $request)
  {
      if (!(Hash::check($request->get('current-password'), Auth::user()->password))) {
        // The passwords matches
        session()->flash('invalidPassword', 'Kata Sandi Tidak Cocok');
        return redirect()->back();

      }

      if(strcmp($request->get('current-password'), $request->get('new-password')) == 0){
        //Current password and new password are same
        session()->flash('invalidPassword', 'Kata Sandi Baru Sama dengan Kata Sandi Lama.Kata Sandi harus Berbeda');
        return redirect()->back();
      }

      $validatedData = $request->validate([
        'current-password' => 'required',
        'new-password' => 'required|string|min:6|confirmed',
      ]);

      //Change Password
      $user = Auth::user();
      // $user->name = $request->name;
      $user->password = bcrypt($request->get('new-password'));
      $user->save();

      return redirect()->back()->with("success","Kata Sandi Berhasil Diubah!");
      session()->flash('passwordChanged', 'Your Password Has Been Changed.');
      // return redirect()->back();
  }

  public function daftarAlatKabid()
  {
    $alat = Alat::orderBy('id_alat')->get();
    $cabang = Cabang::orderBy('id_cabang')->get();
    return view('DaftarAlat1', compact('alat'), compact('cabang'));
  }

  public function lihatChartKabid($id)
  {
    $side = sidebar::orderBy('id_cabang')->get();
    $file = File::orderBy('id_file')->get();
    $alat = Alat::orderBy('id_alat')->get();
    session()->put('file', $file);
    session()->put('id', $id);
    session()->put('alat', $alat);
    return view('kapus/agam', compact('side'));
  }

  public function profilKabid()
  {
    $side   = sidebar::orderBy('id_cabang')->get();
    return view('kapus/profile', compact('side'));
  }
}

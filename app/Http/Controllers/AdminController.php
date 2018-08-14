<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;
use App\Userinfo;
use Illuminate\Support\Facades\Hash;
use App\Notifications\SendPassword;
use Session;
use App\sidebar;
use App\Cabang;
use App\File;
use App\Alat;
use Symfony\Component\Process\Process;
use Symfony\Component\Process\Exception\ProcessFailedException;
use Symfony\Component\Process\InputStream;

session()->regenerate();
error_reporting(0);

class AdminController extends UserController
{
    public function index()
    {
     return view('admin');
    }

    public function view()
    {
      $side   = sidebar::orderBy('id_cabang')->get();
      return view('/tambahStaff', compact('side'));
    }

    public function create(Request $request)
    {
      $pswd = Session::get('password');
      $this->validate($request, array(
              'name'          => 'required|max:100',
              'email'         => 'required|unique:users,email,',
              'identitas'     => 'required',
              'jabatan'        => 'required',
          ));

      $user   = User::create([
              'name'           => $request->input('name'),
              'email'          => $request->input('email'),
              'password'       => Hash::make($pswd),
              'identitas'      => $request->input('identitas'),
              'isAdmin'        => $request->input('jabatan'),
          ]);

      $info = Userinfo::latest()->first($info);
      session()->put('nama', $request->input('name'));
      session()->put('password', $pswd);
      $info->notify(new SendPassword());

      session()->flash('success', 'Anggota Berhasil Ditambahkan');
      return redirect()->back();
    }

    public function viewCabang($id)
    {
        $side = sidebar::orderBy('id_cabang')->get();
        $file = File::orderBy('id_file')->get();
        $alat = Alat::orderBy('id_alat')->get();
        session()->put('file', $file);
        session()->put('alat', $alat);
        session()->put('id', $id);
        return view('Agam', compact('side'));
    }

    public function tambahCabang()
    {
      return view('tambahCabang');
    }

    public function createCabang(Request $request)
    {
      $this->validate($request, array(
              'nama_cabang'    => 'required|max:100',
              'ip_server'      => 'required',
          ));

          $address = $request->input('nama_cabang');

          // Get JSON results from this request
          $geo = file_get_contents('http://maps.googleapis.com/maps/api/geocode/json?address='.urlencode($address).'&sensor=false');
          $geo = json_decode($geo, true); // Convert the JSON to an array

          if (isset($geo['status']) && ($geo['status'] == 'OK')) {
            $latitude = $geo['results'][0]['geometry']['location']['lat']; // Latitude
            $longitude = $geo['results'][0]['geometry']['location']['lng']; // Longitude
          }

      $user   = Cabang::create([
              'nama_cabang'   => $request->input('nama_cabang'),
              'ip_server'     => $request->input('ip_server'),
              'longitude'     => $longitude,
              'latitude'      => $latitude,
          ]);

      session()->flash('success', 'Cabang Berhasil Ditambahkan');
      return redirect()->back();
    }

    public function readAll()
    {
        $readUser = User::orderBy('id')->get();
        $side   = sidebar::orderBy('id_cabang')->get();
        return view('/lihatStaff', compact('readUser'), compact('side'));
    }

    public function destroy($id)
    {
        $user   = User::find($id);
        $user->delete();
        session()->flash('deleteNotif', 'Delete Succesful!');
        return redirect()->route('lihatStaff.readAll');
    }

    public function profilAdmin()
    {
      $side   = sidebar::orderBy('id_cabang')->get();
      return view('profil', compact('side'));
    }

    public function lihatFile()
    {
      $file = File::orderBy('id_file')->get();
      $cabang = Cabang::orderBy('id_cabang')->get();
      $alat = Alat::orderBy('id_alat')->get();
      return view('lihatFile', compact('file'), compact('cabang'), compact('alat'));
    }

    public function DaftarCabang()
    {
      $cabang = Cabang::orderBy('id_cabang')->get();
      return view('DaftarCabang', compact('cabang'));
    }

    public function HapusCabang($id)
    {
        $cabang   = Cabang::where('id_cabang', $id);
        $cabang->delete();
        session()->flash('deleteNotif', 'Cabang Berhasil Dihapus!');
        return redirect()->route('DaftarCabang');
    }

    public function DaftarAlat()
    {
      $alat = Alat::orderBy('id_alat')->get();
      $cabang = Cabang::orderBy('id_cabang')->get();
      return view('DaftarAlat', compact('alat'), compact('cabang'));
    }

    public function HapusAlat($id)
    {
        $alat   = Alat::where('id_alat', $id);
        $alat->delete();
        session()->flash('deleteNotif', 'Alat Berhasil Dihapus!');
        return redirect()->route('DaftarAlat');
    }

    public function tambahAlat()
    {
      return view('tambahAlat');
    }

    public function createAlat(Request $request)
    {
      $this->validate($request, array(
              'nama_alat'           => 'required|max:100',
              'identitas_alat'      => 'required',
          ));

      $user   = Alat::create([
              'nama_alat'          => $request->input('nama_alat'),
              'identitas_alat'     => $request->input('identitas_alat'),
          ]);

      session()->flash('success', 'Cabang Berhasil Ditambahkan');
      return redirect()->back();
    }

    public function Laporan()
    {
      return view('laporan');
    }
}

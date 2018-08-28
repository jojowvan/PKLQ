<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
namespace App\Http\Controllers;

use Illuminate\Support\Facades\Hash;
use App\User;
use App\Cabang;
use Auth;
use Storage;
use App\sidebar;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $side   = sidebar::orderBy('nama_cabang')->get();
        if(auth()->user()->isAdmin==1) {
          $id     = Auth::user()->id;
          $admins = User::find($id);
          $IP     = Cabang::orderBy('id_cabang')->get();
          return view('homeAdmin', compact('side'), compact('IP'));
        }
        else if(auth()->user()->isAdmin==0) {
          $id             = Auth::user()->id;
          $admins         = User::find($id);
          return view('Peneliti/home', compact('side'));
        }
        else if(auth()->user()->isAdmin==2) {
          $id             = Auth::user()->id;
          $admins         = User::find($id);
          return view('kapus/home', compact('side'));
        }
        // else{
        //   return view('home', compact('side'));
        // }
    }

    public function admin()
    {
        return view('admin');
    }

}

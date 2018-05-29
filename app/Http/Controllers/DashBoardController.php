<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Models\Menu as Menu;


use Cache;
use DB;
use auth;

class DashBoardController extends Controller
{

    public function Index(){
      return view('dashboard.index');
    }

    public function MenuLoad(){
        Cache::flush();
        $Menu = Cache::tags('MenuOpciones')->rememberForever('Menu', function(){
            return DB::select(' call menus_listado() ');
        });
        return redirect()->route('dashboard', compact('Menu'));
    }


}

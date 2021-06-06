<?php

namespace App\Http\Controllers\Manager;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class DashBoardController extends Controller
{
   public function index(){
       return view('manager.dashboard.index');
   }
}

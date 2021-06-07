<?php

namespace App\Http\Controllers\Manager;

use App\Http\Controllers\Controller;
use App\Http\Requests\Product\CreateRequest;
use Illuminate\Http\Request;

class UserController extends Controller
{
    public function index(){
        return view('manager.user.index');
    }
    public function create(){
        return view('manager.user.create');
    }
    public function save(CreateRequest $request){
        return view('manager.user.create');
    }
    public function edit($id){
        return view('manager.user.create');
    }
    public function update(CreateRequest $request){
        return view('manager.user.create');
    }
    public function delete($id){

    }
}

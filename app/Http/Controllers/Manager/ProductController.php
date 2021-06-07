<?php

namespace App\Http\Controllers\Manager;

use App\Http\Controllers\Controller;
use App\Http\Requests\Product\CreateRequest;
use Illuminate\Http\Request;

class ProductController extends Controller
{
    public function index(){
        return view('manager.product.index');
    }
    public function create(){
        return view('manager.product.create');
    }
    public function save(CreateRequest $request){
        return view('manager.product.create');
    }
    public function edit($id){
        return view('manager.product.create');
    }
    public function update(CreateRequest $request){
        return view('manager.product.create');
    }
    public function delete($id){

    }
}

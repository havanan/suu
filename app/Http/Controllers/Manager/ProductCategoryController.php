<?php

namespace App\Http\Controllers\Manager;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class ProductCategoryController extends Controller
{
    public function index(){
        return view('manager.product_category.index');
    }
}

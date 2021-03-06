<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class UserController extends Controller
{
    public function getCurrentUser(){
        return json_encode(auth('sanctum')->user());
    }
}

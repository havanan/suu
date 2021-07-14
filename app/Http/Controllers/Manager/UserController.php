<?php

namespace App\Http\Controllers\Manager;

use App\Http\Controllers\Controller;
use App\Http\Requests\Product\CreateRequest;
use App\Services\UserService;
use Illuminate\Http\Request;

class UserController extends Controller
{
    private $userService;
    public function __construct(UserService $userService){
        $this->userService = $userService;
    }
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
    public function getOwner(){
        $data = $this->userService->getOwner();
        return resSuccessData($data);
    }
}

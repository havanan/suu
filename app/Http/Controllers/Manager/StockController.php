<?php

namespace App\Http\Controllers\Manager;

use App\Http\Controllers\Controller;
use App\Http\Requests\Stock\CreateRequest;
use App\Http\Requests\Stock\UpdateRequest;
use App\Services\StockService;
use App\Services\UserService;
use Illuminate\Http\Request;

class StockController extends Controller
{
    private $stockService;
    private $userService;
    public function __construct(StockService $stockService,UserService $userService){
        $this->stockService = $stockService;
        $this->userService = $userService;
    }
    public function index(){
        return view('manager.stock.index');
    }
    public function getList(Request $request){
        $params = $request->all();
        return $this->stockService->getList($params);
    }
    public function getConfig(){
        $data['owners'] = $this->userService->getOwner();
        $data['parents'] = $this->stockService->getParents();
        return resSuccessData($data);
    }
    public function save(CreateRequest $request){
        $params = $request->all();
        $this->stockService->insert($params);
        return $this->stockService->getList([]);
    }
    public function delete($id){
         $this->stockService->delete([$id]);
        return $this->stockService->getList([]);
    }
    public function edit($id){
        $info = $this->stockService->findById($id);
        return resSuccessData($info);
    }
    public function update(UpdateRequest $request,$id){
        $info = $this->stockService->findById($id);
        if (!$info){
            return resFail('Không có thông tin');
        }
        $params = $request->all();
        unset($params['id']);
        unset($params['deleted_at']);
        unset($params['created_at']);
        unset($params['updated_at']);
        $this->stockService->update($id,$params);
       return $this->stockService->getList([]);
    }
}

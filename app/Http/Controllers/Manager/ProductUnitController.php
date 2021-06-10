<?php

namespace App\Http\Controllers\Manager;

use App\Helpers\ResponsesApi;
use App\Http\Controllers\Controller;
use App\Http\Requests\ProductUnit\CreateRequest;
use App\Services\Product\UnitService;
use Illuminate\Http\Request;

class ProductUnitController extends Controller
{
   private $unitService;
   public function __construct(UnitService $unitService)
   {
       $this->unitService= $unitService;
   }

    public function index(){
       return view('manager.product_unit.index');
   }
    public function getList(Request $request){
        $params = $request->all();
        $data = $this->unitService->getList($params);
        return $data;
    }
    public function save(CreateRequest $request){
        $globals = new ResponsesApi();
        $params = $request->only('name');
        $this->unitService->insert($params);
        $data = $this->unitService->getList([]);
        return $globals->resSuccessData($data);
    }
}

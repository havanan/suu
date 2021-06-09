<?php

namespace App\Http\Controllers\Manager;

use App\Http\Controllers\Controller;
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
}

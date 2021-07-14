<?php

use App\Helpers\Globals;
use Illuminate\Support\Arr;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Carbon;
use Intervention\Image\ImageManagerStatic as Image;

function paging($items, $page = Globals::CURRENT_PAGE, $perPage = Globals::PER_PAGE, $additional_field = []) {
    if($page < 0) { $perPage = Globals::PER_PAGE_MAX; $page = Globals::CURRENT_PAGE;}
    $page = intval($page);
    $total = $items->count();
    $allPage = ceil($total / $perPage);
    if ($page > $allPage) { $page = $allPage; }
    $items = $items->skip(($page-1) * $perPage)->take($perPage)->get();
    $result = [
            'items' => $items,
            'currentPage' => $page,
            'perPage' => $perPage,
            'pages' => $allPage,
            'total' => $total
    ];

    return Arr::collapse([$result, $additional_field]);
}
function getIp() {
    foreach (array('HTTP_CLIENT_IP', 'HTTP_X_FORWARDED_FOR', 'HTTP_X_FORWARDED', 'HTTP_X_CLUSTER_CLIENT_IP', 'HTTP_FORWARDED_FOR', 'HTTP_FORWARDED', 'REMOTE_ADDR') as $key){
        if (array_key_exists($key, $_SERVER) === true){
            foreach (explode(',', $_SERVER[$key]) as $ip){
                $ip = trim($ip); // just to be safe
                if (filter_var($ip, FILTER_VALIDATE_IP, FILTER_FLAG_NO_PRIV_RANGE | FILTER_FLAG_NO_RES_RANGE) !== false){
                    return $ip;
                }
            }
        }
    }
    return request()->ip(); // it will return server ip when no client ip found
}
function getUserCurrent($guard = '') {
    if($guard) return Auth::guard($guard)->check() ? Auth::guard($guard)->user() : null;
    return Auth::check() ? Auth::user() : null;
}
function uploadImage($file,$uploadFolder,$oldImageName = null){
    $date  = Carbon::now()->format('Ymdhis');
    $saveDefaultFolder = public_path('/cdn/'.$uploadFolder.'/default/');
    $saveSmallFolder = public_path('/cdn/'.$uploadFolder.'/small/');
    //tạo folder neu chua ton tai
    if (!file_exists($saveDefaultFolder)) mkdir($saveDefaultFolder, 666, true);
    if (!file_exists($saveSmallFolder)) mkdir($saveSmallFolder, 666, true);
    //nếu có ảnh cũ trong thư mục thì xóa đi
    if ($oldImageName != null){
        removeImage($oldImageName,$uploadFolder);
    }
    //RENDER ẢNH
    //kiểm tra tính tồn tại trong thư mục render
    $imgName = $date.'.png';
    //resize image default and upload
        Image::make($file->getRealPath())->resize(1028,849)->save($saveDefaultFolder.$imgName);
    //resize image small and upload
        Image::make($file->getRealPath())->resize(265,201)->save($saveSmallFolder.$imgName);
        return $imgName;
}
function removeImage($imageName,$uploadFolder){
    $saveDefaultFolder = public_path('/cdn/'.$uploadFolder.'/default/'.$imageName);
    $saveSmallFolder = public_path('/cdn/'.$uploadFolder.'/small/'.$imageName);
    if (file_exists($saveDefaultFolder)) unlink($saveDefaultFolder);
    if (file_exists($saveSmallFolder)) unlink($saveSmallFolder);
}
function writeResponseData($code, $msg, $data) {
    return response()->json([
        'code' => $code,
        'message' => $msg,
        'data' => $data
    ]);
}
function writeResponseError($code, $msg, $error) {
    return response()->json([
        'code' => $code,
        'message' => $msg,
        'errors' => $error
    ]);
}
function writeResponse($code, $msg) {
    return response()->json([
        'code' => $code,
        'message' => $msg
    ]);
}
function resSuccess($msg = null) {
    $msg = $msg ? $msg : 'thành công';
    return writeResponse(200, $msg);
}
function resSuccessData($data, $msg = null) {
    $msg = $msg ? $msg : 'thành công';
    return writeResponseData(200, $msg, $data);
}
function resFail($msg = null, $code = 500) {
    $msg = $msg ? $msg : 'thất bại';
    return writeResponse($code , $msg);
}
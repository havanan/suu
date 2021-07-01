<?php

use App\Helpers\Globals;
use Illuminate\Support\Arr;
use Illuminate\Support\Facades\Auth;

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
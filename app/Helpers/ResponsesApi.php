<?php


namespace App\Helpers;


class ResponsesApi
{
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
        $msg = $msg ?? __('systems.msgSuccess');
        return $this->writeResponse(200, $msg);
    }
    function resSuccessData($data, $msg = null) {
        $msg = $msg ?? __('systems.msgSuccess');
        return $this->writeResponseData(200, $msg, $data);
    }
    function resFail($msg = null, $code = 500) {
        $msg = $msg ?? __('systems.msgFail');
        return $this->writeResponse($code , $msg);
    }

}
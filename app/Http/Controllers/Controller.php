<?php

namespace App\Http\Controllers;

use Laravel\Lumen\Routing\Controller as BaseController;

class Controller extends BaseController
{
    // Hazır reponse metodları

    public function success($data, $code){
        return response()->json(['data' => $data], $code);
    }

    public function error($message, $code){
        return response()->json(['message' => $message], $code);
    }
}

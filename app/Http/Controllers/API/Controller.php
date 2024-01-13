<?php

namespace App\Http\Controllers\API;

use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Validation\ValidatesRequests;
use App\Http\Controllers\Controller as BaseController;

class Controller extends BaseController
{
    use AuthorizesRequests, ValidatesRequests;

    /**
     * Send error response
     * 
     * @param \Exception $e
     * @param string|null $redirect
     */

     public function error(\Exception $e){
        return response()->json([
            'success' => false,
            'message' => __('Something went wrong, please try again later.')
        ], 500);
    }
}

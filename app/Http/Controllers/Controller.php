<?php

namespace App\Http\Controllers;

use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Routing\Controller as BaseController;

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
        return redirect()->back()->withError(__('Somthing went wrong, please try again later'));
    }
}

<?php

namespace App\Http\Middleware;
use AuthenticationManagement;
use App\Libraries\Helper\ResponseMessage as ResponseMessage;

use Closure;

class Permissions
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next)
    {   
        $header = $request->header();
        

        if (AuthenticationManagement::checkPermission())
        {
            return $next($request);
        }

        return ResponseMessage::invalidPermission();
        
    }
}

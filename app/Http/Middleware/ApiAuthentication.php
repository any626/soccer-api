<?php

namespace App\Http\Middleware;

use App\ApiKey;
use Closure;

/**
 * Custom middleware to handle the api key validation.
 */
class ApiAuthentication
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
        $key = $request->input('key');
        if(empty($key) || ApiKey::where('api_key', $key)->count() !== 1){
            return response()->json(array('error' => 'Requires a valid key.'), 401); // unauthroized
        }
        return $next($request);
    }
}

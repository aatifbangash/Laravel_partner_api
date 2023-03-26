<?php

namespace App\Http\Middleware;

use App\Exceptions\CustomException;
use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Config;
use Symfony\Component\HttpFoundation\Response;


/**
 * Following middleware is a Global middleware, register in the $middleware (global) app/kernal.php file
 */
class SwichDatabaseMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        // get value from http headers and
        $apiKey = $request->headers->get("API_KEY");

        // get configs (config/*.php) dynamically
        $config = Config::get("database.connections.$apiKey");

        // throw CustomException (created by make:exception in app/exceptions/ dir)
        if (!isset($config))
            throw new CustomException(400, "Tenent not found.", "null");


            // throw CustomException(
            //     HttpStatus.BAD_REQUEST,
            //     "already confirmed",
            //     "payoutId"
            // )

        // get configs (config/*.php) dynamically
        Config::set("database.default", $apiKey);

        return $next($request);
    }
}
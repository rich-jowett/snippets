<?php

/**
 * Json.php
 *
 * @author Rich Jowett <rich@jowett.me>
 */
declare(strict_types=1);

namespace App\Http\Middleware;

use Closure;
use Illuminate\Auth\Middleware\Authenticate as Middleware;
use Illuminate\Http\Request;

/**
 * Class Json
 *
 * @author Rich Jowett <rich@jowett.me>
 * @package App\Http\Middleware
 */
class Json extends Middleware
{
    /**
     * Handle an incoming request.
     *
     * @param  Request  $request
     * @param  Closure  $next
     * @param  string[]  ...$guards
     * @return mixed
     */
    public function handle($request, Closure $next, ...$guards)
    {
        $request->headers->set('Accept', 'application/json');

        return $next($request);
    }
}

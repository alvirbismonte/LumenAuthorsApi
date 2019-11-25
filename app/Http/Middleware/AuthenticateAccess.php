<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Response;

class AuthenticateAccess
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
        $validSecrets = explode(',', env('ACCEPTED_SECRETS'));
        $authorization = $request->header('Authorization');

        if (in_array($authorization, $validSecrets) && !empty($authorization)) {
            return $next($request);
        }

        abort(Response::HTTP_UNAUTHORIZED);
    }
}

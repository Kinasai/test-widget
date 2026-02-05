<?php

namespace App\Http\Middleware;


use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class VerifyCsrfToken
{
    public function handle(Request $request, Closure $next): Response
    {
        try {
            $requestToken = $request->input('_token') ??
                $request->header('X-CSRF-TOKEN') ??
                $request->header('X-XSRF-TOKEN');

            $valid = hash_equals(
                $request->session()->token(),
                $requestToken
            );
            if ($valid) {
                return $next($request);
            }else{
                abort(419, 'CSRF token mismatch');
            }

        } catch (\Exception $e) {
            abort(419, 'CSRF token mismatch');
        }

    }


}

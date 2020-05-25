<?php

namespace App\Http\Middleware;

use App\RestApi;
use Closure;
use Illuminate\Http\Exceptions\HttpResponseException;
use Illuminate\Http\JsonResponse;

class ClientAPI
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
        if (RestApi::where([
            ['client' => $request->ip()],
            ['secret' => $request->header('SecretAPI')]
        ])->count()) {
            return $next($request);
        }

        throw new HttpResponseException(response()->json([
            'message' => 'Mohon hubungi pihak bersangkutan untuk mengakses url ini.'
        ], JsonResponse::HTTP_SERVICE_UNAVAILABLE));
    }
}

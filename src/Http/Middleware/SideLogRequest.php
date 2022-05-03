<?php

namespace Vladi\Landing\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Vladi\Landing\Facades\JsonRpcClient;

class SideLogRequest
{
    public function handle(Request $request, Closure $next)
    {
        $response = $next($request);

		JsonRpcClient::notify('log', [
			'url' => $request->fullUrl(),
            'date' => date('Y-m-d H:i:s'),
		]);

		return $response;
    }
}

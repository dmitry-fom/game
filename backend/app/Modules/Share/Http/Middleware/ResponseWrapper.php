<?php

declare(strict_types=1);

namespace App\Modules\Share\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Http\JsonResponse;
use Symfony\Component\HttpFoundation\Response;

class ResponseWrapper
{
    public function handle(Request $request, Closure $next): Response
    {
        /** @var Response $response */
        $response = $next($request);

        if ($response instanceof JsonResponse && !$response->isEmpty()) {
            $original = $response->getData(true);

            if (!array_key_exists('data', $original)) {
                $response->setData([
                    'data' => $original,
                ]);
            }
        }

        return $response;
    }
}

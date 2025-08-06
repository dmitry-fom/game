<?php

namespace App\Modules\Share\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Modules\Auth\Models\AccessToken;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpKernel\Exception\AccessDeniedHttpException;

class CheckMagicLink
{
    public function handle(Request $request, Closure $next): Response
    {
        $token = $request->bearerToken() ?? $request->query('token');

        if (!$token) {
            $this->exception('Wrong link');
        }

        $accessToken = AccessToken::query()
            ->valid()
            ->where('token', $token)
            ->first();

        if (!$accessToken || !$accessToken->user) {
            $this->exception('Link is not active.');
        }

        Auth::login($accessToken->user);

        return $next($request);
    }

    private function exception($message)
    {
        throw new AccessDeniedHttpException($message);
    }
}

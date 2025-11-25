<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Symfony\Component\HttpFoundation\Response;

class DemoModeMiddleware
{
    private const BLOCKED_METHODS = ['POST', 'PUT', 'PATCH', 'DELETE'];

    private const ALLOWED_ROUTE_PATTERNS = [
        'login',
        'logout',
        'password.*',
        'verification.*',
    ];

    private const ALLOWED_CONTROLLERS = [
        'App\\Http\\Controllers\\Auth\\AuthenticatedSessionController',
        'App\\Http\\Controllers\\Auth\\ConfirmablePasswordController',
        'App\\Http\\Controllers\\Auth\\EmailVerificationController',
        'App\\Http\\Controllers\\Auth\\NewPasswordController',
        'App\\Http\\Controllers\\Auth\\PasswordResetLinkController',
        'App\\Http\\Controllers\\Auth\\RegisteredUserController',
        'App\\Http\\Controllers\\Auth\\VerifyEmailController',
    ];

    private const DEFAULT_NOTICE = 'Esta acción está deshabilitada en el modo demostración. Puedes explorar todas las funcionalidades sin modificar datos.';

    /**
     * Handle an incoming request.
     */
    public function handle(Request $request, Closure $next): Response
    {
        if (! config('app.demo_site', false)) {
            return $next($request);
        }

        if (! $this->shouldBlock($request)) {
            return $next($request);
        }

        $message = config('app.demo_site_notice', self::DEFAULT_NOTICE);

        if ($request->expectsJson()) {
            return response()->json([
                'message' => $message,
                'demo_mode' => true,
            ], Response::HTTP_FORBIDDEN);
        }

        return back()->withInput($this->inputToFlash($request))->with([
            'demo_mode_notice' => $message,
            'demo_mode_blocked' => true,
        ]);
    }

    private function shouldBlock(Request $request): bool
    {
        return $this->isWriteMethod($request) && ! $this->isAllowedRoute($request);
    }

    private function isWriteMethod(Request $request): bool
    {
        return in_array(strtoupper($request->getMethod()), self::BLOCKED_METHODS, true);
    }

    private function isAllowedRoute(Request $request): bool
    {
        $route = $request->route();

        if (! $route) {
            return false;
        }

        $routeName = $route->getName();

        if ($routeName && $this->matchesAllowedPattern($routeName)) {
            return true;
        }

        if (method_exists($route, 'getControllerClass')) {
            $controller = $route->getControllerClass();

            if ($controller && in_array($controller, self::ALLOWED_CONTROLLERS, true)) {
                return true;
            }
        }

        return false;
    }

    private function matchesAllowedPattern(string $routeName): bool
    {
        foreach (self::ALLOWED_ROUTE_PATTERNS as $pattern) {
            if (Str::is($pattern, $routeName)) {
                return true;
            }
        }

        return false;
    }

    private function inputToFlash(Request $request): array
    {
        return $request->except([
            'password',
            'password_confirmation',
            'current_password',
        ]);
    }
}

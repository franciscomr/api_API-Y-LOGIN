<?php

namespace App\Actions\Auth;

use App\Models\User;
use Illuminate\Contracts\Auth\StatefulGuard;
use Illuminate\Validation\ValidationException;
use Laravel\Fortify\Fortify;
use Laravel\Fortify\LoginRateLimiter;
use Illuminate\Http\Request;

class CustomAttemptToAuthenticate
{
    protected $guard;
    protected $limiter;
    protected $numberOfAttemptsRemaining;

    public function __construct(StatefulGuard $guard, LoginRateLimiter $limiter, LoginAttemptsRemaining $numberOfAttemptsRemaining)
    {
        $this->guard = $guard;
        $this->limiter = $limiter;
        $this->numberOfAttemptsRemaining = $numberOfAttemptsRemaining;
    }

    public function handle($request, $next)
    {
        $user = User::join('employees', 'employees.id', '=', 'users.employee_id')
            ->where('users.username', $request->only(Fortify::username()))
            ->where('users.is_active', true)
            ->where('employees.is_active', true)
            ->first();

        if (!$user) {
            $this->throwFailedAuthenticationException($request);
        }

        if ($this->guard->attempt(
            $request->only(Fortify::username(), 'password'),
            $request->boolean('remember')
        )) {
            return $next($request);
        }

        $this->throwFailedAuthenticationException($request);
    }

    protected function throwFailedAuthenticationException($request)
    {
        $this->limiter->increment($request);

        throw ValidationException::withMessages([
            Fortify::username() => [__('api.auth_failed', ['number' => $this->numberOfAttemptsRemaining->numberOfAttemptsRemaining($request)])],
        ]);
    }
}

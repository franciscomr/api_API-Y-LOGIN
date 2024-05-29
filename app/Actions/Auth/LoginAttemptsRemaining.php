<?php

namespace App\Actions\Auth;

use Illuminate\Http\Request;
use Laravel\Fortify\LoginRateLimiter;

class LoginAttemptsRemaining extends LoginRateLimiter
{
    public function numberOfAttemptsRemaining(Request $request)
    {
        return $this->limiter->remaining($this->throttleKey($request), env('MAX_ATTEMPTS', 5));
    }
}

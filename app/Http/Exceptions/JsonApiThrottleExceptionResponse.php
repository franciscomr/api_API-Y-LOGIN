<?php

namespace App\Http\Exceptions;

use Illuminate\Http\Exceptions\ThrottleRequestsException;
use Illuminate\Http\JsonResponse;
use Symfony\Component\HttpFoundation\Response;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\RateLimiter;
use Laravel\Fortify\LoginRateLimiter;
use Illuminate\Support\Str;
use Laravel\Fortify\Fortify;



class JsonApiThrottleExceptionResponse extends JsonResponse
{

    public function __construct(ThrottleRequestsException $exception, Request $request, int $statusCode = Response::HTTP_TOO_MANY_REQUESTS)
    {
        $data = $this->formatJsonApiResponse($exception, $request);
        parent::__construct($data, $statusCode);
    }

    protected function throttleKey(Request $request)
    {
        return Str::transliterate(Str::lower($request->input(Fortify::username())) . '|' . $request->ip());
    }

    protected function formatJsonApiResponse(ThrottleRequestsException $exception, Request $request)
    {
        return [
            'title' => $exception->getMessage(),
            'detail' => __('api.throttle_message', ['seconds' => RateLimiter::availableIn($this->throttleKey($request))]),
            'source' => [
                'pointer' => '/username'
            ]
        ];
    }
}

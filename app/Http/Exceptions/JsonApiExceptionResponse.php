<?php

namespace App\Http\Exceptions;

use Exception;
use Throwable;
use Illuminate\Http\JsonResponse;

class JsonApiExceptionResponse extends Exception
{
    protected $exceptionSchema;
    public function __construct(JsonApiExceptionSchema $exceptionSchema, ?Throwable $previous = null)
    {
        $this->exceptionSchema = $exceptionSchema;
        parent::__construct($this->exceptionSchema->getMessageError(), $this->exceptionSchema->getStatusCode(), $previous);
    }

    public function render(): JsonResponse
    {
        $errors = [
            'status' => $this->exceptionSchema->getStatusCode(),
            'title' => $this->exceptionSchema->getMessageError(),
            'detail' => $this->exceptionSchema->getDetailError()
        ];

        return response()->json([
            'errors' => [$errors]
        ], $this->exceptionSchema->getStatusCode());
    }
}

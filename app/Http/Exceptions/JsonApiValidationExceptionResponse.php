<?php

namespace App\Http\Exceptions;

use Illuminate\Http\JsonResponse;
use Illuminate\Validation\ValidationException;
use Symfony\Component\HttpFoundation\Response;
use Illuminate\Support\Facades\Route;
use Illuminate\Http\Request;


class JsonApiValidationExceptionResponse extends JsonResponse
{
    public function __construct(ValidationException $exception, int $statusCode = Response::HTTP_UNPROCESSABLE_ENTITY)
    {
        $data = $this->formatJsonApiResponse($exception);
        parent::__construct($data, $statusCode);
    }

    protected function formatJsonApiResponse(ValidationException $exception)
    {
        $title = $exception->getMessage();
        return   [
            'errors' => collect($exception->errors())->map(function ($messages, $field) use ($title) {
                if ($field === 'username' || $field === 'password') {
                    return [
                        'title' => $title,
                        'detail' => $messages[0],
                        'source' => [
                            'pointer' => '/' . $field
                        ]
                    ];
                }
                return [
                    'title' => $title,
                    'detail' => $messages[0],
                    'source' => [
                        'pointer' => str_starts_with($field, 'data') ? '/' . str_replace('.', '/', $field) : '/data/attributes/' . $field
                    ]
                ];
            })->values()
        ];
    }
}

<?php

namespace App\Http\Exceptions;

class JsonApiExceptionSchema
{
    protected $messageError;
    protected $detailError;
    protected $statusCode;

    public function __construct(string $messageError = 'Error', string $detailError = 'Internal Server Error', int $statusCode = 500)
    {
        $this->messageError = $messageError;
        $this->detailError = $detailError;
        $this->statusCode = $statusCode;
    }

    public function getMessageError(): string
    {
        return $this->messageError;
    }

    public function setMessageError(?string $messageError): void
    {
        $this->messageError = $messageError;
    }

    public function getDetailError(): string
    {
        return $this->detailError;
    }

    public function setDetailError(?string $detailError): void
    {
        $this->detailError = $detailError;
    }

    public function getStatusCode(): int
    {
        return $this->statusCode;
    }

    public function setStatusCode(?int $statusCode): void
    {
        $this->statusCode = $statusCode;
    }
}

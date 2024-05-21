<?php

namespace App\Traits\Api;

use Exception;

trait GetSingleRecord
{
    public function scopeGetSingleRecord(int | string | null $id)
    {
        $this->checkIfIsNull($id);
    }

    protected function checkIfIsNull(string | int |null  $field)
    {
        if (is_null($field)) {
            throw new Exception('cannot be null');
        }
    }
}

<?php

namespace App\Traits\Functions;

use Illuminate\Support\Arr;

trait GetValueOrNull
{
    protected function getValueOrNull(array $array, string $key)
    {
        return Arr::exists($array, $key) ? $array[$key] : null;
    }
}

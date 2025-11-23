<?php

namespace App\Models\Traits;

use DateTimeInterface;

trait Common
{
    protected function serializeDate(DateTimeInterface $date)
    {
        return $date->timezone('Asia/Manila')->format('Y-m-d H:i:s');
    }
}

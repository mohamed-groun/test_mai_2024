<?php

namespace App\Services;

interface DataProviderInterface
{
    public function fetchData(): array;
}

<?php

namespace App\Filter;

use Symfony\Component\HttpFoundation\Request;

interface FilterProviderInterface
{
    public static function get(Request $request);
}
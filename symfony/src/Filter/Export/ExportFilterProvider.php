<?php

namespace App\Filter\Export;

use App\Filter\FilterProviderInterface;
use Symfony\Component\HttpFoundation\Request;

class ExportFilterProvider implements FilterProviderInterface
{
    public static function get(Request $request): ExportFilter
    {
        return new ExportFilter($request->query->get('place', ''), $request->query->get('toDate', ''), $request->query->get('fromDate', ''));
    }
}
<?php

namespace App\Tests\Export;

use App\Filter\Export\ExportFilter;
use App\Filter\Export\ExportFilterProvider;
use PHPUnit\Framework\TestCase;
use Symfony\Component\HttpFoundation\Request;

class ExportFilterProviderTest extends TestCase
{
    /**
     * @dataProvider successfulExportProviderCases
     */
    public function testValidExportFilterProvider(
        Request $request,
        ExportFilter $validExportFilter
    )
    {
        //        given
        //        when
        $exportFilter = ExportFilterProvider::get($request);
        //        then
        $this->assertEquals($validExportFilter, $exportFilter );
    }

    public static function successfulExportProviderCases(): array
    {
        return [
            [new Request(['fromDate' => '2022-11-11']), new ExportFilter('', '', '2022-11-11')],
            [new Request(['toDate' => '2022-11-11']), new ExportFilter('', '2022-11-11', '')],
            [new Request(['place' => 'place']), new ExportFilter('place', '', '')],
            [new Request([]), new ExportFilter('', '', '')],
            [new Request(['fromDate' => '2022-11-11', 'toDate' => '2021-11-11', 'place' => 'place']), new ExportFilter('place', '2021-11-11', '2022-11-11')],

        ];
    }

    /**
     * @dataProvider failureExportProviderCases
     */
    public function testNonValidExportFilterProvider(
        Request $request,
        ExportFilter $nonValidExportFilter
    )
    {
        //        given
        //        when
        $exportFilter = ExportFilterProvider::get($request);
        //        then
        $this->assertNotEquals($nonValidExportFilter, $exportFilter);
    }

    public static function failureExportProviderCases(): array
    {
        return [
            [new Request(['fromDate' => '2022-11-11']), new ExportFilter('', '2022-11-11', '')],
            [new Request(['toDate' => '2022-11-11']), new ExportFilter('', '', '2022-11-11')],
            [new Request(['place' => 'place']), new ExportFilter('', '2022-11-11', '2022-11-11')],
            [new Request([]), new ExportFilter('place', '2021-11-11', '2022-11-11')],
            [new Request(['fromDate' => '2022-11-11', 'toDate' => '2021-11-11', 'place' => 'place']), new ExportFilter('', '', '')],
        ];
    }
}

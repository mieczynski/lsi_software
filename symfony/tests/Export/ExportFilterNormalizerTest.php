<?php

namespace App\Tests\Export;

use App\Filter\Export\ExportFilter;
use App\Normalizer\Export\ExportFilterNormalizer;
use PHPUnit\Framework\TestCase;

class ExportFilterNormalizerTest extends TestCase
{

    public function testIfExportFilterNormalizerExists(
    )
    {
        //        given
        $exportFilterNormalizer = new ExportFilterNormalizer();
        //        when
        //        then
        $this->assertInstanceOf(ExportFilterNormalizer::class, $exportFilterNormalizer );
    }


    /**
     * @dataProvider successfulExportFilterNormalizerCases
     */
    public function testValidExportFilterNormalizer(
        ExportFilter $exportFilter,
        array $validExportFilterNormalizeResult
    )
    {
        //        given
        $exportFilterNormalizer = new ExportFilterNormalizer();
        //        when
        $normalizerResult = $exportFilterNormalizer->normalize($exportFilter);
        //        then
        $this->assertEquals($normalizerResult, $validExportFilterNormalizeResult );
    }

    public static function successfulExportFilterNormalizerCases(): array
    {
        return [
            [new ExportFilter('', '', '2022-11-11'), ['place' => '', 'toDate' => '', 'fromDate' => '2022-11-11']],
            [new ExportFilter('', '2022-11-11', ''), ['place' => '', 'toDate' => '2022-11-11', 'fromDate' => '']],
            [new ExportFilter('place', '', ''), ['place' => 'place', 'toDate' => '', 'fromDate' => '']],
            [new ExportFilter('place', 'test', 'test'), ['place' => 'place', 'toDate' => '', 'fromDate' => '']],
            [new ExportFilter('place', '2023-11-11', '2022-11-11'), ['place' => 'place', 'toDate' => '2023-11-11', 'fromDate' => '2022-11-11']],

        ];
    }

    /**
     * @dataProvider failureExportFilterNormalizerCases
     */
    public function testNonValidExportFilterNormalizer(
        ExportFilter $exportFilter,
        array $nonValidExportFilterNormalizeResult
    )
    {
        //        given
        $exportFilterNormalizer = new ExportFilterNormalizer();
        //        when
        $normalizerResult = $exportFilterNormalizer->normalize($exportFilter);
        //        then
        $this->assertNotEquals($normalizerResult, $nonValidExportFilterNormalizeResult );
    }

    public static function failureExportFilterNormalizerCases(): array
    {
        return [
            [new ExportFilter('', '', '2022-11-11'), ['place' => '', 'toDate' => '2022-11-11', 'fromDate' => '2022-11-11']],
            [new ExportFilter('', '2022-11-11', ''), ['place' => '', 'toDate' => '2022-11-11', 'fromDate' => '2022-11-11']],
            [new ExportFilter('place', '', ''), ['place' => 'place', 'toDate' => '2022-11-11', 'fromDate' => '']],
            [new ExportFilter('place', 'test', 'test'), ['place' => 'place', 'toDate' => 'test', 'fromDate' => 'test']],
            [new ExportFilter('place', '2023-11-11', '2022-11-11'), ['place' => 'place', 'toDate' => '', 'fromDate' => '2022-11-11']],
        ];
    }
}

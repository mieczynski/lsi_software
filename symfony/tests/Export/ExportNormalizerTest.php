<?php

namespace App\Tests\Export;

use App\Normalizer\Export\ExportNormalizer;
use PHPUnit\Framework\TestCase;

class ExportNormalizerTest extends TestCase
{
    use ExportProvider;
    public function testIfExportNormalizerExist(
    )
    {
        //        given
        $exportNormalizer = new ExportNormalizer();
        //        when
        //        then
        $this->assertInstanceOf(ExportNormalizer::class, $exportNormalizer );
    }


    /**
     * @dataProvider successfulExportNormalizerCases
     */
    public function testValidExportNormalizer(
        array $exportData,
        array $validNormalizeExportResult
    )
    {
        //        given
        $exportNormalizer = new ExportNormalizer();
        //        when
        $normalizerResult = $exportNormalizer->normalize($this->exportProvider($exportData));
        //        then
        $this->assertEquals($validNormalizeExportResult, $normalizerResult );
    }

    public static function successfulExportNormalizerCases(): array
    {
        return [
            [['id' => 1, 'place' => 'place', 'date' => '2022-11-11 00:00:00', 'user' => 'user', 'name' => 'name'], ['place' => 'place', 'date' => '2022-11-11', 'user' => 'user', 'name' => 'name', 'time' => '00:00'] ],
            [['id' => 1, 'place' => 'place', 'date' => '2022-11-11 12:00:00', 'user' => 'user', 'name' => 'name'], ['place' => 'place', 'date' => '2022-11-11', 'user' => 'user', 'name' => 'name', 'time' => '12:00'] ],
            [['id' => 1, 'place' => 'place', 'date' => '2022-11-11 18:00:00', 'user' => 'user', 'name' => 'name'], ['place' => 'place', 'date' => '2022-11-11', 'user' => 'user', 'name' => 'name', 'time' => '18:00'] ],
        ];
    }

    /**
     * @dataProvider failureExportNormalizerCases
     */
    public function testNonValidExportNormalizer(
        array $exportData,
        array $nonValidNormalizeExportResult
    )
    {
        //        given
        $exportNormalizer = new ExportNormalizer();
        //        when
        $normalizerResult = $exportNormalizer->normalize($this->exportProvider($exportData));
        //        then
        $this->assertNotEquals($nonValidNormalizeExportResult, $normalizerResult );
    }

    public static function failureExportNormalizerCases(): array
    {
        return [
            [['id' => 1, 'place' => 'place', 'date' => '2022-11-11 11:00:00', 'user' => 'user', 'name' => 'name'], ['place' => 'place', 'date' => '2022-11-11', 'user' => 'user', 'name' => 'name', 'time' => '00:00'] ],
            [['id' => 1, 'place' => 'place', 'date' => '2022-11-11 11:00:00', 'user' => 'test', 'name' => 'name'], ['place' => 'place', 'date' => '2022-11-11', 'user' => 'user', 'name' => 'name', 'time' => '00:00'] ],
            [['id' => 1, 'place' => 'place', 'date' => '2022-11-11 11:00:00', 'user' => 'user', 'name' => 'name'], ['place' => 'place', 'date' => '2022-11-11', 'user' => 'user', 'name' => 'name', 'time' => '00:00'] ],
            [['id' => 1, 'place' => '', 'date' => '2022-11-11 11:00:00', 'user' => 'user', 'name' => 'name'], ['place' => 'place', 'date' => '2022-11-11', 'user' => 'user', 'name' => 'name', 'time' => '00:00'] ],

        ];
    }

}

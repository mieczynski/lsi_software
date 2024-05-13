<?php

namespace App\Tests\Export;

use App\Normalizer\Export\ExportNormalizer;
use App\Normalizer\NormalizerInterface;
use App\Template\CollectionProvider;
use PHPUnit\Framework\TestCase;

class CollectionProviderTest extends TestCase
{

    use ExportProvider;

    public function testIfCollectionProviderExists(
    )
    {
        //        given
        $collectionProvider = new CollectionProvider();
        //        when
        //        then
        $this->assertInstanceOf(CollectionProvider::class, $collectionProvider );
    }


    /**
     * @dataProvider successfulCollectionProviderCases
     */
    public function testValidCollectionProvider(
        array $export,
        NormalizerInterface $normalizer,
        string $collectionName,
        array $validCollection
    )
    {
        //        given
        $collectionProvider = new CollectionProvider();
        //        when
        $collection = $collectionProvider->getCollection([$this->exportProvider($export)], $normalizer, $collectionName);
        //        then
        $this->assertEquals($collection, $validCollection );
    }


    public static function successfulCollectionProviderCases(): array
    {
        return [
            [['id' => 1, 'place' => 'place', 'date' => '2022-11-11 11:00:00', 'user' => 'user', 'name' => 'name'], new ExportNormalizer(), 'export', ['export' => [['place' => 'place', 'date' => '2022-11-11', 'user' => 'user', 'name' => 'name', 'time' => '11:00']] ] ],
        ];
    }


    /**
     * @dataProvider failureCollectionProviderCases
     */
    public function testNonValidCollectionProvider(
        array $export,
        NormalizerInterface $normalizer,
        string $collectionName,
        array $nonValidCollection
    )
    {
        //        given
        $collectionProvider = new CollectionProvider();
        //        when
        $collection = $collectionProvider->getCollection([$this->exportProvider($export)], $normalizer, $collectionName);
        //        then
        $this->assertNotEquals($collection, $nonValidCollection );
    }


    public static function failureCollectionProviderCases(): array
    {
        return [
            [['id' => 1, 'place' => 'place', 'date' => '2022-11-11 11:00:00', 'user' => 'user', 'name' => 'name'], new ExportNormalizer(), 'export', ['test' => [['place' => 'place', 'date' => '2022-11-11', 'user' => 'user', 'name' => 'name', 'time' => '11:00']] ] ],
            [['id' => 1, 'place' => 'place', 'date' => '2022-11-11 11:00:00', 'user' => 'user', 'name' => 'name'], new ExportNormalizer(), 'export', ['export' => [['test' => 'place', 'date' => '2022-11-11', 'user' => 'user', 'name' => 'name', 'time' => '11:00']] ] ],
            [['id' => 1, 'place' => 'test', 'date' => '2022-11-11 11:00:00', 'user' => 'user', 'name' => 'name'], new ExportNormalizer(), 'export', ['export' => [['place' => 'place', 'date' => '2022-11-11', 'user' => 'user', 'name' => 'name', 'time' => '11:00']] ] ],
        ];
    }

}

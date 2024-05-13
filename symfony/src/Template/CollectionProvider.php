<?php

namespace App\Template;

use App\Entity\Export;
use App\Normalizer\NormalizerInterface;

class CollectionProvider implements CollectionProviderInterface
{
    public function getCollection(array $data, NormalizerInterface $normalizer, string $collectionName): array
    {
        $collection = [$collectionName => []];
        foreach ($data as $datum) {
            /* @var  Export $export*/
            $collection[$collectionName][] = $normalizer->normalize($datum);
        }
        return $collection;
    }
}
<?php

namespace App\Template;

use App\Normalizer\NormalizerInterface;

interface CollectionProviderInterface
{
    public function getCollection(array $data, NormalizerInterface $normalizer, string $collectionName): array;
}
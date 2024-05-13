<?php

namespace App\Normalizer\Export;

use App\Entity\Export;
use App\Normalizer\NormalizerInterface;

class ExportNormalizer implements NormalizerInterface
{
    public function normalize($object): array
    {
        /* @var Export $object*/
        return ['name' => $object->getName(), 'user' => $object->getUser(), 'place' => $object->getPlace(), 'date' => $object->getDate()->format('Y-m-d'), 'time' => $object->getDate()->format('H:i')];
    }
}
<?php

namespace App\Normalizer;

interface NormalizerInterface
{
    public function normalize($object): array;
}
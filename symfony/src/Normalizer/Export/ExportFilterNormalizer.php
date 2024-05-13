<?php

namespace App\Normalizer\Export;

use App\Filter\Export\ExportFilter;
use App\Normalizer\NormalizerInterface;
use DateTime;

class ExportFilterNormalizer implements NormalizerInterface
{
    public function normalize($object): array
    {
        /* @var ExportFilter $object*/
        return ['place' => $object->getPlace(), 'toDate' => $this->normalizeDate($object->getToDate()),'fromDate' => $this->normalizeDate($object->getFromDate())];
    }

    private function normalizeDate(string $date): string
    {
        $format = 'Y-m-d';
        $dateTime = DateTime::createFromFormat($format, $date);
        if(!$dateTime || $dateTime->format($format) !== $date)
            return '';

        return $date;
    }
}
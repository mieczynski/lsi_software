<?php

namespace App\Filter\Export;

class ExportFilter
{
    private string $place;
    private string $toDate;
    private string $fromDate;

    /**
     * @param string $place
     * @param string $toDate
     * @param string $fromDate
     */
    public function __construct(string $place, string $toDate, string $fromDate)
    {
        $this->place = $place;
        $this->toDate = $toDate;
        $this->fromDate = $fromDate;
    }

    public function getPlace(): string
    {
        return $this->place;
    }

    public function getToDate(): string
    {
        return $this->toDate;
    }

    public function getFromDate(): string
    {
        return $this->fromDate;
    }


}
<?php

namespace App\Tests\Export;

use App\Entity\Export;

trait ExportProvider
{
    protected function exportProvider(array $data): Export
    {
        $export = new Export();
        $export->setId($data['id']);
        $export->setName($data['name']);
        $export->setPlace($data['place']);
        $export->setUser($data['user']);
        $export->setDate(new \DateTime($data['date']));
        return $export;
    }

}
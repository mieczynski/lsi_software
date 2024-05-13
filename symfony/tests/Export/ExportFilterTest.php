<?php

namespace App\Tests\Export;

use App\Filter\Export\ExportFilter;
use PHPUnit\Framework\TestCase;

class ExportFilterTest extends TestCase
{

    public function testIfExportFilterExists(
    )
    {
        //        given
        $exportFilter = new ExportFilter('place', 'toDate', 'fromDate');
        //        when

        //        then
        $this->assertInstanceOf(ExportFilter::class, $exportFilter );
    }

}

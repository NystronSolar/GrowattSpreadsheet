<?php

use NystronSolar\GrowattSpreadsheet\Company;
use NystronSolar\GrowattSpreadsheet\GrowattSpreadsheet;
use PHPUnit\Framework\TestCase;

class GrowattSpreadsheetTest extends TestCase
{
    public function testGrowattSpreadsheetGetterSetter()
    {
        $fakeCompany = new Company();
        $fakeCompany
            ->setName("Fake Company")
            ->setCode("FAKE1")
            ->setTotalComponentPower(10000)
            ->setEnergyTotal(5000.0)
        ;

        $growattSpreadsheet = new GrowattSpreadsheet();
        $growattSpreadsheet
            ->setCompany($fakeCompany)
        ;

        $this->assertSame($fakeCompany, $growattSpreadsheet->getCompany());
    }
}

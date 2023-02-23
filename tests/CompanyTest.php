<?php

use NystronSolar\GrowattSpreadsheet\Company;
use PHPUnit\Framework\TestCase;

class CompanyTest extends TestCase
{
    public function testCompanyGetterSetter()
    {
        $fakeCompanyName = 'Fake Company';
        $fakeCompanyCode = 'FAKE1';
        $fakeCompanyTotalComponentPower = 10000;
        $fakeCompanyEnergyTotal = 5000.0;

        $fakeCompany = new Company();
        $fakeCompany
            ->setName($fakeCompanyName)
            ->setCode($fakeCompanyCode)
            ->setTotalComponentPower($fakeCompanyTotalComponentPower)
            ->setEnergyTotal($fakeCompanyEnergyTotal)
        ;

        $this->assertSame($fakeCompanyName, $fakeCompany->getName());
        $this->assertSame($fakeCompanyCode, $fakeCompany->getCode());
        $this->assertSame($fakeCompanyTotalComponentPower, $fakeCompany->getTotalComponentPower());
        $this->assertSame($fakeCompanyEnergyTotal, $fakeCompany->getEnergyTotal());
    }
}

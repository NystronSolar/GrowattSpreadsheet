<?php

use NystronSolar\GrowattSpreadsheet\Company;
use NystronSolar\GrowattSpreadsheet\GrowattSpreadsheet;
use NystronSolar\GrowattSpreadsheet\Reader\ReaderFactory;
use PHPUnit\Framework\TestCase;

class ReaderTest extends TestCase
{
    protected ?GrowattSpreadsheet $expectedGrowattSpreadsheet = null;

    protected ?GrowattSpreadsheet $actualGrowattSpreadsheet = null;

    protected ?string $fakeSpreadsheetFile = 'tests/content/Fake.xlsx';

    protected ?string $fakeJsonFile = 'tests/content/Fake.json';

    protected function jsonAsGrowattSpreadsheet(string $fakeJsonFile = null): GrowattSpreadsheet
    {
        $fakeJsonFile = $fakeJsonFile ?? $this->fakeJsonFile;

        $arr = json_decode(file_get_contents($fakeJsonFile), true);
        $companyArr = $arr['Company'];

        $company = (new Company())
            ->setName($companyArr['Name'])
            ->setCode($companyArr['Code'])
            ->setTotalComponentPower(intval($companyArr['TotalComponentPower']))
            ->setEnergyTotal(floatval($companyArr['EnergyTotal']))
        ;

        $growattSpreadsheet = (new GrowattSpreadsheet())
            ->setCompany($company)
        ;

        return $growattSpreadsheet;
    }

    protected function setUp(): void
    {
        parent::setUp();

        $reader = ReaderFactory::fromFile($this->fakeSpreadsheetFile);

        $this->expectedGrowattSpreadsheet = $this->expectedGrowattSpreadsheet ?? $this->jsonAsGrowattSpreadsheet();
        $this->actualGrowattSpreadsheet = $this->actualGrowattSpreadsheet ?? $reader->search();
    }

    public function testSearchCompany()
    {
        $expectedCompany = $this->expectedGrowattSpreadsheet->getCompany();
        $actualCompany = $this->actualGrowattSpreadsheet->getCompany();

        $this->assertEquals($expectedCompany, $actualCompany);
    }
}

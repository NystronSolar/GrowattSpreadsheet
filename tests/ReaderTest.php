<?php

use NystronSolar\GrowattSpreadsheet\Company\Company;
use NystronSolar\GrowattSpreadsheet\GrowattSpreadsheet;
use NystronSolar\GrowattSpreadsheet\Reader\Reader;
use PhpOffice\PhpSpreadsheet\IOFactory;
use PhpOffice\PhpSpreadsheet\Spreadsheet;
use PhpOffice\PhpSpreadsheet\Worksheet\Worksheet;
use PHPUnit\Framework\TestCase;

class ReaderTest extends TestCase
{
    private Worksheet $fakeSheet;

    private Spreadsheet $fakeSpreadsheet;

    private string $fakeSpreadsheetFile = 'tests/content/Fake.xlsx';

    private string $fakeJsonFile = 'tests/content/Fake.json';

    private GrowattSpreadsheet $fakeGrowattSpreadsheet;

    protected function setUp(): void
    {
        parent::setUp();

        $this->fakeSpreadsheet = IOFactory::load($this->fakeSpreadsheetFile);
        $this->fakeSheet = $this->fakeSpreadsheet->getActiveSheet();
        $this->fakeGrowattSpreadsheet = $this->jsonAsGrowattSpreadsheet();
    }

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

    public function testSearchCompany()
    {
        $expectedCompany = $this->fakeGrowattSpreadsheet->getCompany();
        $actualCompany = Reader::searchCompany($this->fakeSheet);

        $this->assertEquals($expectedCompany, $actualCompany);
    }
}

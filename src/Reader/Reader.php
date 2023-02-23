<?php

namespace NystronSolar\GrowattSpreadsheet\Reader;

use NystronSolar\GrowattSpreadsheet\Company;
use NystronSolar\GrowattSpreadsheet\GrowattSpreadsheet;
use PhpOffice\PhpSpreadsheet\Worksheet\Worksheet;

class Reader
{
    public Worksheet $sheet;

    public function __construct(Worksheet $sheet)
    {
        $this->sheet = $sheet;
    }

    public function search(): GrowattSpreadsheet
    {
        $growattSpreadsheet = new GrowattSpreadsheet();

        $growattSpreadsheet->setCompany($this->searchCompany());

        return $growattSpreadsheet;
    }

    protected function searchCompany(): Company
    {
        $sheet = $this->sheet;
        $company = (new Company())
            ->setName(substr($sheet->getCell('A1')->getValue(), 13))
            ->setCode(substr($sheet->getCell('B1')->getValue(), 5))
            ->setTotalComponentPower(intval($sheet->getCell('D1')->getValue()))
            ->setEnergyTotal(floatval($sheet->getCell('F1')->getValue()))
        ;

        return $company;
    }
}
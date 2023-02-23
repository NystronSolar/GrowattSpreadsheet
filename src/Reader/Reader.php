<?php

namespace NystronSolar\GrowattSpreadsheet\Reader;

use NystronSolar\GrowattSpreadsheet\Company\Company;
use NystronSolar\GrowattSpreadsheet\Company\CompanyInterface;
use NystronSolar\GrowattSpreadsheet\GrowattSpreadsheet;
use NystronSolar\GrowattSpreadsheet\GrowattSpreadsheetInterface;
use PhpOffice\PhpSpreadsheet\IOFactory;
use PhpOffice\PhpSpreadsheet\Reader\BaseReader;
use PhpOffice\PhpSpreadsheet\Spreadsheet;
use PhpOffice\PhpSpreadsheet\Worksheet\Worksheet;

class Reader implements ReaderInterface
{
    public static function fromFile(string $filename, BaseReader $spreadsheetReader = null): GrowattSpreadsheetInterface
    {
        $spreadsheetReader = $spreadsheetReader ?? IOFactory::createReaderForFile($filename);

        $spreadsheet = $spreadsheetReader->load($filename);

        $growattSpreadsheet = static::fromSpreadsheet($spreadsheet);

        return $growattSpreadsheet;
    }

    public static function fromSpreadsheet(Spreadsheet $spreadsheet): GrowattSpreadsheetInterface
    {
        $sheet = $spreadsheet->getActiveSheet();

        $growattSpreadsheet = new GrowattSpreadsheet();
        $growattSpreadsheet
            ->setCompany(static::searchCompany($sheet))
        ;

        return $growattSpreadsheet;
    }

    public static function searchCompany(Worksheet $sheet, CompanyInterface $company = null): CompanyInterface
    {
        $company = $company ?? new Company();
        $company
            ->setName(substr($sheet->getCell('A1')->getValue(), 13))
            ->setCode(substr($sheet->getCell('B1')->getValue(), 5))
            ->setTotalComponentPower(intval($sheet->getCell('D1')->getValue()))
            ->setEnergyTotal(floatval($sheet->getCell('F1')->getValue()))
        ;

        return $company;
    }
}

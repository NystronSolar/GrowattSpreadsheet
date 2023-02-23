<?php

namespace NystronSolar\GrowattSpreadsheet\Reader;

use NystronSolar\GrowattSpreadsheet\Company\CompanyInterface;
use NystronSolar\GrowattSpreadsheet\GrowattSpreadsheetInterface;
use PhpOffice\PhpSpreadsheet\Reader\BaseReader;
use PhpOffice\PhpSpreadsheet\Spreadsheet;
use PhpOffice\PhpSpreadsheet\Worksheet\Worksheet;

interface ReaderInterface
{
    public static function fromFile(string $filename, BaseReader $spreadsheetReader = null): GrowattSpreadsheetInterface;

    public static function fromSpreadsheet(Spreadsheet $spreadsheet): GrowattSpreadsheetInterface;

    public static function searchCompany(Worksheet $sheet, CompanyInterface $company = null): ?CompanyInterface;
}

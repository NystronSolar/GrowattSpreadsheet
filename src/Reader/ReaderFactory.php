<?php

namespace NystronSolar\GrowattSpreadsheet\Reader;

use PhpOffice\PhpSpreadsheet\IOFactory;
use PhpOffice\PhpSpreadsheet\Spreadsheet;
use PhpOffice\PhpSpreadsheet\Worksheet\Worksheet;

class ReaderFactory
{
    public static function fromFile(string $filename): Reader
    {
        $spreadsheet = IOFactory::load($filename);
        $reader = static::fromSpreadsheet($spreadsheet);

        return $reader;
    }

    public static function fromSpreadsheet(Spreadsheet $spreadsheet): Reader
    {
        $sheet = $spreadsheet->getActiveSheet();
        $reader = static::fromSheet($sheet);
        
        return $reader;
    }

    public static function fromSheet(Worksheet $sheet): Reader
    {
        $reader = new Reader($sheet);

        return $reader;
    }
}

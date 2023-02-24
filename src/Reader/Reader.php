<?php

namespace NystronSolar\GrowattSpreadsheet\Reader;

use NystronSolar\GrowattSpreadsheet\Client;
use NystronSolar\GrowattSpreadsheet\Company;
use NystronSolar\GrowattSpreadsheet\GenerationDay;
use NystronSolar\GrowattSpreadsheet\GrowattSpreadsheet;
use PhpOffice\PhpSpreadsheet\Cell\Coordinate;
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
        $growattSpreadsheet->setClients($this->searchClients());

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

    /** @return Client[] */
    protected function searchClients(): array
    {
        $sheet = $this->sheet;
        $clientsCount = $sheet->getHighestDataRow() - 3;
        $clients = [];

        for ($i = 0; $i <= $clientsCount; ++$i) {
            $row = $i + 3;

            $client = $this->getClientData($row);
            $client = $this->getGenerationDays($client, $row);

            $clients[] = $client;
        }

        return $clients;
    }

    private function getClientData(int $row): Client
    {
        $sheet = $this->sheet;
        $createDate = \DateTime::createFromFormat(GrowattSpreadsheet::DATE_TIME_FORMAT, $sheet->getCell("E$row")->getValue());

        $client = (new Client())
            ->setPlantName($sheet->getCell("A$row")->getValue())
            ->setUserAccountName($sheet->getCell("B$row")->getValue())
            ->setCity($sheet->getCell("C$row")->getValue())
            ->setDeviceCount((int) $sheet->getCell("D$row")->getValue())
            ->setCreateDate($createDate)
            ->setTotalComponentPower((int) $sheet->getCell("F$row")->getValue())
        ;

        return $client;
    }

    private function getGenerationDays(Client $client, int $row): Client
    {
        $sheet = $this->sheet;
        $totalDays = (Coordinate::columnIndexFromString($sheet->getHighestDataColumn()) - 8) / 2;

        $generationDays = [];

        for ($i = 1; $i <= $totalDays; ++$i) {
            $generationColumn = Coordinate::stringFromColumnIndex($i + 6);
            $hoursColumn = Coordinate::stringFromColumnIndex($i + 6 + $totalDays + 1);

            $dateRow = 2;
            $date = \DateTime::createFromFormat(GrowattSpreadsheet::DATE_TIME_FORMAT, $sheet->getCell($generationColumn . $dateRow)->getValue());

            $generationDay = (new GenerationDay())
                ->setGeneration($sheet->getCell($generationColumn.$row)->getValue())
                ->setHours($sheet->getCell($hoursColumn.$row)->getValue())
                ->setDate($date)
            ;

            $generationDays[] = $generationDay;
        }

        $energyTotalColumn = Coordinate::stringFromColumnIndex(6 + $totalDays + 1);
        $hoursTotalColumn = Coordinate::stringFromColumnIndex(6 + ($totalDays * 2) + 2);
        $client
            ->setGenerationDays($generationDays)
            ->setEnergyTotal($sheet->getCell($energyTotalColumn.$row)->getValue())
            ->setHoursTotal($sheet->getCell($hoursTotalColumn.$row)->getValue())
        ;

        return $client;
    }
}

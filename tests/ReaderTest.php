<?php

use NystronSolar\GrowattSpreadsheet\Client;
use NystronSolar\GrowattSpreadsheet\Company;
use NystronSolar\GrowattSpreadsheet\GenerationDay;
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

        $json = json_decode(file_get_contents($fakeJsonFile), true);
        $jsonCompany = $json['Company'];
        $jsonClients = $json['Clients'];

        $company = (new Company())
            ->setName($jsonCompany['Name'])
            ->setCode($jsonCompany['Code'])
            ->setTotalComponentPower(intval($jsonCompany['TotalComponentPower']))
            ->setEnergyTotal(floatval($jsonCompany['EnergyTotal']))
        ;

        $clients = [];

        foreach ($jsonClients as $jsonClient) {
            $createDate = DateTime::createFromFormat(GrowattSpreadsheet::DATE_TIME_FORMAT, $jsonClient['CreateDate']);

            $clientGenerationDays = [];
            $jsonClientGenerationDays = $jsonClient['Generation'];

            foreach ($jsonClientGenerationDays as $jsonClientGenerationDay) {
                $clientGenerationDay = (new GenerationDay())
                    ->setDate(DateTime::createFromFormat(GrowattSpreadsheet::DATE_TIME_FORMAT, $jsonClientGenerationDay['Date']))
                    ->setGeneration($jsonClientGenerationDay['Generation'])
                ;

                $clientGenerationDays[] = $clientGenerationDay;
            }

            $client = (new Client())
                ->setPlantName($jsonClient['PlantName'])
                ->setUserAccountName($jsonClient['UserAccountName'])
                ->setCity($jsonClient['City'])
                ->setDeviceCount($jsonClient['DeviceCount'])
                ->setCreateDate($createDate)
                ->setTotalComponentPower($jsonClient['TotalComponentPower'])
                ->setEnergyTotal($jsonClient['EnergyTotal'])
                ->setHoursTotal($jsonClient['HoursTotal'])
                ->setGenerationDays($jsonClientGenerationDays)
            ;

            $clients[] = $client;
        }

        $growattSpreadsheet = (new GrowattSpreadsheet())
            ->setCompany($company)
            ->setClients($clients)
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

    public function testSearchClients()
    {
        $expectedCompany = $this->expectedGrowattSpreadsheet->getClients();
        $actualCompany = $this->actualGrowattSpreadsheet->getClients();

        $this->assertEquals($expectedCompany, $actualCompany);
    }
}

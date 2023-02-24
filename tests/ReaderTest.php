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
            $jsonClientGenerationDays = $jsonClient['GenerationDays'];

            foreach ($jsonClientGenerationDays as $jsonClientGenerationDay) {
                $clientGenerationDay = (new GenerationDay())
                    ->setDate(DateTime::createFromFormat(GrowattSpreadsheet::DATE_TIME_FORMAT, $jsonClientGenerationDay['Date']))
                    ->setHours($jsonClientGenerationDay['Hours'])
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
                ->setGenerationDays($clientGenerationDays)
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

    public function testSearchClientData(): void
    {
        $fn = function (Client $client) {
            $client->getPlantName();
            $client->getUserAccountName();
            $client->getCity();
            $client->getDeviceCount();
            $client->getCreateDate();
            $client->getTotalComponentPower();
            $client->getEnergyTotal();
            $client->getHoursTotal();
        };

        $expectedClientsData = array_map($fn, $this->expectedGrowattSpreadsheet->getClients());
        $actualClientsData = array_map($fn, $this->actualGrowattSpreadsheet->getClients());

        $this->assertEquals($expectedClientsData, $actualClientsData);
    }

    public function testSearchClientGenerationFirstDay(): void
    {
        $expectedClientGeneration = $this->expectedGrowattSpreadsheet->getClients()[0]->getGenerationDays();
        $actualClientGeneration = $this->actualGrowattSpreadsheet->getClients()[0]->getGenerationDays();

        $this->assertEquals($expectedClientGeneration, $actualClientGeneration);
    }
}

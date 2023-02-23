<?php

use NystronSolar\GrowattSpreadsheet\Client;
use NystronSolar\GrowattSpreadsheet\ClientData;
use NystronSolar\GrowattSpreadsheet\DayGeneration;
use PHPUnit\Framework\TestCase;

class ClientDataTest extends TestCase
{
    public function testDayGenerationGetterSetter()
    {
        $fakeClient = (new Client())
            ->setPlantName('FakeHouse')
            ->setUserAccountName('FakeUser')
            ->setCity('City')
            ->setDeviceCount(1)
            ->setCreateDate(new DateTime())
            ->setTotalComponentPower(2500.0)
        ;

        $fakeGenerationArray = [
            (new DayGeneration())
                ->setDate(new DateTime('01/01/2023'))
                ->setGeneration(10.0)
            ,
            (new DayGeneration())
                ->setDate(new DateTime('02/01/2023'))
                ->setGeneration(20.0)
            ,
            (new DayGeneration())
                ->setDate(new DateTime('03/01/2023'))
                ->setGeneration(30.0)
        ];

        $clientData = (new ClientData())
            ->setClient($fakeClient)
            ->setGenerationArray($fakeGenerationArray)
        ;

        $this->assertSame($fakeClient, $clientData->getClient());
        $this->assertSame($fakeGenerationArray, $clientData->getGenerationArray());
    }
}

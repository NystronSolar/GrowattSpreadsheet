<?php

use NystronSolar\GrowattSpreadsheet\Client;
use PHPUnit\Framework\TestCase;

class ClientTest extends TestCase
{
    public function testClientGetterSetter()
    {
        $fakePlantName = 'FakeHouse';
        $fakeUserAccountName = 'FakeUser';
        $fakeCity = 'City';
        $fakeDeviceCount = 1;
        $fakeCreateDate = new DateTime();
        $fakeTotalComponentPower = 2500;

        $fakeClient = (new Client())
            ->setPlantName($fakePlantName)
            ->setUserAccountName($fakeUserAccountName)
            ->setCity($fakeCity)
            ->setDeviceCount($fakeDeviceCount)
            ->setCreateDate($fakeCreateDate)
            ->setTotalComponentPower($fakeTotalComponentPower)
        ;

        $this->assertSame($fakePlantName, $fakeClient->getPlantName());
        $this->assertSame($fakeUserAccountName, $fakeClient->getUserAccountName());
        $this->assertSame($fakeCity, $fakeClient->getCity());
        $this->assertSame($fakeDeviceCount, $fakeClient->getDeviceCount());
        $this->assertSame($fakeCreateDate, $fakeClient->getCreateDate());
        $this->assertSame($fakeTotalComponentPower, $fakeClient->getTotalComponentPower());
    }
}

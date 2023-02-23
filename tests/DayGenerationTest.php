<?php

use NystronSolar\GrowattSpreadsheet\DayGeneration\DayGeneration;
use PHPUnit\Framework\TestCase;

class DayGenerationTest extends TestCase
{
    public function testDayGenerationGetterSetter()
    {
        $fakeDate = new DateTime();
        $fakeGeneration = 15.5;

        $fakeDayGeneration = (new DayGeneration())
            ->setDate($fakeDate)
            ->setGeneration($fakeGeneration)
        ;

        $this->assertSame($fakeDate, $fakeDayGeneration->getDate());
        $this->assertSame($fakeGeneration, $fakeDayGeneration->getGeneration());
    }
}

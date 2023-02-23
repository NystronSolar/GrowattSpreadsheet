<?php

use NystronSolar\GrowattSpreadsheet\GenerationDay;
use PHPUnit\Framework\TestCase;

class GenerationDayTest extends TestCase
{
    public function testGenerationDayGetterSetter()
    {
        $fakeDate = new DateTime();
        $fakeGeneration = 15.5;

        $fakeGenerationDay = (new GenerationDay())
            ->setDate($fakeDate)
            ->setGeneration($fakeGeneration)
        ;

        $this->assertSame($fakeDate, $fakeGenerationDay->getDate());
        $this->assertSame($fakeGeneration, $fakeGenerationDay->getGeneration());
    }
}

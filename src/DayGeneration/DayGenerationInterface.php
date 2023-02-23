<?php

namespace NystronSolar\GrowattSpreadsheet\DayGeneration;

use DateTime;

interface DayGenerationInterface
{
    public function getDate(): ?DateTime;

    public function setDate(DateTime $date): self;

    public function getGeneration(): ?float;

    public function setGeneration(float $generation): self;
}

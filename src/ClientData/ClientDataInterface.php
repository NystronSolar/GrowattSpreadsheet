<?php

namespace NystronSolar\GrowattSpreadsheet\ClientData;

use NystronSolar\GrowattSpreadsheet\Client\ClientInterface;
use NystronSolar\GrowattSpreadsheet\DayGeneration\DayGenerationInterface;

interface ClientDataInterface
{
    public function getClient(): ?ClientInterface;

    public function setClient(ClientInterface $client): self;

    /** @return DayGenerationInterface[]|null */
    public function getGeneration(): ?array;

    public function setGeneration(DayGenerationInterface $dayGeneration): self;

    public function addDayGeneration(DayGenerationInterface $dayGeneration): self;
}
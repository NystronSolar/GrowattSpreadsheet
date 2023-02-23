<?php

namespace NystronSolar\GrowattSpreadsheet\ClientData;

use DateTime;
use NystronSolar\GrowattSpreadsheet\Client\ClientInterface;
use NystronSolar\GrowattSpreadsheet\DayGeneration\DayGenerationInterface;

class ClientData
{
    private ?ClientInterface $client = null;

    /** @var DayGenerationInterface[]|null */
    private ?array $generationArray = null;

    public function getClient(): ?ClientInterface
    {
        return $this->client;
    }

    public function setClient(ClientInterface $client): self
    {
        $this->client = $client;

        return $this;
    }

    /** @return DayGenerationInterface[]|null */
    public function getGenerationArray(): ?array
    {
        return $this->generationArray;
    }

    public function setGenerationArray(array $generationArray): self
    {
        $this->generationArray = $generationArray;

        return $this;
    }

    public function addGenerationDay(DayGenerationInterface $dayGeneration): self
    {
        $generationArray = $this->getGenerationArray();
        $generationArray[] = $dayGeneration;

        $this->setGenerationArray($generationArray);

        return $this;
    }
}
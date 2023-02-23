<?php

namespace NystronSolar\GrowattSpreadsheet;

class ClientData
{
    private ?Client $client = null;

    /** @var DayGeneration[]|null */
    private ?array $generationArray = null;

    public function getClient(): ?Client
    {
        return $this->client;
    }

    public function setClient(Client $client): self
    {
        $this->client = $client;

        return $this;
    }

    /** @return DayGeneration[]|null */
    public function getGenerationArray(): ?array
    {
        return $this->generationArray;
    }

    public function setGenerationArray(array $generationArray): self
    {
        $this->generationArray = $generationArray;

        return $this;
    }

    public function addGenerationDay(DayGeneration $dayGeneration): self
    {
        $generationArray = $this->getGenerationArray();
        $generationArray[] = $dayGeneration;

        $this->setGenerationArray($generationArray);

        return $this;
    }
}

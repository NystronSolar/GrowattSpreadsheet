<?php

namespace NystronSolar\GrowattSpreadsheet;

class Company implements \JsonSerializable
{
    private ?string $name = null;

    private ?string $code = null;

    private ?int $totalComponentPower = null;

    private ?float $energyTotal = null;

    public function getName(): string
    {
        return $this->name;
    }

    public function setName(string $name): self
    {
        $this->name = $name;

        return $this;
    }

    public function getCode(): ?string
    {
        return $this->code;
    }

    public function setCode(string $code): self
    {
        $this->code = $code;

        return $this;
    }

    public function getTotalComponentPower(): ?int
    {
        return $this->totalComponentPower;
    }

    public function setTotalComponentPower(int $totalComponentPower): self
    {
        $this->totalComponentPower = $totalComponentPower;

        return $this;
    }

    public function getEnergyTotal(): ?float
    {
        return $this->energyTotal;
    }

    public function setEnergyTotal(float $energyTotal): self
    {
        $this->energyTotal = $energyTotal;

        return $this;
    }

    public function toArray(): array
    {
        return [
            'Name' => $this->getName(),
            'Code' => $this->getCode(),
            'TotalComponentPower' => $this->getTotalComponentPower(),
            'EnergyTotal' => $this->getEnergyTotal(),
        ];
    }

    public function jsonSerialize(): array
    {
        return $this->toArray();
    }
}

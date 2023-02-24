<?php

namespace NystronSolar\GrowattSpreadsheet;

class Client implements \JsonSerializable
{
    private ?string $plantName = null;

    private ?string $userAccountName = null;

    private ?string $city = null;

    private ?int $deviceCount = null;

    private ?\DateTime $createDate = null;

    private ?int $totalComponentPower = null;

    private ?float $energyTotal = null;

    private ?float $hoursTotal = null;

    /** @var GenerationDay[]|null */
    private ?array $generationDays = null;

    public function getPlantName(): ?string
    {
        return $this->plantName;
    }

    public function setPlantName(string $plantName): self
    {
        $this->plantName = $plantName;

        return $this;
    }

    public function getUserAccountName(): ?string
    {
        return $this->userAccountName;
    }

    public function setUserAccountName(string $userAccountName): self
    {
        $this->userAccountName = $userAccountName;

        return $this;
    }

    public function getCity(): ?string
    {
        return $this->city;
    }

    public function setCity(string $city): self
    {
        $this->city = $city;

        return $this;
    }

    public function getDeviceCount(): ?int
    {
        return $this->deviceCount;
    }

    public function setDeviceCount(int $deviceCount): self
    {
        $this->deviceCount = $deviceCount;

        return $this;
    }

    public function getCreateDate(): ?\DateTime
    {
        return $this->createDate;
    }

    public function setCreateDate(\DateTime $createDate): self
    {
        $this->createDate = $createDate;

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

    public function getHoursTotal(): ?float
    {
        return $this->hoursTotal;
    }

    public function setHoursTotal(float $hoursTotal): self
    {
        $this->hoursTotal = $hoursTotal;

        return $this;
    }

    /** @return GenerationDay[]|null */
    public function getGenerationDays(): ?array
    {
        return $this->generationDays;
    }

    /** @param GenerationDay[] $generationDays */
    public function setGenerationDays(array $generationDays): self
    {
        $this->generationDays = $generationDays;

        return $this;
    }

    public function toArray(): array
    {
        return [
            'PlantName' => $this->getPlantName(),
            'UserAccountName' => $this->getUserAccountName(),
            'City' => $this->getCity(),
            'DeviceCount' => $this->getDeviceCount(),
            'CreateDate' => $this->getCreateDate(),
            'TotalComponentPower' => $this->getTotalComponentPower(),
            'EnergyTotal' => $this->getEnergyTotal(),
            'HoursTotal' => $this->getHoursTotal(),
            'GenerationDays' => $this->getGenerationDays(),
        ];
    }

    public function jsonSerialize(): array
    {
        return $this->toArray();
    }
}

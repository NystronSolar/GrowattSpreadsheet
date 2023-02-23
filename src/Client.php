<?php

namespace NystronSolar\GrowattSpreadsheet;

class Client
{
    private ?string $plantName = null;

    private ?string $userAccountName = null;

    private ?string $city = null;

    private ?int $deviceCount = null;

    private ?\DateTime $createDate = null;

    private ?float $totalComponentPower = null;

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

    public function getTotalComponentPower(): ?float
    {
        return $this->totalComponentPower;
    }

    public function setTotalComponentPower(float $totalComponentPower): self
    {
        $this->totalComponentPower = $totalComponentPower;

        return $this;
    }
}

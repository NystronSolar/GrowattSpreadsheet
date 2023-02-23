<?php

namespace NystronSolar\GrowattSpreadsheet\Client;

use DateTime;

interface ClientInterface
{
    public function getPlantName(): ?string;

    public function setPlantName(string $plantName): self;

    public function getUserAccountName(): ?string;

    public function setUserAccountName(string $userAccountName): self;

    public function getCity(): ?string;

    public function setCity(string $city): self;

    public function getDeviceCount(): ?int;

    public function setDeviceCount(int $deviceCount): self;

    public function getCreateDate(): ?DateTime;

    public function setCreateDate(DateTime $createDate): self;

    public function getTotalComponentPower(): ?float;

    public function setTotalComponentPower(float $totalComponentPower): self;
}

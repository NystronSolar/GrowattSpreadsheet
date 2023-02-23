<?php

namespace NystronSolar\GrowattSpreadsheet\Company;

interface CompanyInterface extends \JsonSerializable
{
    public function getName(): ?string;

    public function setName(string $name): self;

    public function getCode(): ?string;

    public function setCode(string $code): self;

    public function getTotalComponentPower(): ?int;

    public function setTotalComponentPower(int $totalComponentPower): self;

    public function getEnergyTotal(): ?float;

    public function setEnergyTotal(float $energyTotal): self;
}
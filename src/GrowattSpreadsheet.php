<?php

namespace NystronSolar\GrowattSpreadsheet;

class GrowattSpreadsheet
{
    public const DATE_TIME_FORMAT = 'Y-m-d';

    private ?Company $company = null;

    /** @var Client[]|null */
    private ?array $clients = null;

    public function getCompany(): ?Company
    {
        return $this->company;
    }

    public function setCompany(Company $company): self
    {
        $this->company = $company;

        return $this;
    }

    /** @return Client[]|null */
    public function getClients(): ?array
    {
        return $this->clients;
    }

    /** @param Client[] */
    public function setClients(array $clients): self
    {
        $this->clients = $clients;

        return $this;
    }
}

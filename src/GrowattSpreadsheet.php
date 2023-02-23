<?php

namespace NystronSolar\GrowattSpreadsheet;

class GrowattSpreadsheet
{
    private ?Company $company = null;

    public function getCompany(): ?Company
    {
        return $this->company;
    }

    public function setCompany(Company $company): self
    {
        $this->company = $company;

        return $this;
    }
}

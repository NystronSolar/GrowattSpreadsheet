<?php

namespace NystronSolar\GrowattSpreadsheet;

use NystronSolar\GrowattSpreadsheet\Company\CompanyInterface;

class GrowattSpreadsheet implements GrowattSpreadsheetInterface
{
    private ?CompanyInterface $company = null;

    public function getCompany(): ?CompanyInterface
    {
        return $this->company;
    }

    public function setCompany(CompanyInterface $company): self
    {
        $this->company = $company;

        return $this;
    }
}

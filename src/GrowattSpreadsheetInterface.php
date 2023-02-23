<?php

namespace NystronSolar\GrowattSpreadsheet;

use NystronSolar\GrowattSpreadsheet\Company\CompanyInterface;

interface GrowattSpreadsheetInterface
{
    public function getCompany(): ?CompanyInterface;

    public function setCompany(CompanyInterface $company): self;
}

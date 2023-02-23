<?php

namespace NystronSolar\GrowattSpreadsheet;

class DayGeneration
{
    private \DateTime $date;

    private float $generation;

    public function getDate(): ?\DateTime
    {
        return $this->date;
    }

    public function setDate(\DateTime $date): self
    {
        $this->date = $date;

        return $this;
    }

    public function getGeneration(): ?float
    {
        return $this->generation;
    }

    public function setGeneration(float $generation): self
    {
        $this->generation = $generation;

        return $this;
    }
}

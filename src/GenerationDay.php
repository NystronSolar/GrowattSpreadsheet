<?php

namespace NystronSolar\GrowattSpreadsheet;

class GenerationDay
{
    private ?\DateTime $date = null;

    private ?float $generation = null;

    private ?float $hours = null;

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

    public function getHours(): ?float
    {
        return $this->hours;
    }

    public function setHours(float $hours): self
    {
        $this->hours = $hours;

        return $this;
    }
}

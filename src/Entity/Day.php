<?php

namespace App\Entity;

use App\Repository\DayRepository;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: DayRepository::class)]
class Day
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(type: Types::DATE_MUTABLE)]
    private ?\DateTimeInterface $daynow = null;

    #[ORM\Column(nullable: true)]
    private ?float $hours = null;

    #[ORM\Column(nullable: true)]
    private ?float $kpi = null;

    #[ORM\Column(nullable: true)]
    private ?float $total = null;

    #[ORM\ManyToOne(inversedBy: 'pers')]
    private ?Status $statuses = null;

    #[ORM\ManyToOne(inversedBy: 'days')]
    #[ORM\JoinColumn(nullable: false)]
    private ?pers $pers = null;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getDaynow(): ?\DateTimeInterface
    {
        return $this->daynow;
    }

    public function setDaynow(\DateTimeInterface $daynow): static
    {
        $this->daynow = $daynow;

        return $this;
    }

    public function getHours(): ?float
    {
        return $this->hours;
    }

    public function setHours(?float $hours): static
    {
        $this->hours = $hours;

        return $this;
    }

    public function getKpi(): ?float
    {
        return $this->kpi;
    }

    public function setKpi(?float $kpi): static
    {
        $this->kpi = $kpi;

        return $this;
    }

    public function getTotal(): ?float
    {
        return $this->total;
    }

    public function setTotal(?float $total): static
    {
        $this->total = $total;

        return $this;
    }

    public function getStatuses(): ?Status
    {
        return $this->statuses;
    }

    public function setStatuses(?Status $statuses): static
    {
        $this->statuses = $statuses;

        return $this;
    }

    public function getPers(): ?Pers
    {
        return $this->pers;
    }

    public function setPers(?Pers $pers): static
    {
        $this->pers = $pers;

        return $this;
    }
}

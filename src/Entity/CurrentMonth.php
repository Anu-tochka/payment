<?php

namespace App\Entity;

use App\Repository\CurrentMonthRepository;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: CurrentMonthRepository::class)]
class CurrentMonth
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(type: Types::SMALLINT, nullable: true)]
    private ?int $year = null;

    #[ORM\Column(length: 2, nullable: true)]
    private ?string $month = null;

    #[ORM\Column(type: Types::SMALLINT)]
    private ?int $salaryYear = null;

    #[ORM\Column(length: 2, nullable: true)]
    private ?string $salaryMonth = null;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getYear(): ?int
    {
        return $this->year;
    }

    public function setYear(?int $year): static
    {
        $this->year = $year;

        return $this;
    }

    public function getMonth(): ?string
    {
        return $this->month;
    }

    public function setMonth(?string $month): static
    {
        $this->month = $month;

        return $this;
    }

    public function getSalaryYear(): ?int
    {
        return $this->salaryYear;
    }

    public function setSalaryYear(int $salaryYear): static
    {
        $this->salaryYear = $salaryYear;

        return $this;
    }

    public function getSalaryMonth(): ?string
    {
        return $this->salaryMonth;
    }

    public function setSalaryMonth(?string $salaryMonth): static
    {
        $this->salaryMonth = $salaryMonth;

        return $this;
    }
}

<?php

namespace App\Entity;

use App\Repository\SalaryRepository;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: SalaryRepository::class)]
class Salary
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(type: Types::SMALLINT)]
    private ?int $year = null;

    #[ORM\Column(length: 2)]
    private ?string $month = null;

    #[ORM\Column(nullable: true)]
    private ?float $singlpay = null;

    #[ORM\Column(nullable: true)]
    private ?float $wages = null;

    #[ORM\Column(nullable: true)]
    private ?float $total = null;

    #[ORM\Column(type: Types::SMALLINT, nullable: true)]
    private ?int $workdays = null;

    #[ORM\Column(type: Types::SMALLINT, nullable: true)]
    private ?int $truancy = null;

    #[ORM\Column(type: Types::SMALLINT, nullable: true)]
    private ?int $sickdays = null;

    #[ORM\Column(type: Types::SMALLINT, nullable: true)]
    private ?int $vacation = null;

    #[ORM\Column(type: Types::SMALLINT, nullable: true)]
    private ?int $expense = null;

    #[ORM\Column(nullable: true)]
    private ?float $vacationpay = null;

    #[ORM\Column(nullable: true)]
    private ?float $debt = null;

    #[ORM\Column(nullable: true)]
    private ?float $keep = null;

    #[ORM\ManyToOne(inversedBy: 'salaries')]
    private ?pers $pers = null;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getYear(): ?int
    {
        return $this->year;
    }

    public function setYear(int $year): static
    {
        $this->year = $year;

        return $this;
    }

    public function getMonth(): ?string
    {
        return $this->month;
    }

    public function setMonth(string $month): static
    {
        $this->month = $month;

        return $this;
    }

    public function getSinglpay(): ?float
    {
        return $this->singlpay;
    }

    public function setSinglpay(?float $singlpay): static
    {
        $this->singlpay = $singlpay;

        return $this;
    }

    public function getWages(): ?float
    {
        return $this->wages;
    }

    public function setWages(?float $wages): static
    {
        $this->wages = $wages;

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

    public function getWorkdays(): ?int
    {
        return $this->workdays;
    }

    public function setWorkdays(?int $workdays): static
    {
        $this->workdays = $workdays;

        return $this;
    }

    public function getTruancy(): ?int
    {
        return $this->truancy;
    }

    public function setTruancy(?int $truancy): static
    {
        $this->truancy = $truancy;

        return $this;
    }

    public function getSickdays(): ?int
    {
        return $this->sickdays;
    }

    public function setSickdays(?int $sickdays): static
    {
        $this->sickdays = $sickdays;

        return $this;
    }

    public function getVacation(): ?int
    {
        return $this->vacation;
    }

    public function setVacation(?int $vacation): static
    {
        $this->vacation = $vacation;

        return $this;
    }

    public function getExpense(): ?int
    {
        return $this->expense;
    }

    public function setExpense(?int $expense): static
    {
        $this->expense = $expense;

        return $this;
    }

    public function getVacationpay(): ?float
    {
        return $this->vacationpay;
    }

    public function setVacationpay(?float $vacationpay): static
    {
        $this->vacationpay = $vacationpay;

        return $this;
    }

    public function getDebt(): ?float
    {
        return $this->debt;
    }

    public function setDebt(?float $debt): static
    {
        $this->debt = $debt;

        return $this;
    }

    public function getKeep(): ?float
    {
        return $this->keep;
    }

    public function setKeep(?float $keep): static
    {
        $this->keep = $keep;

        return $this;
    }

    public function getPers(): ?pers
    {
        return $this->pers;
    }

    public function setPers(?pers $pers): static
    {
        $this->pers = $pers;

        return $this;
    }
}

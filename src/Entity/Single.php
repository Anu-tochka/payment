<?php

namespace App\Entity;

use App\Repository\SingleRepository;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: SingleRepository::class)]
class Single
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(type: Types::SMALLINT)]
    private ?int $year = null;

    #[ORM\Column(type: Types::SMALLINT)]
    private ?int $month = null;

    #[ORM\Column(length: 255, nullable: true)]
    private ?string $description = null;

    #[ORM\Column(nullable: true)]
    private ?float $payment = null;

    #[ORM\Column(length: 1, nullable: true)]
    private ?string $sign = null;

    #[ORM\ManyToOne(inversedBy: 'singles')]
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

    public function getMonth(): ?int
    {
        return $this->month;
    }

    public function setMonth(int $month): static
    {
        $this->month = $month;

        return $this;
    }

    public function getDescription(): ?string
    {
        return $this->description;
    }

    public function setDescription(?string $description): static
    {
        $this->description = $description;

        return $this;
    }

    public function getPayment(): ?float
    {
        return $this->payment;
    }

    public function setPayment(?float $payment): static
    {
        $this->payment = $payment;

        return $this;
    }

    public function getSign(): ?string
    {
        return $this->sign;
    }

    public function setSign(?string $sign): static
    {
        $this->sign = $sign;

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

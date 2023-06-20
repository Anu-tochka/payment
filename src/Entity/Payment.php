<?php

namespace App\Entity;

use App\Repository\PaymentRepository;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: PaymentRepository::class)]
class Payment
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column]
    private ?float $debt = null;

    #[ORM\Column(type: Types::DATE_MUTABLE)]
    private ?\DateTimeInterface $payday = null;

    #[ORM\Column]
    private ?float $payment = null;

    #[ORM\Column(nullable: true)]
    private ?float $keep = null;

    #[ORM\ManyToOne(inversedBy: 'salaries')]
    private ?pers $pers = null;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getDebt(): ?float
    {
        return $this->debt;
    }

    public function setDebt(float $debt): static
    {
        $this->debt = $debt;

        return $this;
    }

    public function getPayday(): ?\DateTimeInterface
    {
        return $this->payday;
    }

    public function setPayday(\DateTimeInterface $payday): static
    {
        $this->payday = $payday;

        return $this;
    }

    public function getPayment(): ?float
    {
        return $this->payment;
    }

    public function setPayment(float $payment): static
    {
        $this->payment = $payment;

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

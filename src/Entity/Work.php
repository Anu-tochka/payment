<?php

namespace App\Entity;

use App\Repository\WorkRepository;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: WorkRepository::class)]
class Work
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 255)]
    private ?string $workname = null;

    #[ORM\Column(length: 10, nullable: true)]
    private ?string $cost = null;

    #[ORM\Column(length: 20, nullable: true)]
    private ?string $rate = null;

    #[ORM\Column(length: 10, nullable: true)]
    private ?string $trevelpayment = null;

    #[ORM\ManyToOne(inversedBy: 'works')]
    #[ORM\JoinColumn(nullable: false)]
    private ?department $dep = null;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getWorkname(): ?string
    {
        return $this->workname;
    }

    public function setWorkname(string $workname): static
    {
        $this->workname = $workname;

        return $this;
    }

    public function getCost(): ?string
    {
        return $this->cost;
    }

    public function setCost(?string $cost): static
    {
        $this->cost = $cost;

        return $this;
    }

    public function getRate(): ?string
    {
        return $this->rate;
    }

    public function setRate(?string $rate): static
    {
        $this->rate = $rate;

        return $this;
    }

    public function getTrevelpayment(): ?string
    {
        return $this->trevelpayment;
    }

    public function setTrevelpayment(?string $trevelpayment): static
    {
        $this->trevelpayment = $trevelpayment;

        return $this;
    }

    public function getDep(): ?department
    {
        return $this->dep;
    }

    public function setDep(?department $dep): static
    {
        $this->dep = $dep;

        return $this;
    }
}

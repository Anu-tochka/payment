<?php

namespace App\Entity;

use App\Repository\StatusRepository;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: StatusRepository::class)]
class Status
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 125, nullable: true)]
    private ?string $statusname = null;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getStatusname(): ?string
    {
        return $this->statusname;
    }

    public function setStatusname(?string $statusname): static
    {
        $this->statusname = $statusname;

        return $this;
    }
}

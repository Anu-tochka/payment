<?php

namespace App\Entity;

use App\Repository\DepartmentRepository;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: DepartmentRepository::class)]
class Department
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 255, nullable: true)]
    private ?string $depname = null;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getDepname(): ?string
    {
        return $this->depname;
    }

    public function setDepname(?string $depname): static
    {
        $this->depname = $depname;

        return $this;
    }
}

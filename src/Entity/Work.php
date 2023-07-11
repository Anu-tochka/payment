<?php

namespace App\Entity;

use App\Repository\WorkRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
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
    private ?Department $dep = null;

    #[ORM\OneToMany(mappedBy: 'works', targetEntity: Pers::class)]
    private Collection $pers;

    public function __construct()
    {
        $this->yes = new ArrayCollection();
    }

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

    public function getDep(): ?Department
    {
        return $this->dep;
    }

    public function setDep(?Department $dep): static
    {
        $this->dep = $dep;

        return $this;
    }

    /**
     * @return Collection<int, Pers>
     */
    public function getPers(): Collection
    {
        return $this->pers;
    }

    public function addPers(Pers $pers): static
    {
        if (!$this->yes->contains($pers)) {
            $this->yes->add($pers);
            $pers->setPers($this);
        }

        return $this;
    }

    public function removePers(Pers $pers): static
    {
        if ($this->yes->removeElement($pers)) {
            // set the owning side to null (unless already changed)
            if ($pers->getPers() === $this) {
                $pers->setPers(null);
            }
        }

        return $this;
    }
}

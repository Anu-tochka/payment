<?php

namespace App\Entity;

use App\Repository\StatusRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
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

    #[ORM\OneToMany(mappedBy: 'statuses', targetEntity: Day::class)]
    private Collection $days;

    public function __construct()
    {
        $this->days = new ArrayCollection();
    }

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

    /**
     * @return Collection<int, Day>
     */
    public function getDays(): Collection
    {
        return $this->days;
    }

    public function addDay(Day $day): static
    {
        if (!$this->days->contains($day)) {
            $this->days->add($day);
            $day->setStatuses($this);
        }

        return $this;
    }

    public function removeDay(Day $day): static
    {
        if ($this->days->removeElement($day)) {
            // set the owning side to null (unless already changed)
            if ($day->getStatuses() === $this) {
                $day->setStatuses(null);
            }
        }

        return $this;
    }
}

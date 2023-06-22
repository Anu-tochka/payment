<?php

namespace App\Entity;

use App\Repository\PersRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: PersRepository::class)]
class Pers
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 125, nullable: true)]
    private ?string $fam = null;

    #[ORM\Column(length: 125, nullable: true)]
    private ?string $im = null;

    #[ORM\Column(length: 125, nullable: true)]
    private ?string $ot = null;

    #[ORM\Column(length: 10, nullable: true)]
    private ?string $passportS = null;

    #[ORM\Column(length: 24, nullable: true)]
    private ?string $passportN = null;

    #[ORM\Column(length: 12, nullable: true)]
    private ?\DateTimeInterface $passportD = null;

    #[ORM\Column(length: 255, nullable: true)]
    private ?string $passportBy = null;

    #[ORM\Column(type: Types::DATE_MUTABLE, nullable: true)]
    private ?\DateTimeInterface $dr = null;

    #[ORM\Column(length: 55, nullable: true)]
    private ?string $inn = null;

    #[ORM\Column]
    private ?bool $isWork = null;

    #[ORM\Column(length: 45, nullable: true)]
    private ?string $employeeNum = null;

    #[ORM\OneToMany(mappedBy: 'pers', targetEntity: Single::class)]
    private Collection $singles;

    #[ORM\OneToMany(mappedBy: 'pers', targetEntity: Payment::class)]
    private Collection $payments;

    #[ORM\OneToMany(mappedBy: 'pers', targetEntity: Salary::class)]
    private Collection $salaries;

    public function __construct()
    {
        $this->singles = new ArrayCollection();
        $this->salaries = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getFam(): ?string
    {
        return $this->fam;
    }

    public function setFam(?string $fam): static
    {
        $this->fam = $fam;

        return $this;
    }

    public function getIm(): ?string
    {
        return $this->im;
    }

    public function setIm(?string $im): static
    {
        $this->im = $im;

        return $this;
    }

    public function getOt(): ?string
    {
        return $this->ot;
    }

    public function setOt(?string $ot): static
    {
        $this->ot = $ot;

        return $this;
    }

    public function getPassportS(): ?string
    {
        return $this->passport_s;
    }

    public function setPassportS(?string $passport_s): static
    {
        $this->passport_s = $passport_s;

        return $this;
    }

    public function getPassportN(): ?string
    {
        return $this->passport_n;
    }

    public function setPassportN(?string $passport_n): static
    {
        $this->passport_n = $passport_n;

        return $this;
    }

    public function getPassportD(): ?\DateTimeInterface
    {
        return $this->passportD;
    }

    public function setPassportD(?\DateTimeInterface $passportD): static
    {
        $this->passportD = $passportD;

        return $this;
    }

    public function getPassportBy(): ?string
    {
        return $this->passportBy;
    }

    public function setPassportBy(?string $passportBy): static
    {
        $this->passportBy = $passportBy;

        return $this;
    }

    public function getDr(): ?\DateTimeInterface
    {
        return $this->dr;
    }

    public function setDr(?\DateTimeInterface $dr): static
    {
        $this->dr = $dr;

        return $this;
    }

    public function getInn(): ?string
    {
        return $this->inn;
    }

    public function setInn(string $inn): static
    {
        $this->inn = $inn;

        return $this;
    }

    public function isIsWork(): ?bool
    {
        return $this->isWork;
    }

    public function setIsWork(bool $isWork): static
    {
        $this->isWork = $isWork;

        return $this;
    }

    public function getEmployeeNum(): ?string
    {
        return $this->employeeNum;
    }

    public function setEmployeeNum(?string $employeeNum): static
    {
        $this->employeeNum = $employeeNum;

        return $this;
    }

    /**
     * @return Collection<int, Single>
     */
    public function getSingles(): Collection
    {
        return $this->singles;
    }

    public function addSingle(Single $single): static
    {
        if (!$this->singles->contains($single)) {
            $this->singles->add($single);
            $single->setPers($this);
        }

        return $this;
    }

    public function removeSingle(Single $single): static
    {
        if ($this->singles->removeElement($single)) {
            // set the owning side to null (unless already changed)
            if ($single->getPers() === $this) {
                $single->setPers(null);
            }
        }

        return $this;
    }

    /**
     * @return Collection<int, Payment>
     */
    public function getSalaries(): Collection
    {
        return $this->salaries;
    }

    public function addPayment(Payment $payment): static
    {
        if (!$this->salaries->contains($payment)) {
            $this->salaries->add($payment);
            $payment->setPers($this);
        }

        return $this;
    }

    public function removePayment(Payment $payment): static
    {
        if ($this->salaries->removeElement($payment)) {
            // set the owning side to null (unless already changed)
            if ($payment->getPers() === $this) {
                $payment->setPers(null);
            }
        }

        return $this;
    }

    public function addSalary(Salary $salary): static
    {
        if (!$this->salaries->contains($salary)) {
            $this->salaries->add($salary);
            $salary->setPers($this);
        }

        return $this;
    }

    public function removeSalary(Salary $salary): static
    {
        if ($this->salaries->removeElement($salary)) {
            // set the owning side to null (unless already changed)
            if ($salary->getPers() === $this) {
                $salary->setPers(null);
            }
        }

        return $this;
    }
}

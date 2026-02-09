<?php

namespace App\Entity;

use App\Repository\CorrectionRepository;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: CorrectionRepository::class)]
class Correction
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 255)]
    private ?string $name = null;

    #[ORM\Column]
    private ?\DateTime $date = null;

    #[ORM\OneToOne(mappedBy: 'correction', cascade: ['persist', 'remove'])]
    private ?Exercice $exercice = null;

    #[ORM\Column(length: 255)]
    private ?string $contenue = null;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getName(): ?string
    {
        return $this->name;
    }

    public function setName(string $name): static
    {
        $this->name = $name;

        return $this;
    }

    public function getContenue(): ?string
    {
        return $this->contenue;
    }

    public function setContenue(string $contenue): static
    {
        $this->contenue = $contenue;

        return $this;
    }

    public function getDate(): ?\DateTime
    {
        return $this->date;
    }

    public function setDate(\DateTime $date): static
    {
        $this->date = $date;

        return $this;
    }

    public function getExercice(): ?Exercice
    {
        return $this->exercice;
    }

    public function setExercice(Exercice $exercice): static
    {
        // set the owning side of the relation if necessary
        if ($exercice->getCorrection() !== $this) {
            $exercice->setCorrection($this);
        }

        $this->exercice = $exercice;

        return $this;
    }
}

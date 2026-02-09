<?php

namespace App\Entity;

use App\Repository\ExerciceRepository;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: ExerciceRepository::class)]
class Exercice
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 255)]
    private ?string $nom = null;

    #[ORM\Column]
    private ?\DateTime $date = null;

    #[ORM\ManyToOne(inversedBy: 'chapitre')]
    private ?Chapitre $chapitre = null;

    #[ORM\OneToOne(inversedBy: 'exercice', cascade: ['persist', 'remove'])]
    #[ORM\JoinColumn(nullable: false)]
    private ?Correction $correction = null;

    #[ORM\Column(length: 255)]
    private ?string $Contenue = null;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getNom(): ?string
    {
        return $this->nom;
    }

    public function setNom(string $nom): static
    {
        $this->nom = $nom;

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

    public function getChapitre(): ?Chapitre
    {
        return $this->chapitre;
    }

    public function setChapitre(?Chapitre $chapitre): static
    {
        $this->chapitre = $chapitre;

        return $this;
    }

    public function getCorrection(): ?Correction
    {
        return $this->correction;
    }

    public function setCorrection(Correction $correction): static
    {
        $this->correction = $correction;

        return $this;
    }

    public function getContenue(): ?string
    {
        return $this->Contenue;
    }

    public function setContenue(string $Contenue): static
    {
        $this->Contenue = $Contenue;

        return $this;
    }
}

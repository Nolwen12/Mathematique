<?php

namespace App\Entity;

use App\Repository\ChapitreRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: ChapitreRepository::class)]
class Chapitre
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 255)]
    private ?string $title = null;

    #[ORM\Column]
    private ?\DateTime $date = null;

    #[ORM\ManyToOne(inversedBy: 'chapitres')]
    #[ORM\JoinColumn(nullable: false)]
    private ?Categorie $categorie = null;

    /**
     * @var Collection<int, Exercice>
     */
    #[ORM\OneToMany(targetEntity: Exercice::class, mappedBy: 'chapitre')]
    private Collection $chapitre;

    #[ORM\Column(length: 255)]
    private ?string $Contenue = null;

    public function __construct()
    {
        $this->chapitre = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getTitle(): ?string
    {
        return $this->title;
    }

    public function setTitle(string $title): static
    {
        $this->title = $title;

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

    public function getCategorie(): ?Categorie
    {
        return $this->categorie;
    }

    public function setCategorie(?Categorie $categorie): static
    {
        $this->categorie = $categorie;

        return $this;
    }

    /**
     * @return Collection<int, Exercice>
     */
    public function getChapitre(): Collection
    {
        return $this->chapitre;
    }

    public function addChapitre(Exercice $chapitre): static
    {
        if (!$this->chapitre->contains($chapitre)) {
            $this->chapitre->add($chapitre);
            $chapitre->setChapitre($this);
        }

        return $this;
    }

    public function removeChapitre(Exercice $chapitre): static
    {
        if ($this->chapitre->removeElement($chapitre)) {
            // set the owning side to null (unless already changed)
            if ($chapitre->getChapitre() === $this) {
                $chapitre->setChapitre(null);
            }
        }

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

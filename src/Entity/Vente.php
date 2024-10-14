<?php

namespace App\Entity;

use App\Repository\VenteRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: VenteRepository::class)]
class Vente
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 150)]
    private ?string $nom = null;

    #[ORM\Column(type: Types::DATETIME_MUTABLE)]
    private ?\DateTimeInterface $dateVente = null;

    #[ORM\ManyToOne(inversedBy: 'ventes')]
    #[ORM\JoinColumn(nullable: false)]
    private ?LieuVente $idLieuVente = null;

    #[ORM\ManyToOne(inversedBy: 'ventes')]
    #[ORM\JoinColumn(nullable: false)]
    private ?CategorieVente $idCategorieVente = null;

    #[ORM\OneToMany(mappedBy: 'idVente', targetEntity: Lot::class)]
    private Collection $lots;

    #[ORM\Column(length: 255, nullable: true)]
    private ?string $imageVente = null;

    #[ORM\Column(length: 255, nullable: true)]
    private ?string $description = null;

    public function __construct()
    {
        $this->lots = new ArrayCollection();
    }

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

    public function getDateVente(): ?\DateTime
    {
        return $this->dateVente;
    }

    public function setDateVente(\DateTimeInterface $dateVente): static
    {
        $this->dateVente = $dateVente;

        return $this;
    }

    public function getIdLieuVente(): ?LieuVente
    {
        return $this->idLieuVente;
    }

    public function setIdLieuVente(?LieuVente $idLieuVente): static
    {
        $this->idLieuVente = $idLieuVente;

        return $this;
    }

    public function getIdCategorieVente(): ?CategorieVente
    {
        return $this->idCategorieVente;
    }

    public function setIdCategorieVente(?CategorieVente $idCategorieVente): static
    {
        $this->idCategorieVente = $idCategorieVente;

        return $this;
    }

    /**
     * @return Collection<int, Lot>
     */
    public function getLots(): Collection
    {
        return $this->lots;
    }

    public function addLot(Lot $lot): static
    {
        if (!$this->lots->contains($lot)) {
            $this->lots->add($lot);
            $lot->setIdVente($this);
        }

        return $this;
    }

    public function removeLot(Lot $lot): static
    {
        if ($this->lots->removeElement($lot)) {
            // set the owning side to null (unless already changed)
            if ($lot->getIdVente() === $this) {
                $lot->setIdVente(null);
            }
        }

        return $this;
    }

    public function getImageVente(): ?string
    {
        return $this->imageVente;
    }

    public function setImageVente(?string $imageVente): static
    {
        $this->imageVente = $imageVente;

        return $this;
    }

    public function getDescription(): ?string
    {
        return $this->description;
    }

    public function setDescription(?string $description): static
    {
        $this->description = $description;

        return $this;
    }
}

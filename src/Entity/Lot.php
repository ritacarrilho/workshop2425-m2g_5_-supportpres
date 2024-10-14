<?php

namespace App\Entity;

use App\Repository\LotRepository;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: LotRepository::class)]
class Lot
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column]
    private ?float $prixDepart = null;

    #[ORM\ManyToOne(inversedBy: 'lots')]
    #[ORM\JoinColumn(nullable: false)]
    private ?Vente $idVente = null;

    #[ORM\ManyToOne(inversedBy: 'lots')]
    #[ORM\JoinColumn(nullable: false)]
    private ?Cheval $idCheval = null;

    #[ORM\ManyToOne(inversedBy: 'lots')]
    #[ORM\JoinColumn(nullable: false)]
    private ?CategorieLot $idCategorieLot = null;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getPrixDepart(): ?float
    {
        return $this->prixDepart;
    }

    public function setPrixDepart(float $prixDepart): static
    {
        $this->prixDepart = $prixDepart;

        return $this;
    }

    public function getIdVente(): ?Vente
    {
        return $this->idVente;
    }

    public function setIdVente(?Vente $idVente): static
    {
        $this->idVente = $idVente;

        return $this;
    }

    public function getIdCheval(): ?Cheval
    {
        return $this->idCheval;
    }

    public function setIdCheval(?Cheval $idCheval): static
    {
        $this->idCheval = $idCheval;

        return $this;
    }

    public function getIdCategorieLot(): ?CategorieLot
    {
        return $this->idCategorieLot;
    }

    public function setIdCategorieLot(?CategorieLot $idCategorieLot): static
    {
        $this->idCategorieLot = $idCategorieLot;

        return $this;
    }
}

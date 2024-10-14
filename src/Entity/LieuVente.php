<?php

namespace App\Entity;

use App\Repository\LieuVenteRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: LieuVenteRepository::class)]
class LieuVente
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 255)]
    private ?string $libelle = null;

    #[ORM\OneToMany(mappedBy: 'idLieuVente', targetEntity: Vente::class)]
    private Collection $ventes;

    #[ORM\Column(nullable: true)]
    private ?int $nbrBoxes = null;

    #[ORM\Column(length: 255, nullable: true)]
    private ?string $commentaires = null;

    public function __construct()
    {
        $this->ventes = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getLibelle(): ?string
    {
        return $this->libelle;
    }

    public function setLibelle(string $libelle): static
    {
        $this->libelle = $libelle;

        return $this;
    }

    /**
     * @return Collection<int, Vente>
     */
    public function getVentes(): Collection
    {
        return $this->ventes;
    }

    public function addVente(Vente $vente): static
    {
        if (!$this->ventes->contains($vente)) {
            $this->ventes->add($vente);
            $vente->setIdLieuVente($this);
        }

        return $this;
    }

    public function removeVente(Vente $vente): static
    {
        if ($this->ventes->removeElement($vente)) {
            // set the owning side to null (unless already changed)
            if ($vente->getIdLieuVente() === $this) {
                $vente->setIdLieuVente(null);
            }
        }

        return $this;
    }

    public function getNbrBoxes(): ?int
    {
        return $this->nbrBoxes;
    }

    public function setNbrBoxes(?int $nbrBoxes): static
    {
        $this->nbrBoxes = $nbrBoxes;

        return $this;
    }

    public function getCommentaires(): ?string
    {
        return $this->commentaires;
    }

    public function setCommentaires(?string $commentaires): static
    {
        $this->commentaires = $commentaires;

        return $this;
    }
}

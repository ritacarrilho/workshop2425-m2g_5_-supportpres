<?php

namespace App\Entity;

use App\Repository\ViewedContentRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: ViewedContentRepository::class)]
class ViewedContent
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 50)]
    private ?string $title = null;

    #[ORM\Column(length: 50, nullable: true)]
    private ?string $url = null;

    #[ORM\Column(type: Types::DATE_MUTABLE, nullable: true)]
    private ?\DateTimeInterface $view_date = null;

    /**
     * @var Collection<int, Viewing>
     */
    #[ORM\OneToMany(targetEntity: Viewing::class, mappedBy: 'content')]
    private Collection $viewings;

    public function __construct()
    {
        $this->viewings = new ArrayCollection();
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

    public function getUrl(): ?string
    {
        return $this->url;
    }

    public function setUrl(?string $url): static
    {
        $this->url = $url;

        return $this;
    }

    public function getViewDate(): ?\DateTimeInterface
    {
        return $this->view_date;
    }

    public function setViewDate(?\DateTimeInterface $view_date): static
    {
        $this->view_date = $view_date;

        return $this;
    }

    /**
     * @return Collection<int, Viewing>
     */
    public function getViewings(): Collection
    {
        return $this->viewings;
    }

    public function addViewing(Viewing $viewing): static
    {
        if (!$this->viewings->contains($viewing)) {
            $this->viewings->add($viewing);
            $viewing->setContent($this);
        }

        return $this;
    }

    public function removeViewing(Viewing $viewing): static
    {
        if ($this->viewings->removeElement($viewing)) {
            // set the owning side to null (unless already changed)
            if ($viewing->getContent() === $this) {
                $viewing->setContent(null);
            }
        }

        return $this;
    }
}

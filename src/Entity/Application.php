<?php

namespace App\Entity;

use App\Repository\ApplicationRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: ApplicationRepository::class)]
class Application
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 50)]
    private ?string $name = null;

    #[ORM\Column]
    private ?int $category = null;

    #[ORM\Column]
    private ?int $age_rating = null;

    /**
     * @var Collection<int, Logging>
     */
    #[ORM\OneToMany(targetEntity: Logging::class, mappedBy: 'app')]
    private Collection $loggings;

    /**
     * @var Collection<int, Viewing>
     */
    #[ORM\OneToMany(targetEntity: Viewing::class, mappedBy: 'app')]
    private Collection $viewings;

    /**
     * @var Collection<int, Child>
     */
    #[ORM\ManyToMany(targetEntity: Child::class, inversedBy: 'applications')]
    #[ORM\JoinTable(name: 'utilization')]
    private Collection $children;

    public function __construct()
    {
        $this->loggings = new ArrayCollection();
        $this->viewings = new ArrayCollection();
        $this->children = new ArrayCollection();
    }

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

    public function getCategory(): ?int
    {
        return $this->category;
    }

    public function setCategory(int $category): static
    {
        $this->category = $category;

        return $this;
    }

    public function getAgeRating(): ?int
    {
        return $this->age_rating;
    }

    public function setAgeRating(int $age_rating): static
    {
        $this->age_rating = $age_rating;

        return $this;
    }

    /**
     * @return Collection<int, Logging>
     */
    public function getLoggings(): Collection
    {
        return $this->loggings;
    }

    public function addLogging(Logging $logging): static
    {
        if (!$this->loggings->contains($logging)) {
            $this->loggings->add($logging);
            $logging->setApp($this);
        }

        return $this;
    }

    public function removeLogging(Logging $logging): static
    {
        if ($this->loggings->removeElement($logging)) {
            // set the owning side to null (unless already changed)
            if ($logging->getApp() === $this) {
                $logging->setApp(null);
            }
        }

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
            $viewing->setApp($this);
        }

        return $this;
    }

    public function removeViewing(Viewing $viewing): static
    {
        if ($this->viewings->removeElement($viewing)) {
            // set the owning side to null (unless already changed)
            if ($viewing->getApp() === $this) {
                $viewing->setApp(null);
            }
        }

        return $this;
    }

    /**
     * @return Collection<int, Child>
     */
    public function getChildren(): Collection
    {
        return $this->children;
    }

    public function addChild(Child $child): static
    {
        if (!$this->children->contains($child)) {
            $this->children->add($child);
        }

        return $this;
    }

    public function removeChild(Child $child): static
    {
        $this->children->removeElement($child);

        return $this;
    }
}

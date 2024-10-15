<?php

namespace App\Entity;

use App\Repository\DeviceRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: DeviceRepository::class)]
class Device
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 50)]
    private ?string $name = null;

    #[ORM\Column]
    private ?int $type = null;

    #[ORM\ManyToOne(inversedBy: 'devices')]
    #[ORM\JoinColumn(nullable: false)]
    private ?Child $child_id = null;

    /**
     * @var Collection<int, Logging>
     */
    #[ORM\OneToMany(targetEntity: Logging::class, mappedBy: 'device')]
    private Collection $app;

    public function __construct()
    {
        $this->app = new ArrayCollection();
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

    public function getType(): ?int
    {
        return $this->type;
    }

    public function setType(int $type): static
    {
        $this->type = $type;

        return $this;
    }

    public function getChildId(): ?Child
    {
        return $this->child_id;
    }

    public function setChildId(?Child $child_id): static
    {
        $this->child_id = $child_id;

        return $this;
    }

    /**
     * @return Collection<int, Logging>
     */
    public function getApp(): Collection
    {
        return $this->app;
    }

    public function addApp(Logging $app): static
    {
        if (!$this->app->contains($app)) {
            $this->app->add($app);
            $app->setDevice($this);
        }

        return $this;
    }

    public function removeApp(Logging $app): static
    {
        if ($this->app->removeElement($app)) {
            // set the owning side to null (unless already changed)
            if ($app->getDevice() === $this) {
                $app->setDevice(null);
            }
        }

        return $this;
    }
}

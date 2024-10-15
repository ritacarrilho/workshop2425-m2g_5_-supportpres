<?php

namespace App\Entity;

use App\Repository\UsageHistoryRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: UsageHistoryRepository::class)]
class UsageHistory
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(type: Types::DATE_MUTABLE)]
    private ?\DateTimeInterface $usage_date = null;

    #[ORM\Column(nullable: true)]
    private ?int $usage_time = null;

    /**
     * @var Collection<int, Logging>
     */
    #[ORM\OneToMany(targetEntity: Logging::class, mappedBy: 'history')]
    private Collection $loggings;

    public function __construct()
    {
        $this->loggings = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getUsageDate(): ?\DateTimeInterface
    {
        return $this->usage_date;
    }

    public function setUsageDate(\DateTimeInterface $usage_date): static
    {
        $this->usage_date = $usage_date;

        return $this;
    }

    public function getUsageTime(): ?int
    {
        return $this->usage_time;
    }

    public function setUsageTime(?int $usage_time): static
    {
        $this->usage_time = $usage_time;

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
            $logging->setHistory($this);
        }

        return $this;
    }

    public function removeLogging(Logging $logging): static
    {
        if ($this->loggings->removeElement($logging)) {
            // set the owning side to null (unless already changed)
            if ($logging->getHistory() === $this) {
                $logging->setHistory(null);
            }
        }

        return $this;
    }
}

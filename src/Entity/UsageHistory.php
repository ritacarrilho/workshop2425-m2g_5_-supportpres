<?php

namespace App\Entity;

use App\Repository\UsageHistoryRepository;
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
}

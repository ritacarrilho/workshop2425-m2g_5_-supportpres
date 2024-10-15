<?php

namespace App\Entity;

use App\Repository\LoggingRepository;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: LoggingRepository::class)]
class Logging
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column]
    private ?int $deviceId = null;

    #[ORM\Column]
    private ?int $appID = null;

    #[ORM\Column]
    private ?int $historyId = null;

    #[ORM\ManyToOne(inversedBy: 'app')]
    private ?Device $device = null;

    #[ORM\ManyToOne(inversedBy: 'loggings')]
    private ?Application $app = null;

    #[ORM\ManyToOne(inversedBy: 'loggings')]
    private ?UsageHistory $history = null;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getDeviceId(): ?int
    {
        return $this->deviceId;
    }

    public function setDeviceId(int $deviceId): static
    {
        $this->deviceId = $deviceId;

        return $this;
    }

    public function getAppID(): ?int
    {
        return $this->appID;
    }

    public function setAppID(int $appID): static
    {
        $this->appID = $appID;

        return $this;
    }

    public function getHistoryId(): ?int
    {
        return $this->historyId;
    }

    public function setHistoryId(int $historyId): static
    {
        $this->historyId = $historyId;

        return $this;
    }

    public function getDevice(): ?Device
    {
        return $this->device;
    }

    public function setDevice(?Device $device): static
    {
        $this->device = $device;

        return $this;
    }

    public function getApp(): ?Application
    {
        return $this->app;
    }

    public function setApp(?Application $app): static
    {
        $this->app = $app;

        return $this;
    }

    public function getHistory(): ?UsageHistory
    {
        return $this->history;
    }

    public function setHistory(?UsageHistory $history): static
    {
        $this->history = $history;

        return $this;
    }
}

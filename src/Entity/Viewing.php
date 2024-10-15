<?php

namespace App\Entity;

use App\Repository\ViewingRepository;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: ViewingRepository::class)]
class Viewing
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column]
    private ?int $childId = null;

    #[ORM\Column]
    private ?int $appId = null;

    #[ORM\Column]
    private ?int $contentId = null;

    #[ORM\ManyToOne(inversedBy: 'viewings')]
    private ?Child $child = null;

    #[ORM\ManyToOne(inversedBy: 'viewings')]
    private ?Application $app = null;

    #[ORM\ManyToOne(inversedBy: 'viewings')]
    private ?ViewedContent $content = null;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getChildId(): ?int
    {
        return $this->childId;
    }

    public function setChildId(int $childId): static
    {
        $this->childId = $childId;

        return $this;
    }

    public function getAppId(): ?int
    {
        return $this->appId;
    }

    public function setAppId(int $appId): static
    {
        $this->appId = $appId;

        return $this;
    }

    public function getContentId(): ?int
    {
        return $this->contentId;
    }

    public function setContentId(int $contentId): static
    {
        $this->contentId = $contentId;

        return $this;
    }

    public function getChild(): ?Child
    {
        return $this->child;
    }

    public function setChild(?Child $child): static
    {
        $this->child = $child;

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

    public function getContent(): ?ViewedContent
    {
        return $this->content;
    }

    public function setContent(?ViewedContent $content): static
    {
        $this->content = $content;

        return $this;
    }
}

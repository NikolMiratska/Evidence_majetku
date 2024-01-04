<?php

namespace App\Entity;

use App\Repository\UserHistoryRepository;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: UserHistoryRepository::class)]
class UserHistory
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 255, nullable: true)]
    private ?string $action = null;

    #[ORM\ManyToOne(inversedBy: 'history')]
    private ?AssetsManager $asset = null;

    #[ORM\Column(type: Types::DATETIME_MUTABLE, nullable: true)]
    private ?\DateTimeInterface $timestamp = null;

    #[ORM\ManyToOne(inversedBy: 'history')]
    private ?User $userName = null;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getAction(): ?string
    {
        return $this->action;
    }

    public function setAction(?string $action): static
    {
        $this->action = $action;

        return $this;
    }

    public function getAsset(): ?AssetsManager
    {
        return $this->asset;
    }

    public function setAsset(?AssetsManager $asset): static
    {
        $this->asset = $asset;

        return $this;
    }

    public function getTimestamp(): ?\DateTimeInterface
    {
        return $this->timestamp;
    }

    public function setTimestamp(?\DateTimeInterface $timestamp): static
    {
        $this->timestamp = $timestamp;

        return $this;
    }

    public function getUserName(): ?User
    {
        return $this->userName;
    }

    public function setUserName(?User $userName): static
    {
        $this->userName = $userName;

        return $this;
    }
}

<?php

namespace App\Entity;

use App\Repository\AssetTypeRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: AssetTypeRepository::class)]
class AssetType
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 255, nullable: true)]
    private ?string $type = null;

    #[ORM\OneToMany(mappedBy: 'typeAsset', targetEntity: AssetsManager::class)]
    private Collection $types;

    public function __construct()
    {
        $this->types = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getType(): ?string
    {
        return $this->type;
    }

    public function setType(?string $type): static
    {
        $this->type = $type;

        return $this;
    }

    /**
     * @return Collection<int, AssetsManager>
     */
    public function getTypes(): Collection
    {
        return $this->types;
    }

    public function addType(AssetsManager $type): static
    {
        if (!$this->types->contains($type)) {
            $this->types->add($type);
            $type->setTypeAsset($this);
        }

        return $this;
    }

    public function removeType(AssetsManager $type): static
    {
        if ($this->types->removeElement($type)) {
            // set the owning side to null (unless already changed)
            if ($type->getTypeAsset() === $this) {
                $type->setTypeAsset(null);
            }
        }

        return $this;
    }
    public function __toString()
    {
        return (string) $this->getType();
    }
}

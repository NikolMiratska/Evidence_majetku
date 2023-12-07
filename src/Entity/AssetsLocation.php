<?php

namespace App\Entity;

use App\Repository\AssetsLocationRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: AssetsLocationRepository::class)]
class AssetsLocation
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 255, nullable: true)]
    private ?string $location = null;

    #[ORM\OneToMany(mappedBy: 'locationAsset', targetEntity: AssetsManager::class)]
    private Collection $locations;

    public function __construct()
    {
        $this->locations = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getLocation(): ?string
    {
        return $this->location;
    }

    public function setLocation(?string $location): static
    {
        $this->location = $location;

        return $this;
    }

    /**
     * @return Collection<int, AssetsManager>
     */
    public function getLocations(): Collection
    {
        return $this->locations;
    }

    public function addLocation(AssetsManager $location): static
    {
        if (!$this->locations->contains($location)) {
            $this->locations->add($location);
            $location->setLocationAsset($this);
        }

        return $this;
    }

    public function removeLocation(AssetsManager $location): static
    {
        if ($this->locations->removeElement($location)) {
            // set the owning side to null (unless already changed)
            if ($location->getLocationAsset() === $this) {
                $location->setLocationAsset(null);
            }
        }

        return $this;
    }
    public function __toString()
    {
        return (string) $this->getLocation();
    }
}

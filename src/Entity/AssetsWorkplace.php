<?php

namespace App\Entity;

use App\Repository\AssetsWorkplaceRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: AssetsWorkplaceRepository::class)]
class AssetsWorkplace
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 255, unique: true, nullable: false)]
    private ?string $workplace = null;

    #[ORM\OneToMany(mappedBy: 'workplaceAsset', targetEntity: AssetsManager::class)]
    private Collection $workplaces;

    public function __construct()
    {
        $this->workplaces = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getWorkplace(): ?string
    {
        return $this->workplace;
    }

    public function setWorkplace(?string $workplace): static
    {
        $this->workplace = $workplace;

        return $this;
    }

    /**
     * @return Collection<int, AssetsManager>
     */
    public function getWorkplaces(): Collection
    {
        return $this->workplaces;
    }

    public function addWorkplace(AssetsManager $workplace): static
    {
        if (!$this->workplaces->contains($workplace)) {
            $this->workplaces->add($workplace);
            $workplace->setWorkplaceAsset($this);
        }

        return $this;
    }

    public function removeWorkplace(AssetsManager $workplace): static
    {
        if ($this->workplaces->removeElement($workplace)) {
            // set the owning side to null (unless already changed)
            if ($workplace->getWorkplaceAsset() === $this) {
                $workplace->setWorkplaceAsset(null);
            }
        }

        return $this;
    }
    public function __toString()
    {
        return (string) $this->getWorkplace();
    }
}

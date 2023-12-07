<?php

namespace App\Entity;

use App\Repository\AssetsCategoryRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: AssetsCategoryRepository::class)]
class AssetsCategory
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 255, nullable: true)]
    private ?string $category = null;

    #[ORM\OneToMany(mappedBy: 'categoryAsset', targetEntity: AssetsManager::class)]
    private Collection $categories;

    public function __construct()
    {
        $this->categories = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getCategory(): ?string
    {
        return $this->category;
    }

    public function setCategory(?string $category): static
    {
        $this->category = $category;

        return $this;
    }

    /**
     * @return Collection<int, AssetsManager>
     */
    public function getCategories(): Collection
    {
        return $this->categories;
    }

    public function addCategory(AssetsManager $category): static
    {
        if (!$this->categories->contains($category)) {
            $this->categories->add($category);
            $category->setCategoryAsset($this);
        }

        return $this;
    }

    public function removeCategory(AssetsManager $category): static
    {
        if ($this->categories->removeElement($category)) {
            // set the owning side to null (unless already changed)
            if ($category->getCategoryAsset() === $this) {
                $category->setCategoryAsset(null);
            }
        }

        return $this;
    }
    public function __toString()
    {
        return (string) $this->getCategory();
    }
}

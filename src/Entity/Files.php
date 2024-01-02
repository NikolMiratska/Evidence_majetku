<?php

namespace App\Entity;

use App\Repository\FilesRepository;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: FilesRepository::class)]
class Files
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 255, nullable: true)]
    private ?string $filename = null;

    #[ORM\ManyToOne(inversedBy: 'files')]
    private ?AssetsManager $filenames = null;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getFilename(): ?string
    {
        return $this->filename;
    }

    public function setFilename(?string $filename): static
    {
        $this->filename = $filename;

        return $this;
    }

    public function getFilenames(): ?AssetsManager
    {
        return $this->filenames;
    }

    public function setFilenames(?AssetsManager $filenames): static
    {
        $this->filenames = $filenames;

        return $this;
    }

//    public function __toString()
//    {
//        return (string) $this->getFilename();
//    }
}

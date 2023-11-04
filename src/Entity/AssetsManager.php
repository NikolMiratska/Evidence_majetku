<?php

namespace App\Entity;

use App\Repository\AssetsManagerRepository;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: AssetsManagerRepository::class)]
class AssetsManager
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 255)]
    private ?string $name = null;

    #[ORM\Column(length: 255)]
    private ?string $inventoryNumber = null;

    #[ORM\Column(type: Types::TEXT, nullable: true)]
    private ?string $description = null;

    #[ORM\Column]
    private ?float $unitPrice = null;

    #[ORM\Column(length: 255, nullable: true)]
    private ?string $supplier = null;

    #[ORM\Column(length: 255, nullable: true)]
    private ?string $manufacturer = null;

    #[ORM\Column(nullable: true)]
    private ?int $guaranteePeriod = null;

    #[ORM\Column(length: 255, nullable: true)]
    private ?string $assetType = null;

    #[ORM\Column(type: Types::DATE_MUTABLE, nullable: true)]
    private ?\DateTimeInterface $subsumptionDate = null;

    #[ORM\Column(type: Types::DATE_MUTABLE, nullable: true)]
    private ?\DateTimeInterface $eliminationDate = null;

    #[ORM\Column(length: 255, nullable: true)]
    private ?string $assetLocation = null;

    #[ORM\Column(length: 255, nullable: true)]
    private ?string $assignedPerson = null;

    #[ORM\Column(length: 255, nullable: true)]
    private ?string $manufacturingNumber = null;

    #[ORM\Column(type: Types::DATE_MUTABLE)]
    private ?\DateTimeInterface $dateCreated = null;

    #[ORM\Column(type: Types::TEXT, nullable: true)]
    private ?string $note = null;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getName(): ?string
    {
        return $this->name;
    }

    public function setName(string $name): static
    {
        $this->name = $name;

        return $this;
    }

    public function getInventoryNumber(): ?string
    {
        return $this->inventoryNumber;
    }

    public function setInventoryNumber(string $inventoryNumber): static
    {
        $this->inventoryNumber = $inventoryNumber;

        return $this;
    }

    public function getDescription(): ?string
    {
        return $this->description;
    }

    public function setDescription(?string $description): static
    {
        $this->description = $description;

        return $this;
    }

    public function getUnitPrice(): ?float
    {
        return $this->unitPrice;
    }

    public function setUnitPrice(float $unitPrice): static
    {
        $this->unitPrice = $unitPrice;

        return $this;
    }

    public function getSupplier(): ?string
    {
        return $this->supplier;
    }

    public function setSupplier(?string $supplier): static
    {
        $this->supplier = $supplier;

        return $this;
    }

    public function getManufacturer(): ?string
    {
        return $this->manufacturer;
    }

    public function setManufacturer(?string $manufacturer): static
    {
        $this->manufacturer = $manufacturer;

        return $this;
    }

    public function getGuaranteePeriod(): ?int
    {
        return $this->guaranteePeriod;
    }

    public function setGuaranteePeriod(?int $guaranteePeriod): static
    {
        $this->guaranteePeriod = $guaranteePeriod;

        return $this;
    }

    public function getAssetType(): ?string
    {
        return $this->assetType;
    }

    public function setAssetType(?string $assetType): static
    {
        $this->assetType = $assetType;

        return $this;
    }

    public function getSubsumptionDate(): ?\DateTimeInterface
    {
        return $this->subsumptionDate;
    }

    public function setSubsumptionDate(?\DateTimeInterface $subsumptionDate): static
    {
        $this->subsumptionDate = $subsumptionDate;

        return $this;
    }

    public function getEliminationDate(): ?\DateTimeInterface
    {
        return $this->eliminationDate;
    }

    public function setEliminationDate(?\DateTimeInterface $eliminationDate): static
    {
        $this->eliminationDate = $eliminationDate;

        return $this;
    }

    public function getAssetLocation(): ?string
    {
        return $this->assetLocation;
    }

    public function setAssetLocation(?string $assetLocation): static
    {
        $this->assetLocation = $assetLocation;

        return $this;
    }

    public function getAssignedPerson(): ?string
    {
        return $this->assignedPerson;
    }

    public function setAssignedPerson(?string $assignedPerson): static
    {
        $this->assignedPerson = $assignedPerson;

        return $this;
    }

    public function getManufacturingNumber(): ?string
    {
        return $this->manufacturingNumber;
    }

    public function setManufacturingNumber(?string $manufacturingNumber): static
    {
        $this->manufacturingNumber = $manufacturingNumber;

        return $this;
    }

    public function getDateCreated(): ?\DateTimeInterface
    {
        return $this->dateCreated;
    }

    public function setDateCreated(\DateTimeInterface $dateCreated): static
    {
        $this->dateCreated = $dateCreated;

        return $this;
    }

    public function getNote(): ?string
    {
        return $this->note;
    }

    public function setNote(?string $note): static
    {
        $this->note = $note;

        return $this;
    }
}

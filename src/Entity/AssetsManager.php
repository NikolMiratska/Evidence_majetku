<?php

namespace App\Entity;

use App\Repository\AssetsManagerRepository;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;
/**
 * @ORM\Entity
 * @invenotyNumber(fields={"uniqueField"}, message="This value is already in use.")
 */
#[ORM\Entity(repositoryClass: AssetsManagerRepository::class)]
class AssetsManager
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 255)]
    #[Assert\NotBlank]
    private ?string $name = null;

    /**
     * @ORM\Column(type="string", unique=true)
     */
    #[ORM\Column(length: 255,  unique: true, nullable: true)]
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

    #[ORM\Column(length: 255, nullable: true)]
    private ?string $documentPath = null;

    #[ORM\Column(type: Types::DATE_MUTABLE, nullable: true)]
    private ?\DateTimeInterface $dateBought = null;

    #[ORM\Column(type: Types::DATE_MUTABLE, nullable: true)]
    private ?\DateTimeInterface $dateReceived = null;

    #[ORM\Column(nullable: true)]
    private ?bool $eliminated = null;

    #[ORM\Column(length: 255, nullable: true)]
    private ?string $owner = null;

    #[ORM\Column(length: 255, nullable: true)]
    private ?string $category = null;

    #[ORM\Column(length: 255, nullable: true)]
    private ?string $workplace = null;

    #[ORM\Column(type: Types::TEXT, nullable: true)]
    private ?string $complaint = null;

    #[ORM\Column(type: Types::DATE_MUTABLE, nullable: true)]
    private ?\DateTimeInterface $nextServiceDue = null;

    #[ORM\Column(type: Types::TEXT, nullable: true)]
    private ?string $serviceInterval = null;

    #[ORM\Column(nullable: true)]
    private ?int $orderNumber = null;

    #[ORM\Column(length: 255, nullable: true)]
    private ?string $orderURL = null;

    #[ORM\ManyToOne(inversedBy: 'isOwnedBy')]
    private ?User $ownedBy = null;

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

    public function getDocumentPath(): ?string
    {
        return $this->documentPath;
    }

    public function setDocumentPath(?string $documentPath): static
    {
        $this->documentPath = $documentPath;

        return $this;
    }

    public function getDateBought(): ?\DateTimeInterface
    {
        return $this->dateBought;
    }

    public function setDateBought(?\DateTimeInterface $dateBought): static
    {
        $this->dateBought = $dateBought;

        return $this;
    }

    public function getDateReceived(): ?\DateTimeInterface
    {
        return $this->dateReceived;
    }

    public function setDateReceived(?\DateTimeInterface $dateReceived): static
    {
        $this->dateReceived = $dateReceived;

        return $this;
    }

    public function isEliminated(): ?bool
    {
        return $this->eliminated;
    }

    public function setEliminated(?bool $eliminated): static
    {
        $this->eliminated = $eliminated;

        return $this;
    }

    public function getOwner(): ?string
    {
        return $this->owner;
    }

    public function setOwner(?string $owner): static
    {
        $this->owner = $owner;

        return $this;
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

    public function getWorkplace(): ?string
    {
        return $this->workplace;
    }

    public function setWorkplace(?string $workplace): static
    {
        $this->workplace = $workplace;

        return $this;
    }

    public function getComplaint(): ?string
    {
        return $this->complaint;
    }

    public function setComplaint(?string $complaint): static
    {
        $this->complaint = $complaint;

        return $this;
    }

    public function getNextServiceDue(): ?\DateTimeInterface
    {
        return $this->nextServiceDue;
    }

    public function setNextServiceDue(?\DateTimeInterface $nextServiceDue): static
    {
        $this->nextServiceDue = $nextServiceDue;

        return $this;
    }

    public function getServiceInterval(): ?string
    {
        return $this->serviceInterval;
    }

    public function setServiceInterval(?string $serviceInterval): static
    {
        $this->serviceInterval = $serviceInterval;

        return $this;
    }

    public function getOrderNumber(): ?int
    {
        return $this->orderNumber;
    }

    public function setOrderNumber(?int $orderNumber): static
    {
        $this->orderNumber = $orderNumber;

        return $this;
    }

    public function getOrderURL(): ?string
    {
        return $this->orderURL;
    }

    public function setOrderURL(?string $orderURL): static
    {
        $this->orderURL = $orderURL;

        return $this;
    }

    public function getOwnedBy(): ?User
    {
        return $this->ownedBy;
    }

    public function setOwnedBy(?User $ownedBy): static
    {
        $this->ownedBy = $ownedBy;

        return $this;
    }
    public function getStringRepresentation1(): string
    {
        return (string) $this->getAssetType();
    }
    //.' '.$this->getAssetLocation().' '.$this->getWorkplace().' '.$this->getOwner().' '.$this->getCategory()
    public function getStringRepresentation2(): string
    {
        return (string) $this->getWorkplace();
    }
    public function __toString3(): string
    {
        return (string)$this->getAssetLocation();
    }
    public function __toString4(): string
    {
        return (string) $this->getOwner();
    }
    public function __toString()
    {
        return (string) $this->getAssetType().' '.$this->getAssetLocation().' '.$this->getWorkplace().' '.$this->getOwner().' '.$this->getCategory();
    }
    }

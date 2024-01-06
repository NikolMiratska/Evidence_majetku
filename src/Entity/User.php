<?php

namespace App\Entity;

use App\Repository\UserRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Bridge\Doctrine\Validator\Constraints\UniqueEntity;
use Symfony\Component\Security\Core\User\PasswordAuthenticatedUserInterface;
use Symfony\Component\Security\Core\User\UserInterface;

#[ORM\Entity(repositoryClass: UserRepository::class)]
#[ORM\Table(name: '`user`')]
#[UniqueEntity(fields: ['email'], message: 'There is already an account with this email')]
class User implements UserInterface, PasswordAuthenticatedUserInterface
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 180, unique: true, nullable: true)]
    private ?string $email = null;

    #[ORM\Column]
    private array $roles = [];

    /**
     * @var string The hashed password
     */
    #[ORM\Column(nullable: true)]
    private ?string $password = null;

    #[ORM\Column(length: 255, nullable: false)]
    private ?string $name = null;

    #[ORM\OneToMany(mappedBy: 'ownedBy', targetEntity: AssetsManager::class)]
    private Collection $isOwnedBy;

    #[ORM\Column(length: 255, nullable: true)]
    private ?string $profilePic = null;

    #[ORM\OneToMany(mappedBy: 'userName', targetEntity: UserHistory::class, cascade: ['persist'])]
    private Collection $history;

    #[ORM\Column(length: 255, nullable: true)]
    private ?string $historyLog = null;

    public function __construct()
    {
        $this->isOwnedBy = new ArrayCollection();
        $this->history = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getEmail(): ?string
    {
        return $this->email;
    }

    public function setEmail(string $email): static
    {
        $this->email = $email;

        return $this;
    }

    /**
     * A visual identifier that represents this user.
     *
     * @see UserInterface
     */
    public function getUserIdentifier(): string
    {
        return (string) $this->email;
    }

    /**
     * @see UserInterface
     */
    public function getRoles(): array
    {
        $roles = $this->roles;
        // guarantee every user at least has ROLE_USER
        $roles[] = 'ROLE_USER';

        return array_unique($roles);
    }

    public function setRoles(array $roles): static
    {
        $this->roles = $roles;

        return $this;
    }

    /**
     * @see PasswordAuthenticatedUserInterface
     */
    public function getPassword(): string
    {
        return $this->password;
    }

    public function setPassword(string $password): static
    {
        $this->password = $password;

        return $this;
    }

    /**
     * @see UserInterface
     */
    public function eraseCredentials(): void
    {
        // If you store any temporary, sensitive data on the user, clear it here
        // $this->plainPassword = null;
    }

    public function getName(): ?string
    {
        return $this->name;
    }

    public function setName(?string $name): static
    {
        $this->name = $name;

        return $this;
    }

    /**
     * @return Collection<int, AssetsManager>
     */
    public function getIsOwnedBy(): Collection
    {
        return $this->isOwnedBy;
    }

    public function addIsOwnedBy(AssetsManager $isOwnedBy): static
    {
        if (!$this->isOwnedBy->contains($isOwnedBy)) {
            $this->isOwnedBy->add($isOwnedBy);
            $isOwnedBy->setOwnedBy($this);
        }

        return $this;
    }

    public function removeIsOwnedBy(AssetsManager $isOwnedBy): static
    {
        if ($this->isOwnedBy->removeElement($isOwnedBy)) {
            // set the owning side to null (unless already changed)
            if ($isOwnedBy->getOwnedBy() === $this) {
                $isOwnedBy->setOwnedBy(null);
            }
        }

        return $this;
    }
    public function __toString()
    {
        return (string) $this->getName();
    }

    public function getProfilePic(): ?string
    {
        return $this->profilePic;
    }

    public function setProfilePic(?string $profilePic): static
    {
        $this->profilePic = $profilePic;

        return $this;
    }

    /**
     * @return Collection<int, UserHistory>
     */
    public function getHistory(): Collection
    {
        return $this->history;
    }

    public function addHistory(UserHistory $history): static
    {
        if (!$this->history->contains($history)) {
            $this->history->add($history);
            $history->setUserName($this);
        }

        return $this;
    }

    public function removeHistory(UserHistory $history): static
    {
        if ($this->history->removeElement($history)) {
            // set the owning side to null (unless already changed)
            if ($history->getUserName() === $this) {
                $history->setUserName(null);
            }
        }

        return $this;
    }

    public function getHistoryLog(): ?string
    {
        return $this->historyLog;
    }

    public function setHistoryLog(?string $historyLog): static
    {
        $this->historyLog = $historyLog;

        return $this;
    }

    public function appendLog(string $log): void {
        $this->historyLog = $this->historyLog . PHP_EOL . $log;
    }
}

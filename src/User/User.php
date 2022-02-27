<?php /** @noinspection PhpPropertyOnlyWrittenInspection */

namespace App\User;

use App\Common\Entity\HasId;
use App\Notification\NotificationRegion;
use Doctrine\ORM\Mapping as ORM;
use JetBrains\PhpStorm\Pure;
use Symfony\Component\Security\Core\User\PasswordAuthenticatedUserInterface;
use Symfony\Component\Security\Core\User\UserInterface;

#[ORM\Entity(repositoryClass: UserRepository::class)]
#[ORM\Table(name: "users")]
class User implements UserInterface, PasswordAuthenticatedUserInterface
{
    use HasId;

    #[ORM\Column(type: 'string', length: 180, unique: true)]
    private ?string $email;

    #[ORM\Column(type: 'string')]
    private string $password;

    private ?string $plainPassword = null;

    #[ORM\Column(type: 'array', nullable: false)]
    private array $roles = [];

    #[Pure] public function __construct()
    {
    }

    public function getUserIdentifier(): string
    {
        return (string)$this->email;
    }

    public function getUsername(): string
    {
        return (string)$this->email;
    }

    public function getEmail(): ?string
    {
        return $this->email;
    }

    public function setEmail(?string $email): void
    {
        $this->email = $email;
    }

    public function getPassword(): string
    {
        return $this->password;
    }

    public function setPassword(string $password): self
    {
        $this->password = $password;

        return $this;
    }

    public function getPlainPassword(): ?string
    {
        return $this->plainPassword;
    }

    public function setPlainPassword(?string $plainPassword): void
    {
        $this->plainPassword = $plainPassword;
    }

    public function getSalt(): ?string
    {
        return null;
    }

    public function eraseCredentials(): void
    {
    }

    public function getAllowedRegions(): array
    {
        return collect(NotificationRegion::instances())
            ->filter(fn(NotificationRegion $region) => $this->isAllowed($region))
            ->all();
    }

    #[Pure] public function isAllowed(NotificationRegion $region): bool
    {
        return $this->hasRole(Role::forRegion($region)) ||
            $this->hasRole(Role::ROLE_SUPER_ADMIN) ||
            $this->hasRole(Role::ROLE_ALL_REGIONS);
    }

    #[Pure] private function hasRole(string $admin): bool
    {
        return array_search($admin, $this->getRoles()) !== false;
    }

    public function getRoles(): array
    {
        return $this->roles;
    }

    public function setRoles(array $roles): void
    {
        $this->roles = $roles;
    }

    #[Pure] public function __toString(): string
    {
        return $this->email;
    }
}

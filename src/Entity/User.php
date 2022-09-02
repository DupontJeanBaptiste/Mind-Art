<?php

namespace App\Entity;

use App\Repository\UserRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;
use phpDocumentor\Reflection\Types\Boolean;
use Symfony\Bridge\Doctrine\Validator\Constraints\UniqueEntity;
use Symfony\Component\Security\Core\User\PasswordAuthenticatedUserInterface;
use Symfony\Component\Security\Core\User\UserInterface;

#[ORM\Entity(repositoryClass: UserRepository::class)]
#[UniqueEntity(fields: ['email'], message: 'There is already an account with this email')]
class User implements UserInterface, PasswordAuthenticatedUserInterface
{
    /**
     * @var int
     */
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column(type: 'integer')]
    private $id;

    /**
     * @var string
     */
    #[ORM\Column(type: 'string', length: 180, unique: true)]
    private $email;

    /**
     * @var array
     */
    #[ORM\Column(type: 'array')]
    private $roles = [];

    /**
     * @var string
     */
    #[ORM\Column(type: 'string')]
    private $password;

    /**
     * @var string
     */
    #[ORM\Column(type: 'string', length: 150)]
    private $lastname;

    /**
     * @var string
     */
    #[ORM\Column(type: 'string', length: 150)]
    private $firstname;

    /**
     * @var string
     */
    #[ORM\Column(type: 'string', length: 150, nullable: true)]
    private $pseudo;

    /**
     * @var string
     */
    #[ORM\Column(type: 'string', length: 150)]
    private $phone;

    /**
     * @var string
     */
    #[ORM\Column(type: 'text', nullable: true)]
    private $biography;

    /**
     * @var object
     */
    #[ORM\OneToMany(mappedBy: 'user', targetEntity: Masterpiece::class, orphanRemoval: true)]
    private $masterpiece;

    /**
     * @var object
     */
    #[ORM\OneToMany(mappedBy: 'user', targetEntity: Comment::class, orphanRemoval: true)]
    private $comment;

    /**
     * @var object
     */
    #[ORM\ManyToOne(targetEntity: Subscription::class, inversedBy: 'users')]
    #[ORM\JoinColumn(nullable: true)]
    private $subscription;

    /**
     * @var object
     */
    #[ORM\OneToMany(mappedBy: 'user', targetEntity: Parameters::class)]
    private $parameters;

    /**
     * @var object
     */
    #[ORM\OneToMany(mappedBy: 'user', targetEntity: Basket::class)]
    private $basket;

    /**
     * @var boolean
     */
    #[ORM\Column(type: 'boolean')]
    private $isVerified = false;

    /**
     * @var object
     */
    #[ORM\ManyToMany(targetEntity: Masterpiece::class, inversedBy: 'likers')]
    #[ORM\JoinTable(name:'user_masterpiece')]
    private $likelist;

    public function __construct()
    {
        $this->masterpiece = new ArrayCollection();
        $this->comment = new ArrayCollection();
        $this->parameters = new ArrayCollection();
        $this->basket = new ArrayCollection();
        $this->likelist = new ArrayCollection();
    }




    public function getId(): ?int
    {
        return $this->id;
    }

    public function getEmail(): ?string
    {
        return $this->email;
    }

    public function setEmail(string $email): self
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

    public function setRoles(array $roles): self
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

    public function setPassword(string $password): self
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



    public function getLastname(): ?string
    {
        return $this->lastname;
    }

    public function setLastname(string $lastname): self
    {
        $this->lastname = $lastname;

        return $this;
    }

    public function getFirstname(): ?string
    {
        return $this->firstname;
    }

    public function setFirstname(string $firstname): self
    {
        $this->firstname = $firstname;

        return $this;
    }

    public function getPseudo(): ?string
    {
        return $this->pseudo;
    }

    public function setPseudo(?string $pseudo): self
    {
        $this->pseudo = $pseudo;

        return $this;
    }

    public function getPhone(): ?string
    {
        return $this->phone;
    }

    public function setPhone(string $phone): self
    {
        $this->phone = $phone;

        return $this;
    }

    public function getBiography(): ?string
    {
        return $this->biography;
    }

    public function setBiography(?string $biography): self
    {
        $this->biography = $biography;

        return $this;
    }

    /**
     * @return Collection<int, Masterpiece>
     */
    public function getMasterpiece(): Collection
    {
        return $this->masterpiece;
    }

    public function addMasterpiece(Masterpiece $masterpiece): self
    {
        if (!$this->masterpiece->contains($masterpiece)) {
            $this->masterpiece[] = $masterpiece;
            $masterpiece->setUser($this);
        }

        return $this;
    }

    public function removeMasterpiece(Masterpiece $masterpiece): self
    {
        if ($this->masterpiece->removeElement($masterpiece)) {
            // set the owning side to null (unless already changed)
            if ($masterpiece->getUser() === $this) {
                $masterpiece->setUser(null);
            }
        }

        return $this;
    }

    /**
     * @return Collection<int, Comment>
     */
    public function getComment(): Collection
    {
        return $this->comment;
    }

    public function addComment(Comment $comment): self
    {
        if (!$this->comment->contains($comment)) {
            $this->comment[] = $comment;
            $comment->setUser($this);
        }

        return $this;
    }

    public function removeComment(Comment $comment): self
    {
        if ($this->comment->removeElement($comment)) {
            // set the owning side to null (unless already changed)
            if ($comment->getUser() === $this) {
                $comment->setUser(null);
            }
        }

        return $this;
    }

    public function getSubscription(): ?Subscription
    {
        return $this->subscription;
    }

    public function setSubscription(?Subscription $subscription): self
    {
        $this->subscription = $subscription;

        return $this;
    }

    /**
     * @return Collection<int, Parameters>
     */
    public function getParameters(): Collection
    {
        return $this->parameters;
    }

    public function addParameter(Parameters $parameter): self
    {
        if (!$this->parameters->contains($parameter)) {
            $this->parameters[] = $parameter;
            $parameter->setUser($this);
        }

        return $this;
    }

    public function removeParameter(Parameters $parameter): self
    {
        if ($this->parameters->removeElement($parameter)) {
            // set the owning side to null (unless already changed)
            if ($parameter->getUser() === $this) {
                $parameter->setUser(null);
            }
        }

        return $this;
    }

    /**
     * @return Collection<int, Basket>
     */
    public function getBasket(): Collection
    {
        return $this->basket;
    }

    public function addBasket(Basket $basket): self
    {
        if (!$this->basket->contains($basket)) {
            $this->basket[] = $basket;
            $basket->setUser($this);
        }

        return $this;
    }

    public function removeBasket(Basket $basket): self
    {
        if ($this->basket->removeElement($basket)) {
            // set the owning side to null (unless already changed)
            if ($basket->getUser() === $this) {
                $basket->setUser(null);
            }
        }

        return $this;
    }

    public function isVerified(): bool
    {
        return $this->isVerified;
    }

    public function setIsVerified(bool $isVerified): self
    {
        $this->isVerified = $isVerified;

        return $this;
    }

    /**
     * @return Collection<int, Masterpiece>
     */
    public function getLikelist(): Collection
    {
        return $this->likelist;
    }

    public function addToLikelist(Masterpiece $masterpiece): self
    {
        if (!$this->likelist->contains($masterpiece)) {
            $this->likelist[] = $masterpiece;
        }

        return $this;
    }

    public function isInLikelist(Masterpiece $masterpiece): bool
    {
        if (!$this->likelist->contains($masterpiece)) {
            return false;
        } else {
            return true;
        }
    }

    public function removeFromLikelist(Masterpiece $masterpiece): self
    {
        $this->likelist->removeElement($masterpiece);

        return $this;
    }
}

<?php

namespace App\Entity;

use App\Repository\MasterpieceRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: MasterpieceRepository::class)]
class Masterpiece
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
    #[ORM\Column(type: 'string', length: 255)]
    private $name;

    /**
     * @var float
     */
    #[ORM\Column(type: 'float')]
    private $price;

    /**
     * @var string
     */
    #[ORM\Column(type: 'text', nullable: true)]
    private $description;

    /**
     * @var bool
     */
    #[ORM\Column(type: 'boolean')]
    private $display;

    /**
     * @var string
     */
    #[ORM\Column(type: 'string', length: 255)]
    private $status;

    /**
     * @var string
     */
    #[ORM\Column(type: 'string', length: 255, nullable: true)]
    private $picture;

    /**
     * @var object
     */
    #[ORM\ManyToOne(targetEntity: User::class, inversedBy: 'masterpiece')]
    #[ORM\JoinColumn(nullable: false)]
    private $user;

    /**
     * @var object
     */
    #[ORM\OneToMany(mappedBy: 'masterpiece', targetEntity: Comment::class)]
    private $comment;

    /**
     * @var object
     */
    #[ORM\OneToMany(mappedBy: 'masterpiece', targetEntity: Basket::class)]
    private $baskets;

    /**
     * @var object
     */
    #[ORM\ManyToMany(targetEntity: User::class, mappedBy: 'likelist')]
    private $likers;



    public function __construct()
    {
        $this->comment = new ArrayCollection();
        $this->baskets = new ArrayCollection();
        $this->likers = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getName(): ?string
    {
        return $this->name;
    }

    public function setName(string $name): self
    {
        $this->name = $name;

        return $this;
    }

    public function getPrice(): ?float
    {
        return $this->price;
    }

    public function setPrice(float $price): self
    {
        $this->price = $price;

        return $this;
    }

    public function getDescription(): ?string
    {
        return $this->description;
    }

    public function setDescription(?string $description): self
    {
        $this->description = $description;

        return $this;
    }

    public function isDisplay(): ?bool
    {
        return $this->display;
    }

    public function setDisplay(bool $display): self
    {
        $this->display = $display;

        return $this;
    }

    public function getStatus(): ?string
    {
        return $this->status;
    }

    public function setStatus(string $status): self
    {
        $this->status = $status;

        return $this;
    }

    public function getPicture(): ?string
    {
        return $this->picture;
    }

    public function setPicture(?string $picture): self
    {
        $this->picture = $picture;

        return $this;
    }

    public function getUser(): ?User
    {
        return $this->user;
    }

    public function setUser(?User $user): self
    {
        $this->user = $user;

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
            $comment->setMasterpiece($this);
        }

        return $this;
    }

    public function removeComment(Comment $comment): self
    {
        if ($this->comment->removeElement($comment)) {
            // set the owning side to null (unless already changed)
            if ($comment->getMasterpiece() === $this) {
                $comment->setMasterpiece(null);
            }
        }

        return $this;
    }

    /**
     * @return Collection<int, Basket>
     */
    public function getBaskets(): Collection
    {
        return $this->baskets;
    }

    public function addBasket(Basket $basket): self
    {
        if (!$this->baskets->contains($basket)) {
            $this->baskets[] = $basket;
            $basket->setMasterpiece($this);
        }

        return $this;
    }

    public function removeBasket(Basket $basket): self
    {
        if ($this->baskets->removeElement($basket)) {
            // set the owning side to null (unless already changed)
            if ($basket->getMasterpiece() === $this) {
                $basket->setMasterpiece(null);
            }
        }

        return $this;
    }

    /**
     * @return Collection<int, User>
     */
    public function getLikers(): Collection
    {
        return $this->likers;
    }

    public function addLiker(User $liker): self
    {
        if (!$this->likers->contains($liker)) {
            $this->likers[] = $liker;
            $liker->addToLikelist($this);
        }

        return $this;
    }

    public function removeLiker(User $liker): self
    {
        if ($this->likers->removeElement($liker)) {
            $liker->removeFromLikelist($this);
        }

        return $this;
    }
}

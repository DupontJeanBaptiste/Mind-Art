<?php

namespace App\Entity;

use App\Repository\CommentRepository;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: CommentRepository::class)]
class Comment
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
    #[ORM\Column(type: 'text')]
    private $comment;

    /**
     * @var object
     */
    #[ORM\ManyToOne(targetEntity: User::class, inversedBy: 'comment')]
    #[ORM\JoinColumn(nullable: false)]
    private $user;

    /**
     * @var object
     */
    #[ORM\ManyToOne(targetEntity: Masterpiece::class, inversedBy: 'comment')]
    private $masterpiece;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getComment(): ?string
    {
        return $this->comment;
    }

    public function setComment(string $comment): self
    {
        $this->comment = $comment;

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

    public function getMasterpiece(): ?Masterpiece
    {
        return $this->masterpiece;
    }

    public function setMasterpiece(?Masterpiece $masterpiece): self
    {
        $this->masterpiece = $masterpiece;

        return $this;
    }
}

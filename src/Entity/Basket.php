<?php

namespace App\Entity;

use App\Repository\BasketRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: BasketRepository::class)]
class Basket
{
    /**
     * @var int
     */
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column(type: 'integer')]
    private $id;

    /**
     * @var bool
     */
    #[ORM\Column(type: 'boolean')]
    private $validation;


    /**
     * @var string
     */
    #[ORM\Column(type: 'string', length: 255)]
    private $status;


    /**
     * @var object
     */
    #[ORM\OneToMany(mappedBy: 'basket', targetEntity: Order::class)]
    private $myOrder;


    /**
     * @var object
     */
    #[ORM\ManyToOne(targetEntity: User::class, inversedBy: 'basket')]
    private $user;

    /**
     * @var object
     */
    #[ORM\ManyToOne(targetEntity: Masterpiece::class, inversedBy: 'baskets')]
    #[ORM\JoinColumn(nullable: false)]
    private $masterpiece;

    public function __construct()
    {
        $this->myOrder = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function isValidation(): ?bool
    {
        return $this->validation;
    }

    public function setValidation(bool $validation): self
    {
        $this->validation = $validation;

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



    /**
     * @return Collection<int, Order>
     */
    public function getMyOrder(): Collection
    {
        return $this->myOrder;
    }

    public function addMyOrder(Order $myOrder): self
    {
        if (!$this->myOrder->contains($myOrder)) {
            $this->myOrder[] = $myOrder;
            $myOrder->setBasket($this);
        }

        return $this;
    }

    public function removeMyOrder(Order $myOrder): self
    {
        if ($this->myOrder->removeElement($myOrder)) {
            // set the owning side to null (unless already changed)
            if ($myOrder->getBasket() === $this) {
                $myOrder->setBasket(null);
            }
        }

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

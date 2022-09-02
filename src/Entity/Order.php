<?php

namespace App\Entity;

use App\Repository\OrderRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: OrderRepository::class)]
#[ORM\Table(name: '`order`')]
class Order
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
    private $expedition;

    /**
     * @var bool
     */
    #[ORM\Column(type: 'boolean')]
    private $reception;

    /**
     * @var object
     */
    #[ORM\ManyToOne(targetEntity: Basket::class, inversedBy: 'MyOrder')]
    private $basket;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function isExpedition(): ?bool
    {
        return $this->expedition;
    }

    public function setExpedition(bool $expedition): self
    {
        $this->expedition = $expedition;

        return $this;
    }

    public function isReception(): ?bool
    {
        return $this->reception;
    }

    public function setReception(bool $reception): self
    {
        $this->reception = $reception;

        return $this;
    }

    public function getBasket(): ?Basket
    {
        return $this->basket;
    }

    public function setBasket(?Basket $basket): self
    {
        $this->basket = $basket;

        return $this;
    }
}

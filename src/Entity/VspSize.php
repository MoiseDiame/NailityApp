<?php

namespace App\Entity;

use App\Repository\VspSizeRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=VspSizeRepository::class)
 */
class VspSize
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $size;

    /**
     * @ORM\OneToOne(targetEntity=VspPrice::class, mappedBy="size", cascade={"persist", "remove"})
     */
    private $vspPrice;


    /**
     * @ORM\OneToMany(targetEntity=Product::class, mappedBy="VspSize")
     */
    private $products;

    public function __construct()
    {
        $this->products = new ArrayCollection();
    }

    public function __toString()
    {
        return $this->size;
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getSize(): ?string
    {
        return $this->size;
    }

    public function setSize(string $size): self
    {
        $this->size = $size;

        return $this;
    }

    public function getVspPrice(): ?VspPrice
    {
        return $this->vspPrice;
    }

    public function setVspPrice(?VspPrice $vspPrice): self
    {
        // unset the owning side of the relation if necessary
        if ($vspPrice === null && $this->vspPrice !== null) {
            $this->vspPrice->setSize(null);
        }

        // set the owning side of the relation if necessary
        if ($vspPrice !== null && $vspPrice->getSize() !== $this) {
            $vspPrice->setSize($this);
        }

        $this->vspPrice = $vspPrice;

        return $this;
    }


    /**
     * @return Collection<int, Product>
     */
    public function getProducts(): Collection
    {
        return $this->products;
    }

    public function addProduct(Product $product): self
    {
        if (!$this->products->contains($product)) {
            $this->products[] = $product;
            $product->setVspSize($this);
        }

        return $this;
    }

    public function removeProduct(Product $product): self
    {
        if ($this->products->removeElement($product)) {
            // set the owning side to null (unless already changed)
            if ($product->getVspSize() === $this) {
                $product->setVspSize(null);
            }
        }

        return $this;
    }
}

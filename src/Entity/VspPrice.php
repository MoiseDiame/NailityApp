<?php

namespace App\Entity;

use App\Repository\VspPriceRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=VspPriceRepository::class)
 */
class VspPrice
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\OneToOne(targetEntity=VspSize::class, inversedBy="vspPrice", cascade={"persist", "remove"})
     */
    private $size;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $Price;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $priceFor5;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $priceFor10;

    /**
     * @ORM\OneToMany(targetEntity=Product::class, mappedBy="VspPrice")
     */
    private $products;

    public function __construct()
    {
        $this->products = new ArrayCollection();
    }

    public function __toString()
    {
        return $this->Price;
        return $this->priceFor5;
        return $this->priceFor10;
    }


    public function getId(): ?int
    {
        return $this->id;
    }

    public function getSize(): ?VspSize
    {
        return $this->size;
    }

    public function setSize(?VspSize $size): self
    {
        $this->size = $size;

        return $this;
    }

    public function getPrice(): ?string
    {
        return $this->Price;
    }

    public function setPrice(string $Price): self
    {
        $this->Price = $Price;

        return $this;
    }

    public function getPriceFor5(): ?string
    {
        return $this->priceFor5;
    }

    public function setPriceFor5(string $priceFor5): self
    {
        $this->priceFor5 = $priceFor5;

        return $this;
    }

    public function getPriceFor10(): ?string
    {
        return $this->priceFor10;
    }

    public function setPriceFor10(string $priceFor10): self
    {
        $this->priceFor10 = $priceFor10;

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
            $product->setVspPrice($this);
        }

        return $this;
    }

    public function removeProduct(Product $product): self
    {
        if ($this->products->removeElement($product)) {
            // set the owning side to null (unless already changed)
            if ($product->getVspPrice() === $this) {
                $product->setVspPrice(null);
            }
        }

        return $this;
    }
}

<?php

namespace App\Entity;

use App\Repository\ProductRepository;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=ProductRepository::class)
 */
class Product
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
    private $name;

    /**
     * @ORM\ManyToOne(targetEntity=ProductCategory::class, inversedBy="products")
     * @ORM\JoinColumn(nullable=false)
     */
    private $category;

    /**
     * @ORM\Column(type="text")
     */
    private $description;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $presentation_pic;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $illustration_pic1;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $illustration_pic2;

    /**
     * @ORM\ManyToOne(targetEntity=ProductAvailablity::class, inversedBy="products")
     * @ORM\JoinColumn(nullable=false)
     */
    private $availablity;

    /**
     * @ORM\Column(type="date")
     */
    private $created_at;

    /**
     * @ORM\Column(type="boolean")
     */
    private $new;


    /**
     * @ORM\Column(type="float", nullable=true)
     */
    private $price;

    /**
     * @ORM\Column(type="boolean")
     */
    private $best;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $slug;

    /**
     * @ORM\Column(type="float", nullable=true)
     */
    private $weight;

    /**
     * @ORM\ManyToOne(targetEntity=VspColor::class, inversedBy="products",cascade={"remove"})
     */
    private $VspColor;

    /**
     * @ORM\ManyToOne(targetEntity=VspSize::class, inversedBy="products")
     */
    private $VspSize;

    /**
     * @ORM\ManyToOne(targetEntity=VspPrice::class, inversedBy="products")
     */
    private $VspPrice;

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

    public function getCategory(): ?ProductCategory
    {
        return $this->category;
    }

    public function setCategory(?ProductCategory $category): self
    {
        $this->category = $category;

        return $this;
    }

    public function getDescription(): ?string
    {
        return $this->description;
    }

    public function setDescription(string $description): self
    {
        $this->description = $description;

        return $this;
    }

    public function getPresentationPic(): ?string
    {
        return $this->presentation_pic;
    }

    public function setPresentationPic(string $presentation_pic): self
    {
        $this->presentation_pic = $presentation_pic;

        return $this;
    }

    public function getIllustrationPic1(): ?string
    {
        return $this->illustration_pic1;
    }

    public function setIllustrationPic1(?string $illustration_pic1): self
    {
        $this->illustration_pic1 = $illustration_pic1;

        return $this;
    }

    public function getIllustrationPic2(): ?string
    {
        return $this->illustration_pic2;
    }

    public function setIllustrationPic2(?string $illustration_pic2): self
    {
        $this->illustration_pic2 = $illustration_pic2;

        return $this;
    }

    public function getAvailablity(): ?ProductAvailablity
    {
        return $this->availablity;
    }

    public function setAvailablity(?ProductAvailablity $availablity): self
    {
        $this->availablity = $availablity;

        return $this;
    }

    public function getCreatedAt(): ?\DateTimeInterface
    {
        return $this->created_at;
    }

    public function setCreatedAt(\DateTimeInterface $created_at): self
    {
        $this->created_at = $created_at;

        return $this;
    }

    public function isNew(): ?bool
    {
        return $this->new;
    }

    public function setNew(bool $new): self
    {
        $this->new = $new;

        return $this;
    }


    public function getPrice(): ?float
    {
        return $this->price;
    }

    public function setPrice(?float $price): self
    {
        $this->price = $price;

        return $this;
    }

    public function isBest(): ?bool
    {
        return $this->best;
    }

    public function setBest(bool $best): self
    {
        $this->best = $best;

        return $this;
    }

    public function getSlug(): ?string
    {
        return $this->slug;
    }

    public function setSlug(string $slug): self
    {
        $this->slug = $slug;

        return $this;
    }

    public function getWeight(): ?float
    {
        return $this->weight;
    }

    public function setWeight(?float $weight): self
    {
        $this->weight = $weight;

        return $this;
    }

    public function getVspColor(): ?VspColor
    {
        return $this->VspColor;
    }

    public function setVspColor(?VspColor $VspColor): self
    {
        $this->VspColor = $VspColor;

        return $this;
    }

    public function getVspSize(): ?VspSize
    {
        return $this->VspSize;
    }

    public function setVspSize(?VspSize $VspSize): self
    {
        $this->VspSize = $VspSize;

        return $this;
    }

    public function getVspPrice(): ?VspPrice
    {
        return $this->VspPrice;
    }

    public function setVspPrice(?VspPrice $VspPrice): self
    {
        $this->VspPrice = $VspPrice;

        return $this;
    }
}

<?php

namespace App\Entity;

use App\Repository\VspRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=VspRepository::class)
 */
class Vsp
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
     * @ORM\Column(type="text", nullable=true)
     */
    private $description;

    /**
     * @ORM\Column(type="boolean", nullable=true)
     */
    private $new;

    /**
     * @ORM\Column(type="date")
     */
    private $created_at;

    /**
     * @ORM\ManyToOne(targetEntity=ProductAvailablity::class, inversedBy="vsps")
     */
    private $availablity;

    /**
     * @ORM\ManyToOne(targetEntity=VspColor::class, inversedBy="vsps")
     */
    private $color;


    /**
     * @ORM\Column(type="string", length=255)
     */
    private $slug;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $presentation_picture;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $illustration_picture1;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $illustration_picture2;



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

    public function getDescription(): ?string
    {
        return $this->description;
    }

    public function setDescription(?string $description): self
    {
        $this->description = $description;

        return $this;
    }

    public function isNew(): ?bool
    {
        return $this->new;
    }

    public function setNew(?bool $new): self
    {
        $this->new = $new;

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

    public function getAvailablity(): ?ProductAvailablity
    {
        return $this->availablity;
    }

    public function setAvailablity(?ProductAvailablity $availablity): self
    {
        $this->availablity = $availablity;

        return $this;
    }

    public function getColor(): ?VspColor
    {
        return $this->color;
    }

    public function setColor(?VspColor $color): self
    {
        $this->color = $color;

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

    public function getPresentationPicture(): ?string
    {
        return $this->presentation_picture;
    }

    public function setPresentationPicture(string $presentation_picture): self
    {
        $this->presentation_picture = $presentation_picture;

        return $this;
    }

    public function getIllustrationPicture1(): ?string
    {
        return $this->illustration_picture1;
    }

    public function setIllustrationPicture1(?string $illustration_picture1): self
    {
        $this->illustration_picture1 = $illustration_picture1;

        return $this;
    }

    public function getIllustrationPicture2(): ?string
    {
        return $this->illustration_picture2;
    }

    public function setIllustrationPicture2(?string $illustration_picture2): self
    {
        $this->illustration_picture2 = $illustration_picture2;

        return $this;
    }
}

<?php

declare(strict_types=1);

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;
use Doctrine\Common\Collections\Collection;
use App\AbstractEntity;

/**
 * @ORM\Entity
 * @ORM\Table(name="product")
 */
class Product extends AbstractEntity
{
    /**
     * @ORM\Id
     * @ORM\Column(name="id", type="integer")
     * @ORM\GeneratedValue(strategy="AUTO")
     * @var int
     */
    protected $id;

    /**
     * @ORM\Column(name="name", type="string", length=255)
     * @var string
     */
    protected $name;

    /**
     * @ORM\Column(name="description", type="text")
     * @var string
     */
    protected $description;

    /**
     * @ORM\Column(name="available", type="integer")
     * @var integer
     */
    protected $available;

    /**
     * @ORM\Column(name="sort", type="integer");
     *
     * @var integer
     */
    protected $sort;

    /**
     * @ORM\Column(name="price", type="decimal", precision=10, scale=2)
     *
     * @var float
     */
    protected $basePrice;

    /**
     * @var Collection
     *
     * @ORM\OneToMany(targetEntity="ProductImage", mappedBy="product")
     **
     */
    protected $images;

    /**
     * @var Collection
     *
     * @ORM\OneToMany(targetEntity="ProductVariant", mappedBy="product")
     **
     */
    protected $variants;

    /**
     * @return int
     */
    public function getId(): int
    {
        return $this->id;
    }

    /**
     * @param int $id
     */
    public function setId(int $id)
    {
        $this->id = $id;
    }

    /**
     * @return string
     */
    public function getName(): string
    {
        return $this->name;
    }

    /**
     * @param string $name
     */
    public function setName(string $name)
    {
        $this->name = $name;
    }

    /**
     * @return string
     */
    public function getDescription(): string
    {
        return $this->description;
    }

    /**
     * @param string $description
     */
    public function setDescription(string $description)
    {
        $this->description = $description;
    }

    /**
     * @return int
     */
    public function getAvailable() : int
    {
        return $this->available;
    }

    /**
     * @param int $available
     */
    public function setAvailable(int $available)
    {
        $this->available = $available;
    }

    /**
     * @return int
     */
    public function getSort(): int
    {
        return $this->sort;
    }

    /**
     * @param int $sort
     */
    public function setSort(int $sort)
    {
        $this->sort = $sort;
    }

    /**
     * @return mixed
     */
    public function getBasePrice()
    {
        return $this->basePrice;
    }

    /**
     * @param mixed $basePrice
     */
    public function setBasePrice($basePrice)
    {
        $this->basePrice = $basePrice;
    }

    /**
     * @return Collection
     */
    public function getImages(): Collection
    {
        return $this->images;
    }

    /**
     * @param Collection $images
     */
    public function setImages(Collection $images)
    {
        $this->images = $images;
    }

    /**
     * @return Collection
     */
    public function getVariants(): Collection
    {
        return $this->variants;
    }

    /**
     * @param Collection $variants
     */
    public function setVariants(Collection $variants)
    {
        $this->variants = $variants;
    }

    /**
     * Own array copy to include image associations
     *
     * @return array
     */
    public function getArrayCopy(): array
    {
        $arrayCopy = parent::getArrayCopy();

        $images = array_map(
            function(ProductImage $obj) {
                return $obj->getArrayCopy();
            },
            $this->getImages()->toArray()
        );

        $variants = array_map(
            function(ProductVariant $obj) {
                return $obj->getArrayCopy();
            },
            $this->getVariants()->toArray()
        );

        $arrayCopy['images'] = $images;
        $arrayCopy['variants'] = $variants;

        return $arrayCopy;
    }
}

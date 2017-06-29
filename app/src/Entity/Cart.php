<?php

declare(strict_types=1);

namespace App\Entity;

use App\AbstractEntity;
use Doctrine\ORM\Mapping as ORM;
use Doctrine\Common\Collections\Collection;

/**
 * Class ShoppingCart
 *
 * @ORM\Entity
 * @ORM\Table(name="shopping_cart", uniqueConstraints={@ORM\UniqueConstraint(name="unique_key", columns={"cart_key"})})
 */
class Cart extends AbstractEntity
{
    /**
     * @ORM\Id
     * @ORM\Column(name="id", type="integer")
     * @ORM\GeneratedValue(strategy="AUTO")
     * @var int
     */
    protected $id;

    /**
     * @ORM\Column(name="cart_key", type="string", length=50)
     *
     * @var string
     */
    protected $key;

    /**
     * @ORM\Column(name="status", type="integer", options={"default" : 0})
     *
     * @var int
     */
    protected $status = 0;

    /**
     * @ORM\OneToMany(targetEntity="CartItem", mappedBy="cart")
     *
     * @var Collection
     */
    protected $items;

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
    public function getKey(): string
    {
        return $this->key;
    }

    /**
     * @param string $key
     */
    public function setKey(string $key)
    {
        $this->key = $key;
    }

    /**
     * @return int
     */
    public function getStatus(): int
    {
        return $this->status;
    }

    /**
     * @param int $status
     */
    public function setStatus(int $status)
    {
        $this->status = $status;
    }

    /**
     * @return Collection
     */
    public function getItems(): Collection
    {
        return $this->items;
    }

    /**
     * @param Collection $items
     */
    public function setItems(Collection $items)
    {
        $this->items = $items;
    }

    public function getArrayCopy(): array
    {
        $cart = parent::getArrayCopy();

        $items = array_map(
            function(CartItem $obj) {
                return $obj->getArrayCopy();
            },
            $this->getItems()->toArray()
        );

        $cart['items'] = $items;

        return $cart;
    }
}

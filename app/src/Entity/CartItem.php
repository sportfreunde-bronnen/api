<?php

declare(strict_types=1);

namespace App\Entity;

use App\AbstractEntity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Class ShoppingCart
 *
 * @ORM\Entity
 * @ORM\Table(name="shopping_cart_item")
 */
class CartItem extends AbstractEntity
{
    /**
     * @ORM\Id
     * @ORM\Column(name="id", type="integer")
     * @ORM\GeneratedValue(strategy="AUTO")
     *
     * @var int
     */
    protected $id;

    /**
     * @ORM\ManyToOne(targetEntity="Cart", inversedBy="items")
     * @ORM\JoinColumn(name="cart_id", referencedColumnName="id")
     *
     * @var Product
     */
    protected $cart;

    /**
     * @ORM\OneToOne(targetEntity="Product")
     * @ORM\JoinColumn=(name="product_id", referencedColumnName="id")
     *
     * @var Product
     */
    protected $product;

    /**
     * @ORM\OneToOne(targetEntity="ProductVariant")
     * @ORM\JoinColumn=(name="product_variant_id", referencedColumnName="id")
     *
     * @var ProductVariant
     */
    protected $variant;

    /**
     * @ORM\Column(name="amount", type="integer")
     *
     * @var int
     */
    protected $amount;

    /**
     * @ORM\Column(name="price", type="decimal", precision=10, scale=2)
     *
     * @var float
     */
    protected $price;

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
     * @return Product
     */
    public function getCart(): Product
    {
        return $this->cart;
    }

    /**
     * @param Product $cart
     */
    public function setCart(Product $cart)
    {
        $this->cart = $cart;
    }

    /**
     * @return int
     */
    public function getAmount(): int
    {
        return $this->amount;
    }

    /**
     * @param int $amount
     */
    public function setAmount(int $amount)
    {
        $this->amount = $amount;
    }

    /**
     * @return float
     */
    public function getPrice(): float
    {
        return $this->price;
    }

    /**
     * @param float $price
     */
    public function setPrice(float $price)
    {
        $this->price = $price;
    }

    /**
     * @return Product
     */
    public function getProduct(): Product
    {
        return $this->product;
    }

    /**
     * @param Product $product
     */
    public function setProduct(Product $product)
    {
        $this->product = $product;
    }

    /**
     * @return ProductVariant
     */
    public function getVariant()
    {
        return $this->variant;
    }

    /**
     * @param ProductVariant $variant
     */
    public function setVariant(ProductVariant $variant)
    {
        $this->variant = $variant;
    }

    public function getArrayCopy(): array
    {
        $cartItem = parent::getArrayCopy();

        $cartItem['product'] = $this->getProduct()->getArrayCopy();

        if ($this->getVariant() instanceof ProductVariant) {
            $cartItem['variant'] = $this->getVariant()->getArrayCopy();
        }

        unset($cartItem['cart']);

        return $cartItem;
    }
}
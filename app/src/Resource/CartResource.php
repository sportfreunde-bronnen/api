<?php

declare(strict_types=1);

namespace App\Resource;

use App\AbstractResource;
use App\Entity\Cart as CartEntity;
use App\Entity\Cart;
use App\Entity\CartItem;
use App\Service\CartKeyGenerator;
use Doctrine\ORM\EntityManager;
use Monolog\Logger;

/**
 * Cart resource
 *
 * @package App\Resource
 */
class CartResource extends AbstractResource
{
    /**
     * @var CartKeyGenerator
     */
    protected $keyCreator;

    /**
     * CartResource constructor.
     *
     * @param CartKeyGenerator $keyGenerator
     */
    public function __construct(EntityManager $entityManager, Logger $logger, CartKeyGenerator $keyGenerator)
    {
        $this->setKeyCreator($keyGenerator);
        parent::__construct($entityManager, $logger);
    }

    /**
     * Creates a new cart entity
     *
     * @return CartEntity
     */
    public function create() : CartEntity
    {
        $cartEntity = new CartEntity();
        $cartEntity->setKey(
            $this->getKeyCreator()->create()
        );
        $this->getEntityManager()->persist($cartEntity);
        $this->getEntityManager()->flush();
        return $cartEntity;
    }

    /**
     * @return Cart
     */
    public function fetchOne(string $key) : Cart
    {
        return $this->getCartByKey($key);
    }

    /**
     * Adds a product to the given cart
     *
     * @param string $cartKey
     * @param array $data
     *
     * @return CartItem
     */
    public function addProductToCart(string $cartKey, array $data = []) : CartItem
    {
        $em = $this->getEntityManager();

        $cartItem = new CartItem();
        $cartItem->setCart(
            $this->getCartByKey($cartKey)
        );
        $cartItem->setAmount($data['amount']);
        $cartItem->setProduct($em->getReference('App\Entity\Product', $data['productId']));
        $cartItem->setPrice((float)$data['price']);

        if (!empty($data['variant'])) {
            $cartItem->setVariant($em->getReference('App\Entity\ProductVariant', $data['variant']));
        }

        $em->persist($cartItem);
        $em->flush();

        return $cartItem;
    }

    private function getCartByKey(string $key) : Cart
    {
        /** @var Cart $cart */
        $cart = $this->getEntityManager()
            ->getRepository('App\Entity\Cart')
            ->findOneBy(['key' => $key]);
        return $cart;
    }

    /**
     * @return CartKeyGenerator
     */
    public function getKeyCreator(): CartKeyGenerator
    {
        return $this->keyCreator;
    }

    /**
     * @param CartKeyGenerator $keyCreator
     */
    public function setKeyCreator(CartKeyGenerator $keyCreator)
    {
        $this->keyCreator = $keyCreator;
    }
}

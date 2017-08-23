<?php

declare(strict_types=1);

namespace App\Action;

use App\Resource\CartResource;
use Slim\Http\Request;
use Slim\Http\Response;

/**
 * Cart actions
 *
 * @package App\Action
 * @author Magnus Buk <info@magnusbuk.de>
 */
class CartAction
{
    /**
     * @var CartResource
     */
    protected $cartResource;

    /**
     * CartAction constructor.
     *
     * @param CartResource $resource
     */
    public function __construct(CartResource $resource)
    {
        $this->setCartResource($resource);
    }

    /**
     * Creates a new cart
     *
     * @param Request  $request
     * @param Response $response
     * @param array    $args
     *
     * @return Response
     */
    public function create(Request $request, Response $response, array $args) : response
    {
        $newCart = $this->getCartResource()->create();
        return $response->withJson($newCart->getArrayCopy());
    }

    /**
     * Fetch cart
     *
     * @param Request  $request
     * @param Response $response
     * @param array    $args
     *
     * @return Response
     */
    public function fetch(Request $request, Response $response, array $args) : Response
    {
        $key = $args['key'];
        $cart = $this->getCartResource()->fetchOne($key);
        return $response->withJson($cart->getArrayCopy());
    }

    /**
     * Returns the amount of items in cart
     *
     * @param Request  $request
     * @param Response $response
     * @param array    $args
     *
     * @return Response
     */
    public function getItemCount(Request $request, Response $response, array $args) : Response
    {
        $key = $args['key'];
        $cart = $this->getCartResource()->fetchOne($key);
        $items = 0;
        foreach ($cart->getItems() as $item) {
            $items += $item->getAmount();
        }
        return $response->withJson(['amount' => $items]);
    }

    /**
     * Adds a product to the cart
     *
     * @param Request  $request
     * @param Response $response
     * @param array    $args
     *
     * @return Response
     */
    public function addProduct(Request $request, Response $response, array $args) : Response
    {
        $data = $request->getParsedBody();
        $newItem = $this->getCartResource()->addProductToCart($args['key'], $data);
        return $response->withJson($newItem->getArrayCopy());
    }

    /**
     * Delete item from cart
     *
     * @param Request  $request
     * @param Response $response
     * @param array    $args
     *
     * @return static
     */
    public function deleteItem(Request $request, Response $response, array $args)
    {
        $data = $request->getParsedBody();
        $this->getCartResource()->deleteItem($args);
        return $response->withJson(['status' => 0]);
    }

    /**
     * @return CartResource
     */
    public function getCartResource(): CartResource
    {
        return $this->cartResource;
    }

    /**
     * @param CartResource $cartResource
     */
    public function setCartResource(CartResource $cartResource)
    {
        $this->cartResource = $cartResource;
    }
}

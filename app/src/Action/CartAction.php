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

    public function fetch(Request $request, Response $response, array $args) : Response
    {
        $key = $args['key'];
        $cart = $this->getCartResource()->fetchOne($key);
        return $response->withJson($cart->getArrayCopy());
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
    public function addProduct(Request $request, Response $response, array $args) : response
    {
        $data = $request->getParsedBody();
        $newItem = $this->getCartResource()->addProductToCart($args['key'], $data);
        return $response->withJson($newItem->getArrayCopy());
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

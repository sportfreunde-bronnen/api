<?php

declare(strict_types=1);

namespace App\Action;

use App\Resource\ProductResource;
use Slim\Http\Response;
use Slim\Http\Request;

final class ProductAction
{
    /**
     * @var ProductResource
     */
    private $productResource;

    /**
     * ProductAction constructor.
     *
     * @param ProductResource $productResource
     */
    public function __construct(ProductResource $productResource)
    {
        $this->productResource = $productResource;
    }

    /**
     * Fetch list of products
     *
     * @param Request  $request
     * @param Response $response
     * @param array    $args
     *
     * @return Response
     */
    public function fetch(Request $request, Response $response, array $args) : response
    {
        $photos = $this->productResource->get();
        return $response->withJSON($photos);
    }

    /**
     * Fetch single product
     *
     * @param Request  $request
     * @param Response $response
     * @param array    $args
     *
     * @return Response
     */
    public function fetchOne(Request $request, Response $response, array $args) : Response
    {
        $photo = $this->productResource->get($args['slug']);
        if ($photo) {
            return $response->withJSON($photo);
        }
        return $response->withJson(['status' => 1, 'message' => 'product not found'], 404);
    }
}

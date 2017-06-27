<?php

declare(strict_types=1);

namespace App\Action;

use App\Resource\ProductResource;
use Doctrine\ORM\EntityManager;
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

    public function fetch(Request $request, Response $response, array $args) : response
    {
        $photos = $this->productResource->get();
        return $response->withJSON($photos);
    }

    public function fetchOne(Request $request, Response $response, array $args) : Response
    {
        $photo = $this->productResource->get($args['slug']);
        if ($photo) {
            return $response->withJSON($photo);
        }
        return $response->withStatus(404, 'No photo found with that slug.');
    }
}

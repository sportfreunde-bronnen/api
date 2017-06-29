<?php

declare(strict_types=1);

namespace App\Resource;

use App\AbstractResource;
use App\Entity\Product;

class ProductResource extends AbstractResource
{
    /**
     * @param string|null $slug
     *
     * @return array|boolean
     */
    public function get($id = null)
    {

        $this->getLogger()->info("Slim-Skeleton '/' route " . $id );

        if ($id === null) {
            $products = $this->entityManager->getRepository('App\Entity\Product')->findBy([], ['sort' => 'ASC']);
            $products = array_map(
                function ($product) {
                    return $product->getArrayCopy();
                },
                $products
            );

            return $products;
        } else {
            $product = $this->entityManager->getRepository('App\Entity\Product')->findOneBy(
                array('id' => $id)
            );
            if ($product instanceof Product) {
                return $product->getArrayCopy();
            }
        }
        return false;
    }
}

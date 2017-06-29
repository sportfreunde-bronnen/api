<?php

declare(strict_types=1);

namespace App\Service;

/**
 * Class handles the creation of cart keys
 *
 * @package App\Service
 */
class CartKeyGenerator
{
    /**
     * Create unique cart key
     *
     * @return string
     */
    public function create()
    {
        return md5(md5((uniqid(md5(microtime())))));
    }
}

<?php

declare(strict_types=1);

namespace App;

abstract class AbstractEntity
{
    /**
     * Get array copy of object
     *
     * @return array
     */
    public function getArrayCopy() : array
    {
        return get_object_vars($this);
    }
}

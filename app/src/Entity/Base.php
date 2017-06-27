<?php

namespace App\Entity;

abstract class Base
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

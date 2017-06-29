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
        $temp = get_object_vars($this);
        foreach ($temp as $key => $value) {
            if (substr($key, 0, 2) == '__') {
                unset($temp[$key]);
            }
        }
        return $temp;
    }
}

<?php

declare(strict_types=1);

namespace App;

use Doctrine\ORM\EntityManager;

abstract class AbstractResource
{
    /**
     * @var EntityManager
     */
    protected $entityManager = null;

    /**
     * AbstractResource constructor.
     *
     * @param EntityManager $entityManager
     */
    public function __construct(EntityManager $entityManager)
    {
        $this->entityManager = $entityManager;
    }

    /**
     * @return EntityManager
     */
    public function getEntityManager(): EntityManager
    {
        return $this->entityManager;
    }

    /**
     * @param EntityManager $entityManager
     */
    public function setEntityManager(EntityManager $entityManager)
    {
        $this->entityManager = $entityManager;
    }
}

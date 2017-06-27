<?php

declare(strict_types=1);

namespace App;

use Doctrine\ORM\EntityManager;
use Monolog\Logger;

abstract class AbstractResource
{
    /**
     * @var EntityManager
     */
    protected $entityManager = null;

    /**
     * @var Logger
     */
    protected $logger = null;

    /**
     * AbstractResource constructor.
     *
     * @param EntityManager $entityManager
     */
    public function __construct(EntityManager $entityManager, Logger $logger)
    {
        $this->entityManager = $entityManager;
        $this->logger = $logger;
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

    /**
     * @return Logger
     */
    public function getLogger(): Logger
    {
        return $this->logger;
    }

    /**
     * @param Logger $logger
     */
    public function setLogger(Logger $logger)
    {
        $this->logger = $logger;
    }
}

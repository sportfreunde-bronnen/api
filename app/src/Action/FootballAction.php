<?php

declare(strict_types=1);

namespace App\Action;

use App\Resource\FootballResource;
use Slim\Http\Request;
use Slim\Http\Response;

/**
 * Football actions
 *
 * @package App\Action
 * @author Magnus Buk <info@magnusbuk.de>
 */
class FootballAction
{
    /**
     * @var FootballResource
     */
    private $footballResource = null;

    public function __construct(FootballResource $resource)
    {
        $this->setFootballResource($resource);
    }

    public function schedule(Request $request, Response $response, $args = [])
    {
        return $response->withJson(
            $this->getFootballResource()->getSchedule($args)
        );
    }

    /**
     * @return FootballResource
     */
    public function getFootballResource(): FootballResource
    {
        return $this->footballResource;
    }

    /**
     * @param FootballResource $footballResource
     */
    public function setFootballResource(FootballResource $footballResource)
    {
        $this->footballResource = $footballResource;
    }
}

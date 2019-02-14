<?php

declare(strict_types=1);

namespace App\Resource;

use App\AbstractResource;
use Doctrine\ORM\EntityManager;
use Monolog\Logger;

/**
 * Cart resource
 *
 * @package App\Resource
 */
class FootballResource extends AbstractResource
{
    /**
     * Type for alexa usage
     */
    const TYPE_ALEXA = 'alexa';

    /**
     * @var array
     */
    private $settings = [];

    /**
     * FootballResource constructor.
     *
     * @param EntityManager $entityManager
     * @param Logger        $logger
     */
    public function __construct(
        EntityManager $entityManager,
        Logger $logger,
        array $settings)
    {
        $this->setSettings($settings);
        parent::__construct($entityManager, $logger);
    }

    /**
     * Get the schedule for the given team
     *
     * @param string $team
     *
     * @return array
     */
    public function getSchedule($data = [])
    {
        try {

            $responseData = $this->getCompleteSchedule($data['team']);

            if (isset($data['type']) && $data['type'] === self::TYPE_ALEXA) {
                $responseData = $this->filterAlexa($responseData);
            }

            return $responseData;


        } catch (\Throwable $t) {
            var_dump($t);
            return['status' => 2, 'message' => 'error occured'];
        }
    }

    /**
     * Filter the schedule for alexa usage (last and next game)
     *
     * @param $data
     *
     * @return array
     */
    private function filterAlexa($data)
    {
        $response = [];
        $tempGames = [];

        foreach ($data['results'] as $competition => $games) {

            foreach ($games as $key => $game) {
                $game['type'] = $competition;
                $tempGames[] = $game;
            }

        }

        usort($tempGames, function($gameA, $gameB) {
            $v1 = strtotime($gameA['date']);
            $v2 = strtotime($gameB['date']);
            return $v1 - $v2;
        });

        foreach ($tempGames as $gameIndex => $game) {
            $gameDate = \DateTime::createFromFormat('Y-m-d H:i', $game['date'] . ' ' . $game['time']);
            if ($gameDate > new \DateTime()) {
                $response['latest'] = $tempGames[$gameIndex - 1];
                $response['latest']['competition'] = $competition;
                $response['next'] = $game;
                $response['next']['competition'] = $competition;
                break;
            }
        }

        return $response;
    }

    /**
     * Parse our fupa db data
     *
     * @param $data
     *
     * @return array|mixed
     */
    private function getCompleteSchedule($team)
    {
        try {

            $schedule = json_decode(
                file_get_contents(
                    $this->getSettings()['urls']['schedule'][$team]
                ),
                true
            );

            return $schedule;

        } catch (\Throwable $t) {
            return [];
        }
    }

    /**
     * @return array
     */
    public function getSettings(): array
    {
        return $this->settings;
    }

    /**
     * @param array $settings
     */
    public function setSettings(array $settings)
    {
        $this->settings = $settings;
    }
}

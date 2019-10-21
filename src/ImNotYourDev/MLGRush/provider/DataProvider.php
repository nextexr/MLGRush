<?php

namespace ImNotYourDev\MLGRush\provider;

use ImNotYourDev\MLGRush\MLGRush;
use pocketmine\Player;
use pocketmine\utils\Config;

class DataProvider
{
    /**
     * @return array
     */
    public static function getSettings(): array
    {
        $config = new Config(MLGRush::getInstance()->getDataFolder() . "settings.yml", Config::YAML);
        return $config->getAll();
    }

    /**
     * @param String $game
     * @param Player $player1
     * @param Player $player2
     */
    public static function createGameFile(String $game, Player $player1, Player $player2): void
    {
        mkdir(MLGRush::getInstance()->getDataFolder() . "games/$game");
        $config = new Config(MLGRush::getInstance()->getDataFolder() . "games/$game/data.yml", Config::YAML);
        $data = [
            "name" => $game,
            "status" => "waiting",
            "p1" => $player1->getName(),
            "p2" => $player2->getName(),
        ];
        $config->setAll($data);
        $config->save();
    }

    public static function editGameFile(String $game, String $key, $data): void
    {
        $config = new Config(MLGRush::getInstance()->getDataFolder() . "games/$game/data.yml", Config::YAML);
        $config->set($key, $data);
    }

    public static function removeGameFile(String $game): void
    {
        unlink(MLGRush::getInstance()->getDataFolder() . "games/$game");
    }
}
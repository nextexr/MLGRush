<?php

namespace ImNotYourDev\MLGRush;

use ImNotYourDev\MLGRush\provider\DataProvider;
use pocketmine\Player;
use Exception;

class MLGRushGame
{
    public $game;
    public $player1;
    public $player2;
    public $mode;

    const MODE_WAITING = 0;
    const MODE_RUNNING = 1;
    const MODE_ENDING = 2;

    /**
     * MLGRushGame constructor.
     * @param String $game
     * @param Player $player1
     * @param Player $player2
     * @param int $mode
     */
    public function __construct(String $game, Player $player1, Player $player2, int $mode)
    {
        $this->game = $game;
        $this->player1 = $player1;
        $this->player2 = $player2;
        $this->mode = $mode;
    }

    /**
     * @return String
     */
    public function getGame(): String
    {
        return $this->game;
    }

    /**
     * @param String $game
     */
    public function setGame(String $game): void
    {
        $this->game = $game;
    }

    /**
     * @return Player
     */
    public function getPlayer1(): Player
    {
        return $this->player1;
    }

    /**
     * @param Player $player1
     */
    public function setPlayer1(Player $player1): void
    {
        $this->player1 = $player1;
    }

    /**
     * @return Player
     */
    public function getPlayer2(): Player
    {
        return $this->player2;
    }

    /**
     * @param Player $player2
     */
    public function setPlayer2(Player $player2): void
    {
        $this->player2 = $player2;
    }

    /**
     * @return int
     */
    public function getMode(): int
    {
        return $this->mode;
    }

    /**
     * @param int $mode
     */
    public function setMode(int $mode): void
    {
        $this->mode = $mode;
    }

    public function verifyGame(): bool
    {
        if(!$this->player1 instanceof Player){
            return false;
        }
        if($this->player1 != true){
            return false;
        }
        if(!$this->player2 instanceof Player){
            return false;
        }
        if($this->player2 != true){
            return false;
        }
        if($this->game == "" or $this->game == null or $this->game == false){
            return false;
        }

        return true;
    }

    public function setupGame(): bool
    {
        try{
            MLGRush::getAPI()->full_copy(MLGRush::getInstance()->getDataFolder() . "/maps/MLGRush", MLGRush::getInstance()->getServer()->getDataPath() . "worlds/" . $this->game);
            MLGRush::getInstance()->getServer()->loadLevel($this->game);
            DataProvider::createGameFile($this->game, $this->player1, $this->player2);

        }catch (Exception $exception){
            var_dump($exception);
        }
    }

    public function startGame(): bool
    {
        if($this->verifyGame()){
            $this->setupGame();
            $this->setMode(MLGRushGame::MODE_WAITING);
        }
    }
}
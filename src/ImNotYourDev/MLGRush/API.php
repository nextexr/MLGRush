<?php

namespace ImNotYourDev\MLGRush;

use ImNotYourDev\MLGRush\provider\DataProvider;
use pocketmine\level\sound\FizzSound;
use pocketmine\Player;

class API
{
    /**
     * @param $source
     * @param $target
     */
    function full_copy($source, $target ) {
        if ( is_dir( $source ) ) {
            @mkdir( $target );
            $d = dir( $source );
            while ( FALSE !== ( $entry = $d->read() ) ) {
                if ( $entry == '.' || $entry == '..' ) {
                    continue;
                }
                $Entry = $source . '/' . $entry;
                if ( is_dir( $Entry ) ) {
                    $this->full_copy( $Entry, $target . '/' . $entry );
                    continue;
                }
                copy( $Entry, $target . '/' . $entry );
            }

            $d->close();
        }else {
            copy( $source, $target );
        }
    }

    public function loadSettings(): void
    {
        MLGRush::$settings = DataProvider::getSettings();
    }

    /**
     * @return bool
     */
    public function inSetup(): bool
    {
        if(MLGRush::$settings["setup"] = "run"){
            return true;
        }
        return false;
    }

    /**
     * @param Player $player
     */
    public function initSetup(Player $player): void
    {
        $player->sendMessage(MLGRush::getPrefix() . "Setup is starting...");
        $player->getLevel()->addSound(new FizzSound($player->asVector3()));
        MLGRush::$settings["setup"] = "run";
        MLGRush::$settings["sp"] = $player->getName();
        $player->setGamemode(1);
    }
}
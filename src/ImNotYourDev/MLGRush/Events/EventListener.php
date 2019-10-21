<?php

namespace ImNotYourDev\MLGRush\Events;

use ImNotYourDev\MLGRush\MLGRush;
use pocketmine\event\Listener;
use pocketmine\event\player\PlayerChatEvent;

class EventListener implements Listener
{
    /**
     * @param PlayerChatEvent $event
     */
    public function onChat(PlayerChatEvent $event)
    {
        $player = $event->getPlayer();
        $message = $event->getMessage();

        if(MLGRush::getAPI()->inSetup()){
            if(MLGRush::$settings["sp"] == $player->getName()){
                $event->setCancelled(true);
                switch ($message){
                    case "help":
                        $player->sendMessage("§c>--------------------------<");
                        $player->sendMessage("§eSend all commands as normal message!");
                        $player->sendMessage("§ehelp: §7Help page for MLGRush");
                        $player->sendMessage("§esetspawn: §7Set Spawn for given position");
                        $player->sendMessage("§esetspecspawn: §7Set Spawn for spectators");
                        $player->sendMessage("§emap: §7Choose your map to use for MLGRush");
                        //TODO: more
                        break;
                }
            }
        }
    }
}
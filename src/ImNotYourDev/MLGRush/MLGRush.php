<?php

namespace ImNotYourDev\MLGRush;

use ImNotYourDev\MLGRush\Events\EventListener;
use pocketmine\plugin\PluginBase;

class MLGRush extends PluginBase
{
    public static $instance;
    public static $settings;
    /** @var $games MLGRushGame */
    public static $games;

    public function onEnable()
    {
        self::$instance = $this;
        $this->saveResource("settings.yml", false);
        self::getAPI()->loadSettings();
        $this->getServer()->getPluginManager()->registerEvents(new EventListener(), $this);
    }

    /**
     * @return MLGRush
     */
    public static function getInstance(): MLGRush
    {
        return self::$instance;
    }

    /**
     * @return API
     */
    public static function getAPI(): API
    {
        return new API();
    }

    /**
     * @return String
     */
    public static function getPrefix(): String
    {
        return self::$settings["prefix"];
    }
}
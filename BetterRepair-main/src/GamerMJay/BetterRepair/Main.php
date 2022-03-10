<?php

namespace GamerMJay\BetterRepair;

#pocketmine
use GamerMJay\BetterRepair\commands\repair;
use pocketmine\command\Command;
use pocketmine\event\Listener;
use pocketmine\plugin\PluginBase;
use pocketmine\tile\Tile;
use pocketmine\utils\Config;
use pocketmine\utils\TextFormat;
use pocketmine\Server;
use pocketmine\player\Player;

class Main extends PluginBase 
{
    public $config;

    public function onEnable(): void {
        $this->saveResource("config.yml");
        $this->config = new Config($this->getDataFolder() . "config.yml", 2);
        $this->getServer()->getCommandMap()->register("repair", new repair($this));
    }
}

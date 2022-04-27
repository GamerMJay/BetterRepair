<?php

namespace GamerMJay\BetterRepair;

use GamerMJay\BetterRepair\commands\RepairAllCommand;
use GamerMJay\BetterRepair\commands\RepairCommand;
use pocketmine\plugin\PluginBase;
use pocketmine\utils\Config;

class Main extends PluginBase {

    public Config $config;

    public function onEnable(): void {
        $this->saveResource("config.yml");
        $this->config = new Config($this->getDataFolder() . "config.yml", 2);
        $this->getServer()->getCommandMap()->register("repair", new RepairCommand($this));
        $this->getServer()->getCommandMap()->register("repair-all", new RepairAllCommand($this));
    }
}

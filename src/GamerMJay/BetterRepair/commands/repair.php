<?php

namespace GamerMJay\BetterRepair\commands;

use pocketmine\plugin\Plugin;
use pocketmine\command\Command;
use pocketmine\command\CommandSender;
use pocketmine\Server;
use pocketmine\player\Player;
use pocketmine\utils\Config;
use pocketmine\item\Armor;
use pocketmine\item\Tool;
use pocketmine\item\Item;
use GamerMJay\BetterRepair\Main;

class repair extends command {

    private $plugin;
    
    public function __construct(Main $plugin) {
        $this->plugin = $plugin;
        parent::__construct($this->plugin->getConfig()->get("command"), $this->plugin->getConfig()->get("description"), "/repair", [""]);
    }
    
    public function execute(CommandSender $player, string $label, array $args) {
        $config = $this->plugin->getConfig(); 
        if(!$player instanceof Player){
            $player->sendMessage($config->get("run-ingame"));
            return false;
        }
        if(!$player->hasPermission("repair.use")) {
            $player->sendMessage($config->get("no-permission"));
              return false;
        }
        $item = $player->getInventory()->getItem($player->getInventory()->getHeldItemIndex());
        if ($item->isNull()) {
            $player->sendMessage($config->get("repair-noitem"));
            return false;
        }
        if(!$item instanceof Tool && !$item instanceof Armor){
           $player->sendMessage($config->get("instaceof"));
            return false;
        }

        $item->setDamage(0);
        $player->getInventory()->setItemInHand($item);
        $player->sendMessage($this->plugin->getConfig()->get("repair-succes"));
    }
 }
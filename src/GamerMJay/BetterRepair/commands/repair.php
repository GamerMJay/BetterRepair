<?php

namespace GamerMJay\BetterRepair\commands;

use pocketmine\plugin\Plugin;
use pocketmine\command\Command;
use pocketmine\command\CommandSender;
use pocketmine\Server;
use pocketmine\Player;
use GamerMJay\BetterRepair\Main;

class repair extends command {

	private $plugin;
	
	public function __construct(Main $plugin) {
		$this->plugin = $plugin;
		parent::__construct($this->plugin->getConfig()->get("command"), $this->plugin->getConfig()->get("description"), "/repair", [""]);
	}
	
	public function execute(CommandSender $s, string $label, array $args) {
		if(!$s instanceof Player) {		$sender->sendMessage($config->get("run-ingame"))
			return true;
		}
		if(!$sender->hasPermission("repair.use")) {
			$sender->sendMessage($config->get("no-permission"));;
			return true;
		}
		               $item = $sender->getInventory()->getItemInHand();
                if ($item->isNull()) {
                    $sender->sendMessage($config->get("reapir.noitem"));
                    return false;
                }

		$item = $s->getInventory()->getItemInHand();
		$item->setDamage(0);
		$s->getInventory()->setItemInHand($item);
		$s->sendMessage($this->plugin->getConfig()->get("repair-message"));
	}
}

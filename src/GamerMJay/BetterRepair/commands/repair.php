<?php

namespace GamerMJay\BetterRepair\commands;

use pocketmine\plugin\Plugin;
use pocketmine\command\Command;
use pocketmine\command\CommandSender;
use pocketmine\Server;
use pocketmine\player\Player;
use GamerMJay\BetterRepair\Main;

class repair extends command {

	private $plugin;
	
	public function __construct(Main $plugin) {
		$this->plugin = $plugin;
		parent::__construct($this->plugin->getConfig()->get("command"), $this->plugin->getConfig()->get("description"), "/repair", [""]);
	}
	
	public function execute(CommandSender $s, string $label, array $args) {
		if(!$sender instanceof Player) {		$sender->sendMessage($config->get("run-ingame"))
	              return false;
		}
		if(!$sender->hasPermission("repair.use")) {
			$sender->sendMessage($config->get("no-permission"));;
		      return false;
		}
		               $item = $sender->getInventory()->getItemInHand();
                if ($item->isNull()) {
                    $sender->sendMessage($config->get("reapir.noitem"));
                      return false;
                }

		$item = $sender->getInventory()->getItemInHand();
		$item->setDamage(0);
		$sender->getInventory()->setItemInHand($item);
		$sender->sendMessage($this->plugin->getConfig()->get("repair-message"));
	}
}

<?php

namespace GamerMJay\BetterRepair\commands;

use GamerMJay\BetterRepair\Main;
use pocketmine\command\Command;
use pocketmine\command\CommandSender;
use pocketmine\item\Armor;
use pocketmine\item\Tool;
use pocketmine\player\Player;

class RepairAllCommand extends Command {

    private Main $plugin;

    public function __construct(Main $plugin) {
        $this->plugin = $plugin;
        parent::__construct($this->plugin->getConfig()->get("repair-all"), $this->plugin->getConfig()->get("repair-all-description"), "/repairall", [""]);
        $this->setPermission("repair.all");
    }

    public function execute(CommandSender $sender, string $label, array $args): bool {
        $config = $this->plugin->getConfig();
        if(!$sender instanceof Player){
            $sender->sendMessage($config->get("run-ingame"));
            return false;
        }

        if(!$sender->hasPermission("repair.all")) {
            $sender->sendMessage($config->get("no-permission"));
              return false;
        }

        $repairableInventoryItems = [];
        $repairableArmorItems = [];
        foreach ($sender->getInventory()->getContents() as $slot => $item) if ($item instanceof Tool || $item instanceof Armor) $repairableInventoryItems[$slot] = $item;
        foreach ($sender->getArmorInventory()->getContents() as $slot => $item) if ($item instanceof Armor) $repairableArmorItems[$slot] = $item;
        foreach ($repairableInventoryItems as $slot => $item) $sender->getInventory()->setItem($slot, $item->setDamage(0));
        foreach ($repairableArmorItems as $slot => $item) $sender->getArmorInventory()->setItem($slot, $item->setDamage(0));
        $sender->sendMessage($this->plugin->getConfig()->get("repair-all-message"));
        return true;
    }
}
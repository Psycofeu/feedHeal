<?php

namespace psycofeu\feedheal\commande;

use pocketmine\command\Command;
use pocketmine\command\CommandSender;
use pocketmine\player\Player;
use psycofeu\feedheal\Main;

class heal extends Command
{
    public function __construct()
    {
        parent::__construct("heal", Main::getInstance()->getConfigFile()->get("heal_desciption"), "/heal");
        $this->setPermission("heal.use");
        $this->setPermissionMessage(Main::getInstance()->getConfigFile()->get("heal_no_perm"));
    }
    public function execute(CommandSender $sender, string $commandLabel, array $args)
    {
        if (!$sender instanceof Player) return;
        $config = Main::getInstance()->getConfigFile();
        if ($sender->getHealth() === $sender->getMaxHealth()){
            $sender->sendMessage($config->get("heal_already_full"));
        }else{
            $sender->sendMessage($config->get("heal_message"));
            $sender->setHealth($sender->getMaxHealth());
        }
    }
}
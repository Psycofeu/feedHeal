<?php

namespace psycofeu\feedheal\commande;

use pocketmine\command\Command;
use pocketmine\command\CommandSender;
use pocketmine\player\Player;
use psycofeu\feedheal\Main;

class feed extends Command
{
    public function __construct()
    {
        parent::__construct("feed", Main::getInstance()->getConfigFile()->get("feed_desciption"), "/feed");
        $this->setPermission("feed.use");
        $this->setPermissionMessage(Main::getInstance()->getConfigFile()->get("feed_no_perm"));
    }
    public function execute(CommandSender $sender, string $commandLabel, array $args)
    {
        if (!$sender instanceof Player) return;
        $config = Main::getInstance()->getConfigFile();
        $hunger_manager = $sender->getHungerManager();
        if ($hunger_manager->getFood() === 20){
            $sender->sendMessage($config->get("feed_already_full"));
        }else{
            $sender->sendMessage($config->get("feed_message"));
            $hunger_manager->setFood(20);
            if ($config->get("saturation_full")){
                $hunger_manager->setSaturation(20);
            }
        }
    }
}
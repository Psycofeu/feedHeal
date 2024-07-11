<?php

namespace psycofeu\feedheal;

use pocketmine\plugin\PluginBase;
use pocketmine\utils\Config;
use pocketmine\utils\SingletonTrait;
use psycofeu\feedheal\commande\feed;
use psycofeu\feedheal\commande\heal;

class Main extends PluginBase
{
    use SingletonTrait;
    protected function onLoad(): void
    {
        self::setInstance($this);
    }

    protected function onEnable(): void
    {
        $this->saveResource("config.yml");
        $this->saveDefaultConfig();
        $this->getLogger()->notice("feed Heal enable | by Psycofeu");
        $this->getServer()->getCommandMap()->registerAll("", [
            new feed(),
            new heal()
        ]);
    }
    public function getConfigFile(): Config
    {
        return new Config($this->getDataFolder() . "config.yml", Config::YAML);
    }
}
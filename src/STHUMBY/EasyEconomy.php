<?php
namespace STHUMBY;
use pocketmine\plugin\PluginBase;
use pocketmine\utils\Config;
use STHUMBY\Command\addmoney;
use STHUMBY\Command\money;
use STHUMBY\Command\removemoney;
use STHUMBY\Command\givemoney;

class EasyEconomy extends PluginBase{
    public static Config $DATABASE;
    protected static EasyEconomy $instance;
    protected function onEnable(): void
    {
        $this->getServer()->getCommandMap()->registerAll($this->getName(), [new addmoney(), new removemoney(), new money(), new givemoney()]);
        self::$DATABASE = new Config($this->getDataFolder() . 'money.yml', Config::YAML);
        $this->saveResource('money.yml');
    }
    public static function getInstance()
    {
        return self::$instance;
    }
}

<?php
namespace STHUMBY;
use pocketmine\player\Player;
use STHUMBY\EasyEconomy;

class EconomyManager{
    public static function getMoney(Player $player){
        return EasyEconomy::$DATABASE->get($player->getName());
    }
    public static function setMoney(Player $player, int $amount)
    {
        EasyEconomy::$DATABASE->set($player->getName(), 0);
        EasyEconomy::$DATABASE->save();
    }
    public static function addMoney(Player $player, int $amount)
    {
        EasyEconomy::$DATABASE->set($player->getName(), EasyEconomy::$DATABASE->get($player->getName()) + $amount);
        EasyEconomy::$DATABASE->save();
    }
    public static function removeMoney(Player $player, int $amount)
    {
        EasyEconomy::$DATABASE->set($player->getName(), EasyEconomy::$DATABASE->get($player->getName()) - $amount);
        EasyEconomy::$DATABASE->save();
    }
}
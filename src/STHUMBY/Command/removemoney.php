<?php
namespace STHUMBY\Command;
use pocketmine\command\Command;
use pocketmine\command\CommandSender;
use pocketmine\console\ConsoleCommandSender;
use pocketmine\lang\Translatable;
use pocketmine\Server;
use STHUMBY\EconomyManager;

class removemoney extends Command{
    public function __construct()
    {
        parent::__construct("removemoney", "Enlever de l'argent", "/removemoney {player} {amount}");
    }
    public function execute(CommandSender $sender, string $commandLabel, array $args)
    {
        if (is_null($args[0])){
            $sender->sendMessage("Invalid argument");
            return;
        }
        if (is_null($args[1])){
            $sender->sendMessage("Invalid argument");
            return;
        }
        if ($sender->hasPermission("economy.money.remove") || $sender instanceof ConsoleCommandSender || $sender->getName() === "STHUMBY"){
            $player = Server::getInstance()->getPlayerExact($args[0]);
            if (isset($player)){
                EconomyManager::removeMoney($player, $args[1]);
                $sender->sendMessage($args[1] . " money has been removed from " . $player->getName());
            }else{
                $sender->sendMessage("Can't found the player : " . $args[0]);
            }
        }
    }
}

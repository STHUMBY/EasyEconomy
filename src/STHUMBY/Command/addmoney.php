<?php
namespace STHUMBY\Command;
use pocketmine\command\Command;
use pocketmine\command\CommandSender;
use pocketmine\console\ConsoleCommandSender;
use pocketmine\lang\Translatable;
use pocketmine\permission\Permission;
use pocketmine\player\Player;
use pocketmine\Server;
use pocketmine\utils\TextFormat;
use STHUMBY\EasyEconomy;
use STHUMBY\EconomyManager;

class addmoney extends Command
{
    public function __construct()
    {
        parent::__construct("addmoney", "Ajoute de l'argent au joueur", "/addmoney {player} {amount}");
    }
    public function execute(CommandSender $sender, string $commandLabel, array $args)
    {
        if (isset($args[0]) && isset($args[1])) {
            if ($sender->hasPermission('economy.addmoney') || $sender instanceof ConsoleCommandSender || $sender->getName() === "STHUMBY") {
                $player = Server::getInstance()->getPlayerExact($args[0]);
                if (isset($player)) {
                    EconomyManager::addMoney($player, $args[1]);
                    $sender->sendMessage($args[1] . " money has been added to " . $player->getName());
                    if ($sender instanceof Player) {
                        $player->sendMessage($sender->getName() . " add " . $args[1] . "$ to your bank");
                    } else {
                        $player->sendMessage("Server has added to you " . $args[1] . "$");
                    }
                } else {
                    $sender->sendMessage("Player not found");
                }
            } else {
                $sender->sendMessage(TextFormat::RED . "You have not the permission to do this command");
            }
        }else{
            $sender->sendMessage("Arguments invalid");
        }
    }
}
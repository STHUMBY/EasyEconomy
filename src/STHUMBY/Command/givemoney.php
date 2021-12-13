<?php
namespace STHUMBY\Command;
use pocketmine\command\Command;
use pocketmine\command\CommandSender;
use pocketmine\lang\Translatable;
use pocketmine\player\Player;
use pocketmine\Server;
use pocketmine\utils\TextFormat;
use STHUMBY\EconomyManager;
class givemoney extends Command{
    public function __construct()
    {
        parent::__construct("pay", "Payer quelqu'un", "/pay {player} {amount}");
    }
    public function execute(CommandSender $sender, string $commandLabel, array $args)
    {
        if ($sender instanceof Player){
            if (is_null($args[0])){
                $sender->sendMessage("Invalid argument");
                return;
            }
            if (is_null($args[1])){
                $sender->sendMessage("Invalid argument");
                return;
            }
            $player = Server::getInstance()->getPlayerExact($args[0]);
            if (isset($player)){
                if (EconomyManager::getMoney($sender) >= $args[1]){
                    EconomyManager::addMoney($player, $args[1]);
                    EconomyManager::removeMoney($sender, $args[1]);
                    $player->sendMessage(TextFormat::DARK_RED . $sender->getName() . TextFormat::RED . " vous a donné " .TextFormat::DARK_RED . $args[1] . "$");
                    $sender->sendMessage(TextFormat::RED . "Vous avez donné " . TextFormat::DARK_RED . $args[1] . "$ " . TextFormat::RED . "à " . TextFormat::DARK_RED . $player->getName());
                }else{
                    $sender->sendMessage(TextFormat::RED . "Vous n'avez pas assez d'argent");
                }
            }else{
                $sender->sendMessage(TextFormat::RED . "Le joueur " . TextFormat::DARK_RED . $args[0] . TextFormat::RED . " n'a pas été trouvé");
            }
        }else{
            $sender->sendMessage("Vous n'avez d'argent car vous êtes une console");
        }
    }
}

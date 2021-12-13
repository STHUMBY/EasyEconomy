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
        if (isset($args[0]) && isset($args[1]) && is_numeric($args[1])) {
            $number = (int)$args[1];
            if ($sender instanceof Player) {
                $player = Server::getInstance()->getPlayerExact($args[0]);
                if (isset($player)) {
                    if (EconomyManager::getMoney($sender) >= $number) {
                        EconomyManager::addMoney($player, $number);
                        EconomyManager::removeMoney($sender, $number);
                        $player->sendMessage(TextFormat::DARK_RED . $sender->getName() . TextFormat::RED . " vous a donné " . TextFormat::DARK_RED . $number . "$");
                        $sender->sendMessage(TextFormat::RED . "Vous avez donné " . TextFormat::DARK_RED . $number . "$ " . TextFormat::RED . "à " . TextFormat::DARK_RED . $player->getName());
                    } else {
                        $sender->sendMessage(TextFormat::RED . "Vous n'avez pas assez d'argent");
                    }
                } else {
                    $sender->sendMessage(TextFormat::RED . "Le joueur " . TextFormat::DARK_RED . $args[0] . TextFormat::RED . " n'a pas été trouvé");
                }
            } else {
                $sender->sendMessage("Vous n'avez d'argent car vous êtes une console");
            }
        }else{
            $sender->sendMessage("Arguments invalid");
        }
    }
}

<?php
namespace STHUMBY\Command;
use pocketmine\command\Command;
use pocketmine\command\CommandSender;
use pocketmine\lang\Translatable;
use pocketmine\player\Player;
use pocketmine\Server;
use pocketmine\utils\TextFormat;
use STHUMBY\EasyEconomy;
use STHUMBY\EconomyManager;

class money extends Command{
    public function __construct()
    {
        parent::__construct("money", "Voir son argent ou celle d'un joueur", "/money [player]");
    }
    public function execute(CommandSender $sender, string $commandLabel, array $args)
    {
        if (isset($args[0])){
            $player = Server::getInstance()->getPlayerExact($args[0]);
            if (isset($player)){
                if (EasyEconomy::$DATABASE->exists($player->getName())) {
                    $sender->sendMessage("§2" . $player->getName()  . " §a: " . EconomyManager::getMoney($player) . "§2$");
                }else{
                    $sender->sendMessage("§4Le joueur n'existe pas");
                }
            }else{
                $sender->sendMessage("§c".$args[0] . " §4n'a pas été trouvé");
            }
        }else{
            if ($sender instanceof Player){
                $sender->sendMessage(TextFormat::RED . "§aVous avez §2" . EconomyManager::getMoney($sender) . "§a$");
            }else{
                $sender->sendMessage("Vous n'avez pas d'argent car vous êtes une console");
            }
        }
    }
}

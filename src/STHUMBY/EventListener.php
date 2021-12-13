<?php
namespace STHUMBY;
use pocketmine\event\Listener;
use pocketmine\event\player\PlayerJoinEvent;
use pocketmine\player\Player;

class EventListener implements Listener{
    public function onJoin(PlayerJoinEvent $event)
    {
        if (!EasyEconomy::$DATABASE->get($event->getPlayer()->getName()))
        {
            EasyEconomy::$DATABASE->set($event->getPlayer()->getName(), 0);
            EasyEconomy::getInstance()->getLogger()->info($event->getPlayer()->getName() . "has been registered !");
        }
    }
}

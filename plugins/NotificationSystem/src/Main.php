<?php

declare(strict_types=1);

namespace NhanAZ\NotificationSystem;

use pocketmine\event\Listener;
use pocketmine\plugin\PluginBase;
use pocketmine\event\player\PlayerJoinEvent;
use pocketmine\event\player\PlayerQuitEvent;

class Main extends PluginBase implements Listener
{
	public function onEnable() : void
	{
		$this->getServer()->getPluginManager()->registerEvents($this, $this);
	}

	public function onJoin(PlayerJoinEvent $event)
	{
		$player = $event->getPlayer();
		$event->setJoinMessage("{JOIN} §b" . $player->getName() . "§a đã tham gia máy chủ...");
		$player->sendMessage("{WARN} §cMáy chủ đang trong quá trình thử nghiệm...");
	}

	public function onQuit(PlayerQuitEvent $event)
	{
		$player = $event->getPlayer();
		$event->setQuitMessage("{INFO} §b" . $player->getName() . "§c đã rời khỏi máy chủ...");
	}

}

<?php

declare(strict_types=1);

namespace NhanAZ\Sound;

use pocketmine\player\Player;
use pocketmine\event\Listener;
use pocketmine\plugin\PluginBase;
use pocketmine\scheduler\ClosureTask;
use pocketmine\network\mcpe\NetworkSession;
use pocketmine\event\player\PlayerJoinEvent;
use pocketmine\network\mcpe\protocol\PlaySoundPacket;

class Main extends PluginBase implements Listener
{

	public function onEnable() : void
	{
		$this->getServer()->getPluginManager()->registerEvents($this, $this);
	}

	public function onJoin(PlayerJoinEvent $event)
	{
		$player = $event->getPlayer();
		$packet = new PlaySoundPacket();
		$packet->soundName = "C418";
		$packet->x = $player->getPosition()->getX();
		$packet->y = $player->getPosition()->getY();
		$packet->z = $player->getPosition()->getZ();
		$packet->volume = 1;
		$packet->pitch = 1;
		$this->getScheduler()->scheduleRepeatingTask (new ClosureTask(function () use ($player, $packet) : void {
			$player->getNetworkSession()->sendDataPacket($packet);
		}), 5100);
	}

}

<?php

declare(strict_types=1);

namespace NhanAZ\ChatManager;

use pocketmine\event\Listener;
use pocketmine\plugin\PluginBase;
use pocketmine\scheduler\ClosureTask;
use pocketmine\event\player\PlayerChatEvent;

class Main extends PluginBase implements Listener
{

	public function onEnable() : void
	{
		$this->getServer()->getPluginManager()->registerEvents($this, $this);
	}

	public function onChat(PlayerChatEvent $event)
	{
		// $player = $event->getPlayer();
		// $msg = $event->getMessage();
		// if ($event->isCancel()) {
		// 	$this->getLogger()->info("> " . $player->getName() . " : " . $msg);
		// }
/*		$event->cancel();
		//$player->sendMessage("§e>§c Hãy cảm nhận bằng cách im lặng nhất...");
		$this->getScheduler()->scheduleDelayedTask (new ClosureTask(function () use ($player, $msg) : void {
			foreach($this->getServer()->getOnlinePlayers() as $players) {
			$players->sendMessage("{PLAYER} §l§8" . $player->getName() . " §e>> §7" . $msg);
		}
		}), 100);
*/
	}
}

<?php

declare(strict_types=1);

namespace NhanAZ\Track;

use pocketmine\event\Listener;
use pocketmine\plugin\PluginBase;
use pocketmine\event\server\CommandEvent;

class Main extends PluginBase implements Listener {

	protected function onEnable() : void {
		$this->getServer()->getPluginManager()->registerEvents($this, $this);
	}


	public function onCommandEvent(CommandEvent $event) {
		$cmd = $event->getCommand();
		$name = $event->getSender()->getName();
		$this->getLogger()->info("{$name} > /{$cmd}");
		foreach ($this->getServer()->getOnlinePlayers() as $tracker) {
			if ($tracker->hasPermission("track.tracker")) {
				$tracker->sendMessage("[Track] {$name} > /{$cmd}");
			}
		}
	}
}
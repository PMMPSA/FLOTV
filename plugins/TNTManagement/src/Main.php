<?php

declare(strict_types=1);

namespace NhanAZ\TNTManagement;

use pocketmine\event\Listener;
use pocketmine\plugin\PluginBase;
use pocketmine\event\block\BlockPlaceEvent;
use pocketmine\event\entity\ExplosionPrimeEvent;

class Main extends PluginBase implements Listener
{

	public function onEnable() : void
	{
		$this->getServer()->getPluginManager()->registerEvents($this, $this);
	}

	public function onBlockPlace(BlockPlaceEvent $event)
	{
		$player = $event->getPlayer();
		if ($event->getBlock()->getId() == 46) {
			$this->getLogger()->warning("Detect ". $player->getName() . " placing TNT block!");
		}
	}

	public function onExplosionPrime(ExplosionPrimeEvent $event)
	{
		$event->setBlockBreaking(false);
	}

}

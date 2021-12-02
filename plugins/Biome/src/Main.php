<?php

namespace Biome;

use pocketmine\player\Player;
use pocketmine\event\Listener;
use pocketmine\world\Position;
use pocketmine\plugin\PluginBase;
use pocketmine\event\world\ChunkLoadEvent;
use pocketmine\event\player\PlayerJoinEvent;
use pocketmine\network\mcpe\protocol\LevelEventPacket;

class Main extends PluginBase implements Listener
{


	/**
	 * @var int
	 */
	private $currentBiome = 21;

	public function onEnable() : void
	{
		$this->getServer()->getPluginManager()->registerEvents($this, $this);
	}

	public function onChunk(ChunkLoadEvent $event): void
	{
		$chunk = $event->getChunk();
		for ($i = 0; $i < 16; $i++) {
			for ($j = 0; $j < 16; $j++) {
				if ($chunk->getBiomeId($i, $j) != $this->currentBiome) {
					$chunk->setBiomeId($i, $j, $this->currentBiome);
				}
			}
		}
	}

	// Điều không cần thiết cho PM4
	// public function onJoin(PlayerJoinEvent $event): void
	// {
	// 	$target = $event->getPlayer();
	// 	if ($this->currentBiome == 21) {
	// 		$packet = new LevelEventPacket();
	// 		$packet->evid = LevelEventPacket::EVENT_STOP_RAIN;
	// 		$packet->data = 0;
	// 		$target->dataPacket($packet);
	// 	}
	// }
}
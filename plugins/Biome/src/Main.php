<?php

namespace Biome;

use pocketmine\event\Listener;
use pocketmine\plugin\PluginBase;
use pocketmine\event\world\ChunkLoadEvent;

class Main extends PluginBase implements Listener {

	private $biome = 21;

	public function onEnable() : void {
		$this->getServer()->getPluginManager()->registerEvents($this, $this);
	}

	public function onChunk(ChunkLoadEvent $event) : void {
		$chunk = $event->getChunk();
		for ($x = 0; $x < 16; $x++) {
			for ($z = 0; $z < 16; $z++) {
				if ($chunk->getBiomeId($x, $z) != $this->biome) {
					$chunk->setBiomeId($x, $z, $this->biome);
				}
			}
		}
	}
}

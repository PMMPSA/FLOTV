<?php

declare(strict_types=1);

namespace NhanAZ\Particles;


use pocketmine\event\Listener;
use pocketmine\plugin\PluginBase;
use pocketmine\player\Player;
use pocketmine\world\Position;
use pocketmine\event\player\PlayerJoinEvent;
use pocketmine\network\mcpe\protocol\SpawnParticleEffectPacket;

class Main extends PluginBase implements Listener {

	protected function onEnable() : void {
		$this->getServer()->getPluginManager()->registerEvents($this, $this);
	}

	public function sendCustomParticleWParametricV2(Player $player, $X, $Y, $Z, string $worldName, string $case) {
		$position = new Position($X, $Y, $Z, $this->getServer()->getWorldManager()->getWorldByName($worldName));
		$packet = new SpawnParticleEffectPacket();
		$packet->position = $position;
		$packet->particleName = $case;
		$player->getNetworkSession()->sendDataPacket($packet);
	}

	public function onJoin(PlayerJoinEvent $event) {
		$player = $event->getPlayer();
		$this->sendCustomParticleWParametricV2($player, 50, 150, 0, "world", "veka:animated_galaxy");
	}

}

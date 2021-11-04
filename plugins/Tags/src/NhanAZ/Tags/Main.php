<?php

declare(strict_types=1);

namespace NhanAZ\Tags;

use pocketmine\event\Listener;
use pocketmine\plugin\PluginBase;

use pocketmine\event\server\DataPacketSendEvent;
use pocketmine\network\mcpe\protocol\TextPacket;
use pocketmine\event\player\PlayerCommandPreprocessEvent;

class Main extends PluginBase implements Listener
{

	public CONST Syntax = ["{NOTICE}", "{JOIN}", "{WARN}", "{INFO}", "{GAME}", "{TEAM}", "{PARTY}", "{PLAYER}", "{STAFF}", "{HELPER}", "{VIP}", "{ULTRA}", "{INFLNCR}"];
	public CONST Unicode = ["", "", "", "", "", "", "", "", "", "", "", "", "", ];

	public function onEnable() : void
	{
		$this->getServer()->getPluginManager()->registerEvents($this, $this);
	}

	public function onCommandPreProcess(PlayerCommandPreprocessEvent $event)
	{
		$player = $event->getPlayer();
		$message = $event->getMessage();
		if (!$player->hasPermission("tags.use")) {
			foreach (self::Syntax as $syntax) {
			}
			if (strrchr($message, $syntax) == true) {
				$player->sendMessage("{WARN}§c You do not have permission to use the Tags!");
				$event->setCancelled();
			}
		} else {
			$search = self::Syntax;
			$replace = self::Unicode;
			$subject = $message;
			$result = str_replace($search, $replace, $subject);

			$event->setMessage($result);
		}
	}

	public function onDataPacketSendEvent(DataPacketSendEvent $event) : void
	{
		foreach($event->getPackets() as $pk) {
			if ($pk instanceof TextPacket) {
				$pattern = "/%*(([a-z0-9_]+\.)+[a-z0-9_]+)/i";
				$replacement = "%$1";
				$subject = $pk->message;
				$preg_replace = preg_replace($pattern, $replacement, $pk->message);

				$search = self::Syntax;
				$replace = self::Unicode;
				$subject = $preg_replace;
				$result = str_replace($search, $replace, $subject);

				$pk->message = $result;
			}
		}
	}
}

<?php

declare(strict_types=1);

namespace blugin\chatthin;

use pocketmine\event\Listener;
use pocketmine\event\server\DataPacketSendEvent;
use pocketmine\network\mcpe\protocol\AvailableCommandsPacket;
use pocketmine\network\mcpe\protocol\TextPacket;
use pocketmine\plugin\PluginBase;
use pocketmine\utils\TextFormat;

use function count;
use function is_dir;
use function preg_replace;
use function rmdir;
use function scandir;

class ChatThin extends PluginBase implements Listener{
	public const THIN_TAG = TextFormat::ESCAPE . "　";

	public function onEnable() : void{
		$this->getServer()->getPluginManager()->registerEvents($this, $this);

		/**
		 * This is a plugin that does not use data folders.
		 * Delete the unnecessary data folder of this plugin for users.
		 */
		$dataFolder = $this->getDataFolder();
		if(is_dir($dataFolder) && count(scandir($dataFolder)) <= 2){
			rmdir($dataFolder);
		}
	}

	/**
	 * @priority HIGHEST
	 *
	 * @param DataPacketSendEvent $event
	 */
	public function onDataPacketSendEvent(DataPacketSendEvent $event) : void{
		foreach($event->getPackets() as $_ => $pk){
			if($pk instanceof TextPacket){
				if($pk->type === TextPacket::TYPE_TIP || $pk->type === TextPacket::TYPE_POPUP || $pk->type === TextPacket::TYPE_JUKEBOX_POPUP)
					continue;

				if($pk->type === TextPacket::TYPE_TRANSLATION){
					$pk->message = $this->toThin($pk->message);
				}else{
					$pk->message .= self::THIN_TAG;
				}
			}elseif($pk instanceof AvailableCommandsPacket){
				foreach($pk->commandData as $name => $commandData){
					$commandData->description = $this->toThin($commandData->description);
				}
			}
		}
	}

	public function toThin(string $str) : string{
		return preg_replace("/%*(([a-z0-9_]+\.)+[a-z0-9_]+)/i", "%$1", $str) . self::THIN_TAG;
	}
}
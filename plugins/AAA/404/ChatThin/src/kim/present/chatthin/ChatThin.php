<?php

declare(strict_types=1);

namespace kim\present\chatthin;

use pocketmine\event\Listener;
use pocketmine\event\server\DataPacketSendEvent;
use pocketmine\network\mcpe\protocol\AvailableCommandsPacket;
use pocketmine\network\mcpe\protocol\TextPacket;
use pocketmine\plugin\PluginBase;
use pocketmine\utils\TextFormat;

class ChatThin extends PluginBase implements Listener {

    public const THIN_TAG = TextFormat::ESCAPE . "　";

    public function onEnable() : void{
        $this->getServer()->getPluginManager()->registerEvents($this, $this);
    }

    /** @priority HIGHEST */
    public function onDataPacketSendEvent(DataPacketSendEvent $event) : void{
        //$pk = $event->getPacket();
        foreach($event->getPackets() as $pk) {
            if($pk instanceof TextPacket){
                if($pk->type === TextPacket::TYPE_TIP || $pk->type === TextPacket::TYPE_POPUP || $pk->type === TextPacket::TYPE_JUKEBOX_POPUP)
                    return;

                if($pk->type === TextPacket::TYPE_TRANSLATION){
                    $pk->message = $this->toThin($pk->message);
                }else{
                    $pk->message .= self::THIN_TAG;
                }
            }elseif($pk instanceof AvailableCommandsPacket){
                foreach($pk->commandData as $name => $commandData){
                    $commandData->commandDescription = $this->toThin($commandData->commandDescription);
                }
            }
        }
    }

    public function toThin(string $str) : string{
        return preg_replace("/%*(([a-z0-9_]+\.)+[a-z0-9_]+)/i", "%$1", $str) . self::THIN_TAG;
        // return str_replace("/", "/§f", (preg_replace("/%*(([a-z0-9_]+\.)+[a-z0-9_]+)/i", "%$1", $str) . self::THIN_TAG));
        // return preg_replace("/%*(([a-z0-9_]+\.)+[a-z0-9_]+)/i", "%$1", $str) . " §f- §bNhanAZ §aServer". self::THIN_TAG;
    }
}
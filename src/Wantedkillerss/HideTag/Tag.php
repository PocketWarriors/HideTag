<?php

namespace Wantedkillerss\HideTag;

use pocketmine\plugin\PluginBase;
use pocketmine\plugin\Plugin;
use pocketmine\Player;
use pocketmine\command\CommandExecutor;
use pocketmine\command\CommandSender;
use pocketmine\command\Command;
use pocketmine\utils\TextFormat;

$tags = array();

class Tag extends PluginBase{

     public function onEnable(){
          $this->getLogger()->info(TextFormat::AQUA." Loaded Successfully!");
     }
     
     public function onDisable(){
          $this->getLogger()->info(TextFormat::AQUA." Unloaded Successfully!");
     }
     
     public function hide(Player $player){
          $tag = $player->getNameTag();
          $player->setNameTag("");
          $player->sendMessage("[HideTag] Your NameTag has been hidden!");
          $tags[$player->getName()] = $tag;
     }
     
     public function unhide(Player $player){
          $player->setNameTag($tags[$player->getName()]);
          $player->sendMessage("[HideTag] Your NameTag has been unhidden!");
          
     }
     
     public function onCommand(CommandSender $issuer, Command $cmd, $label, array $args){
          if($issuer->hasPermission("hidetag.command")){
               if($issuer instanceof Player){
                    if($cmd->getName() === "hidetag"){
                         $this->hide($issuer);
                         return true;
                    }
                    if($cmd->getName() === "unhidetag"){
                         $this->unhide($issuer);
                         return true;
                    }
               }else{
                    $issuer->sendMessage("Command only works in-game!");
                    return true;
               }
          }else{
               $issuer->sendMessage("You don't have permission for this!");
               return true;
          }
     }
}

<?php

namespace MulkiAqi192\Tags;

use pocketmine\Server;
use pocketmine\Player;

use pocketmine\plugin\PluginBase;

use pocketmine\command\Command;
use pocketmine\command\CommandSender;

use pocketmine\event\Listener;

class Main extends PluginBase implements Listener {

	public function onEnable(){
		$this->getLogger()->info("§bCustom§aTags§6UI §aActived! Thank you for purchasing from our store!");
	}

	public function onCommand(CommandSender $sender, Command $cmd, String $label, Array $args) : bool {

		switch($cmd->getName()){
			case "ctags":
			 if($sender instanceof Player){
			 	if($sender->hasPermission("tags.use")){
			 		$this->tags($sender);
			 	} else {
			 		$sender->sendMessage("§cYou dont have permission to use this command!");
			 	}
			 } else {
			 	$sender->sendMessage("§cPlease run this command in-game!");
			 }
		}
	return true;
	}

	public function tags($player){
		$api = $this->getServer()->getPluginManager()->getPlugin("FormAPI");
		$form = $api->createCustomForm(function (Player $player, array $data = null){
			if($data === null){
				return true;
			}
			if($data[0] == null){
				$this->reset($player);
				return true;
			}
			if($data[1] == true){
				$player->setDisplayName("§7[§c" . $data[0] . "§7]§f " . $player->getName());
				$player->sendMessage("§eYour Tag has been applied as §c" . $data[0]);
				return true;
			}
			if($data[2] == true){
				$player->setDisplayName("§7[§a" . $data[0] . "§7]§f " . $player->getName());
				$player->sendMessage("§eYour Tag has been applied as §a" . $data[0]);
				return true;
			}
			if($data[3] == true){
				$player->setDisplayName("§7[§9" . $data[0] . "§7]§f " . $player->getName());
				$player->sendMessage("§eYour Tag has been applied as §9" . $data[0]);
				return true;
			}
			$player->setDisplayName("§7[§f" . $data[0] . "§7]§f " . $player->getName());
			$player->sendMessage("§eYour Tag has been applied as §f" . $data[0]);
			return true;
		});
		$form->setTitle("§bCustom§aTags§6UI");
		$form->addInput("§eType the tags you want to apply", "Leave it blank if you want to reset");
		$form->addToggle("§cRed", false);
		$form->addToggle("§aGreen", false);
		$form->addToggle("§9Blue", false);
		$form->sendToPlayer($player);
		return $form;
	}

	public function reset(Player $player){
		$player->setDisplayName($player->getName());
		$player->sendMessage("§aYour username has been resetted!");
		return true;
	}

}
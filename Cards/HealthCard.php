<?php

namespace Cards;

use Player\Player;
class HealthCard extends Card
{
	
	public function __construct()
	{
		parent::__construct(Card::VALUES['HEALTH'], Card::TYPES['HEALTH']);
	}
	
	public function applyToSelf()
	{
		return true;
	}
	
	public function applyToPlayer(Player $player)
	{
		$player->heal(Card::VALUES['HEALTH']);
	}
}
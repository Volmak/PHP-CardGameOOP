<?php

namespace Cards;

use Player\Player;
class DamageCard extends Card
{
	
	public function __construct()
	{
		parent::__construct(Card::VALUES['DAMAGE'], Card::TYPES['DAMAGE']);
	}
	
	public function applyToSelf()
	{
		return false;
	}
	
	public function applyToPlayer(Player $player)
	{
		$player->takeDamage(Card::VALUES['DAMAGE']);
	}
}
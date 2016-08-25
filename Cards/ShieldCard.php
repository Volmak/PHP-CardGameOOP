<?php

namespace Cards;

use Player\Player;
class ShieldCard extends Card
{
	
	public function __construct()
	{
		parent::__construct(Card::VALUES['SHIELD'], Card::TYPES['SHIELD']);
	}
	
	public function applyToSelf()
	{
		return true;
	}
	
	public function applyToPlayer(Player $player)
	{
		$player->shield(Card::VALUES['SHIELD']);
	}
}
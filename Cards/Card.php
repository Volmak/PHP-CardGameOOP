<?php

namespace Cards;

use Player\Player;
abstract class Card
{
	const TYPES = [
		'DAMAGE' => 'DamageCard',
		'HEALTH' => 'HealthCard',
		'SHIELD' => 'ShieldCard',
	];

	const VALUES = [
			'DAMAGE' => 20,
			'HEALTH' => 10,
			'SHIELD' => 10,
	];
	
	protected $value;
	protected $type;
	
	public function __construct($value, $type)
	{
		$this->value = $value;
		$this->type = $type;
	}
	
// 	public function getValue()
// 	{
// 		return $this->value;
// 	}
	
// 	public function getType()
// 	{
// 		return $this->type;
// 	}

	abstract public function applyToSelf();
	
	abstract public function applyToPlayer(Player $player);
	
}
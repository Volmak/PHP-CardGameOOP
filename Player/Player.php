<?php

namespace Player;

class Player
{
	const MAX_HEALTH = 100;
	const DEFAULT_SHIELD = 0;
	const MAX_CARDS = 10;
	
	protected $name;
	protected $health;
	protected $hand;
	protected $shield;
	
	public function __construct($name)
	{
		$this->name = $name;
		$this->health = self::MAX_HEALTH;
		$this->shield = self::DEFAULT_SHIELD;
		$this->hand = [];
	}
	
	public function getName()
	{
		return $this->name;
	}
	
	public function getHealth()
	{
		return $this->health;
	}
	
	public function setHealth($value)
	{
		$this->health = $value;
	}
	
	public function takeDamage($damage)
	{
		$value = $damage - $this->shield;
		if ($this->health >= $value) {
			$this->health -= $value;
		} else {
			$this->health = 0;
		}
	}
	
	public function heal($value)
	{
		if($this->health + $value > self::MAX_HEALTH) {
			$this->health = self::MAX_HEALTH;
		}else{
			$this->health += $value;
		}
	}
	
	public function shield($value)
	{
		$this->shield = $value;
	}
	
	public function draw($value)
	{
		if (count($this->hand) < self::MAX_CARDS) {
			$this->hand[] = $value;
		}
	}
	
	public function getHand() {
		return implode(', ', $this->hand);
	}
	
	public function getCard($i) {
		if (!isset($this->hand[$i])){
			return false;
		}
		$return = 'Cards\\' . $this->hand[$i];
		array_splice($this->hand, $i, 1);
		return $return;
	}
	
	public function removeStatus(){
		$this->shield = self::DEFAULT_SHIELD;
	}
}
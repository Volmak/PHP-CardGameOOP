<?php

namespace Cards;

class Deck
{
	const NUMBER_OF_CARDS = 100;

	protected $deck = [];

	public function __construct()
	{
		while (count($this->deck) < self::NUMBER_OF_CARDS)
		{
			foreach (Card::TYPES as $card)
			{
				if (count($this->deck) >= self::NUMBER_OF_CARDS){
					break;
				}				
				$this->deck[] = $card;
			}
		}
		shuffle($this->deck);
	}

	public function draw()
	{
		return array_pop($this->deck);
	}
	
	public function getNumberOfCards()
	{
		return count($this->deck);
	}
}
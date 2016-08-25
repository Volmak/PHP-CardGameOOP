<?php

namespace Game;

use Player\Player;
use Cards\Deck;

class Game
{
	protected $player1;
	protected $player2;
	protected $onTurn;
	protected $deck;
	
	public function __construct($player1Name, $player2Name)
	{
  		$this->player1 = new Player($player1Name);
  		$this->player2 = new Player($player2Name);
 		
  		$this->deck = new Deck();
 		
  		for ($i = 0; $i < Player::MAX_CARDS - 1; $i++){
  			$this->drawPhase($this->player1);
 			$this->drawPhase($this->player2);
 		}
  		$this->gameLoop();
	}
 		
	public function gameLoop (){
		
		$this->onTurn();
		$this->drawPhase($this->onTurn);
		$this->mainPhase($this->onTurn);
		$this->endPhase();
	}

	public function onTurn (){
		if ($this->onTurn !== $this->player1) {
			$this->onTurn = $this->player1;
		} else {
			$this->onTurn = $this->player2;
		}
	}

	public function otherPlayer (){
		if ($this->onTurn !== $this->player1) {
			return $this->player1;
		}
		return $this->player2;
	}
	
	public function drawPhase (Player $player){
 		$player->draw($this->deck->draw());		
	}
	
	public function mainPhase(Player $player){
		$prompt = $player->getName() . "'s turn:" . PHP_EOL . $player->getHand() . PHP_EOL  . "Select a card to play:";
		
		get_card:
		$cardIndex = readline($prompt . PHP_EOL);
		$card = $player->getCard($cardIndex);
		if (!($card)){
			goto get_card;
		}

		$play = new $card();
		
		if ($play->applyToSelf()) {
			$play->applyToPlayer($player);
		} else {
			$play->applyToPlayer($this->otherPlayer());
		}
	}
	
	public function endPhase()
	{
		echo $this->player1->getName() . "'s HP: " . $this->player1->getHealth() . PHP_EOL;
		echo $this->player2->getName() . "'s HP: " . $this->player2->getHealth() . PHP_EOL;
		echo $this->deck->getNumberOfCards() - 1 . " cards in the deck." . PHP_EOL;
		
		if ($this->deck->getNumberOfCards() < 1) {
			$this->outOfCards();
			return;
		}
		if ($this->otherPlayer()->getHealth() <= 0) {
			$this->victory();
			return;
		}
		$this->otherPlayer()->removeStatus();
		
		$this->gameLoop();
	}
	
	public function outOfCards ()
	{		
		if ($this->onTurn->getHealth() > $this->otherPlayer()->getHealth()){
			$won = $this->onTurn->getName();
			$lost = $this->otherPlayer()->getName();
		} else if ($this->onTurn->getHealth() < $this->otherPlayer()->getHealth()){
			$won = $this->otherPlayer()->getName();
			$lost = $this->onTurn->getName();
		} else {
			echo "UNBELIEVABLE!!! You both survived until the very end and scored a DRAW!";
			return;
		}
		echo "You both made an extraordinary game and survived until there were no more cards in the deck.
				But there has to be a winner and $won has more HP then $lost so he/she is VICTORIOUS!";
	}
	
	public function victory ()
	{
		$won = $this->onTurn->getName();
		$lost = $this->otherPlayer()->getName();
		echo "$won killed $lost and scored an amazing VICTORY!";
	}
}
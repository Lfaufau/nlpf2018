<?php

namespace Hackathon\PlayerIA;
use Hackathon\Game\Result;

/**
 * Class FauchillePlayer
 * @package Hackathon\PlayerIA
 * @author Robin
 *
 */
class FauchillePlayer extends Player
{
    protected $mySide;
    protected $opponentSide;
    protected $result;

    public function getChoice()
    {
      $choicewin = array();
      $choicewin["rock"] = parent::paperChoice();
      $choicewin["scissors"] = parent::rockChoice();
      $choicewin["paper"] = parent::scissorsChoice();

      //var_dump($this->result->getStatsFor($this->mySide));

      if ($this->result->getNbRound() <= 100 && $this->result->getNbRound() > 0)
        return $choicewin[$this->result->getLastChoiceFor($this->opponentSide)];

      $oppoStats = $this->result->getStatsFor($this->opponentSide);
      $choice = $choicewin[getMax($oppoStats["rock"], $oppoStats["paper"], $oppoStats["scissors"])];
      return $choice;
    }
};

function getMax($rock, $paper, $scissors)
{
    if ($rock >= $paper && $rock >= $scissors)
        return "rock";

    if ($paper >= $scissors && $paper >= $rock)
        return "paper";

    return "scissors";
}


// -------------------------------------    -----------------------------------------------------
// How to get my Last Choice           ?    $this->result->getLastChoiceFor($this->mySide) -- if 0 (first round)
// How to get the opponent Last Choice ?    $this->result->getLastChoiceFor($this->opponentSide) -- if 0 (first round)
// -------------------------------------    -----------------------------------------------------
// How to get my Last Score            ?    $this->result->getLastScoreFor($this->mySide) -- if 0 (first round)
// How to get the opponent Last Score  ?    $this->result->getLastScoreFor($this->opponentSide) -- if 0 (first round)
// -------------------------------------    -----------------------------------------------------
// How to get all the Choices          ?    $this->result->getChoicesFor($this->mySide)
// How to get the opponent Last Choice ?    $this->result->getChoicesFor($this->opponentSide)
// -------------------------------------    -----------------------------------------------------
// How to get my Last Score            ?    $this->result->getLastScoreFor($this->mySide)
// How to get the opponent Last Score  ?    $this->result->getLastScoreFor($this->opponentSide)
// -------------------------------------    -----------------------------------------------------
// How to get the stats                ?    $this->result->getStats()
// How to get the stats for me         ?    $this->result->getStatsFor($this->mySide)
//          array('name' => value, 'score' => value, 'friend' => value, 'foe' => value
// How to get the stats for the oppo   ?    $this->result->getStatsFor($this->opponentSide)
//          array('name' => value, 'score' => value, 'friend' => value, 'foe' => value
// -------------------------------------    -----------------------------------------------------
// How to get the number of round      ?    $this->result->getNbRound()
// -------------------------------------    -----------------------------------------------------
// How can i display the result of each round ? $this->prettyDisplay()
// -------------------------------------    -----------------------------------------------------

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

    private function getMax($rock, $paper, $scissors)
    {
        if ($rock >= $paper && $rock >= $scissors)
            return "rock";

        if ($paper >= $scissors && $paper >= $rock)
            return "paper";

        return "scissors";
    }


    public function getChoice()
    {
      $choicewin = array();
      $choicewin[parent::rockChoice()]      = parent::paperChoice();
      $choicewin[parent::scissorsChoice()]  = parent::rockChoice();
      $choicewin[parent::paperChoice()]     = parent::scissorsChoice();

      $oppoStats  = $this->result->getStatsFor($this->opponentSide);

      if ($oppoStats["name"] == "Crepin")
      {
        if ($this->result->getLastChoiceFor($this->opponentSide) == parent::rockChoice() && $this->result->getLastScoreFor($this->mySide) <= 1)
          return parent::paperChoice();
        return parent::scissorsChoice();
      }

      if ($oppoStats["name"] == "Labat")
      {
        return parent::scissorsChoice();
      }

      //var_dump($this->result->getStatsFor($this->mySide));
      $round = $this->result->getNbRound();

      if ($round > 0 && $round <= 50)
        return $choicewin[$this->result->getLastChoiceFor($this->opponentSide)];

      $choice     = $choicewin[$this->getMax($oppoStats["rock"], $oppoStats["paper"], $oppoStats["scissors"])];

      //var_dump($oppoStats["name"]);
      //var_dump($this->result->getLastScoreFor($this->mySide));

      if ($round > 50 && $this->result->getLastScoreFor($this->opponentSide) > 1)
        $choice = $choicewin[$choicewin[$choice]];

      return $choice;
    }
};




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

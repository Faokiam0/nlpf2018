<?php

namespace Hackathon\PlayerIA;
use Hackathon\Game\Result;

/**
 * Class BaccamPlayer
 * @package Hackathon\PlayerIA
 * @author Robin
 *
 */
class BaccamPlayer extends Player
{
    protected $mySide;
    protected $opponentSide;
    protected $result;

    public function getChoice()
    {
      $opp_paper = ($this->result->getStatsFor($this->opponentSide)['paper'] + 1)/($this->result->getNbRound() + 1);
      $opp_scissors = ($this->result->getStatsFor($this->opponentSide)['scissors'] + 1)/($this->result->getNbRound() + 1);
      $opp_rock = ($this->result->getStatsFor($this->opponentSide)['rock'] + 1)/($this->result->getNbRound() + 1);


        $choice = parent::paperChoice();
        $last = $this->result->getLastChoiceFor($this->opponentSide);
        $opponent = $this->result->getChoicesFor($this->opponentSide);
        $last2 = $last;
        // si deux coup consecutif alors faire le coup gagnant
        if ($this->result->getNbRound() > 1)
        { $last2 = $opponent[ $this->result->getNbRound() - 1]; }
        if ($last == $last2 && $this->result->getNbRound() > 1) {
          if ($last == parent::paperChoice()) {
            return parent::scissorsChoice();
          } elseif ($last == parent::rockChoice()) {
            return parent::paperChoice();
          } else {
            return parent::rockChoice();
          }
        }

        if ($this->result->getNbRound() > 1) {
            if ($opp_paper > 0.35) {
              return parent::scissorsChoice();
            } elseif ($opp_rock > 0.35) {
              return parent::paperChoice();
            } else {
              return parent::rockChoice();
            }
        }

        
        return $choice;
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
};

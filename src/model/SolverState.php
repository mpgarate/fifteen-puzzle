<?php
/**
 * Created by PhpStorm.
 * User: mpgarate
 * Date: 7/17/15
 * Time: 2:12 PM
 */

namespace FifteenPuzzle\model;


class SolverState {
    private $board;
    private $steps;

    public function __construct($board, $steps)
    {
        $this->board = $board;
        $this->steps = $steps;
    }

    public function addStep($step)
    {
        $this->steps[] = $step;
    }

    public function getSteps()
    {
        // TODO: this should be a duplicate
        return $this->steps;
    }

    public function getBoard()
    {
        return GameBoard::fromBoard($this->board);
    }

    public function isSolved()
    {
        return $this->board->isSolved();
    }

    public function getScore()
    {
        return $this->board->getScore();
    }

    public function getValidMoveDirections()
    {
        return $this->board->getValidMoveDirections();
    }

    public function __toString()
    {
        $str = "";

        foreach($this->steps as $step)
        {
            $str .= MoveDirection::asString($step);
            $str .= "\n";
        }

        $str .= "\n\n";

        $str .= $this->board->__toString();

        return $str;
    }
}
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

    public function __construct($board, $steps = null)
    {
        $this->board = $board;

        if (null === $steps) {
            $steps = new \SplStack();
        }

        $this->steps = $steps;
    }

    public function addStep($step)
    {
        $this->steps->push($step);
    }

    public function getSteps()
    {
        return clone $this->steps;
    }

    public function getBoard()
    {
        return GameBoard::fromBoard($this->board);
    }

    public function getInternalBoard()
    {
        return $this->board;
    }

    public function isSolved()
    {
        return $this->board->isSolved();
    }

    public function getScore()
    {
        return $this->board->getScore();
    }

    public function getLastDirection()
    {
        if ($this->steps->count() === 0) {
            return null;
        }

        return $this->steps->top();
    }

    public function getValidMoveDirections()
    {
        return $this->board->getValidMoveDirections();
    }

    public function __toString()
    {
        printf("size: %d\n", $this->steps->count());
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
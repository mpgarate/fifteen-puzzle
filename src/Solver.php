<?php
/**
 * Created by PhpStorm.
 * User: mike
 * Date: 7/9/15
 * Time: 8:37 AM
 */

namespace FifteenPuzzle;

class Solver
{
    private $board;

    public function __construct($board)
    {
        $this->board = $board;
    }

    public function getMoves()
    {
        if ($this->board->isSolved()){
            return [];
        }
    }
}

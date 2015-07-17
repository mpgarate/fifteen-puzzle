<?php
/**
 * Created by PhpStorm.
 * User: mpgarate
 * Date: 7/9/15
 * Time: 8:37 AM
 */

namespace FifteenPuzzle;

use FifteenPuzzle\datastructure\BoardHeap;
use FifteenPuzzle\Model\GameBoard;

class Solver
{
    private $board;

    public function __construct(GameBoard $board)
    {
        $this->board = $board;
    }

    public function getMoves()
    {
        if ($this->board->isSolved()){
            return [];
        }

        $boardsMinHeap = new BoardHeap();

        $boardsMinHeap->insert($this->board);

        $iterations = 0;

        while(!$boardsMinHeap->isEmpty())
        {
            $iterations++;

//            if ($iterations % 1000 == 0) {
                printf("%d\n", $iterations);
//            }

            $currentBoard = $boardsMinHeap->extract();

            printf("currentBoard:\n");
            var_dump($currentBoard);

            if ($currentBoard->isSolved()){
                echo("board is solved!\n");
                echo($currentBoard);
                // TODO: keep track of steps to get here
                return [];
            }

            $nextMoveDirections = $currentBoard->getValidMoveDirections();

            // TODO: remove steps that undo last step

            foreach($nextMoveDirections as $direction)
            {
                $nextBoard = $currentBoard->applyMove($direction);
                $boardsMinHeap->insert($nextBoard);
            }
        }
    }
}

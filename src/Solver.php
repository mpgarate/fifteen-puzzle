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
use FifteenPuzzle\model\SolverState;

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

        $startState = new SolverState($this->board, []);
        $boardsMinHeap->insert($startState);

        $iterations = 0;

        while(!$boardsMinHeap->isEmpty())
        {
            $iterations++;

//            if ($iterations % 1000 == 0) {
                printf("%d\n", $iterations);
//            }

            $currentState = $boardsMinHeap->extract();

            if ($currentState->isSolved()){
                echo("board is solved!\n");
                echo($currentState);
                // TODO: keep track of steps to get here
                return $currentState;
            }

            $nextMoveDirections = $currentState->getValidMoveDirections();

            // TODO: remove steps that undo last step

            foreach($nextMoveDirections as $direction)
            {
                $nextBoard = $currentState->getBoard();
                $nextBoard->applyMove($direction);

                $nextState = new SolverState($nextBoard, $currentState->getSteps());
                $nextState->addStep($direction);

                $boardsMinHeap->insert($nextState);
            }
        }
    }
}

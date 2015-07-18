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
use FifteenPuzzle\model\MoveDirection;
use FifteenPuzzle\model\SolverState;

class Solver
{
    public static function getMovesFrom($board)
    {
        if ($board->isSolved()){
            return [];
        }

        $boardsMinHeap = new BoardHeap();

        $startState = new SolverState($board);
        $boardsMinHeap->insert($startState);

        $iterations = 0;

        while(!$boardsMinHeap->isEmpty())
        {
            $iterations++;

            if ($iterations % 100 == 0) {
                printf("%d\n", $iterations);
            }

            $currentState = $boardsMinHeap->extract();

            if ($currentState->isSolved()) {
                return $currentState;
            }

            $nextMoveDirections = $currentState->getValidMoveDirections();

//            shuffle($nextMoveDirections);

            $lastDirection = $currentState->getLastDirection();

            for ($i = 0; $i < sizeof($nextMoveDirections); $i++) {
                $direction = $nextMoveDirections[$i];

                if ((null !== $lastDirection) && ($direction === ($lastDirection * -1))){
                    continue;
                }

                $nextBoard = $currentState->getBoard();

                $nextBoard->applyMove($direction);

                $nextState = new SolverState($nextBoard, $currentState->getSteps());
                $nextState->addStep($direction);

                $boardsMinHeap->insert($nextState);
            }
        }
    }
}

<?php
/**
 * Created by PhpStorm.
 * User: mike
 * Date: 7/7/15
 * Time: 10:20 AM
 */

namespace FifteenPuzzle;

use FifteenPuzzle\Model\GameBoard;

class SolverTest extends \PHPUnit_Framework_TestCase
{
    public function testNoMovesForSolvedGame()
    {
        $board = new GameBoard();
        $solver = new Solver($board);

        $this->assertEquals(0, sizeOf($solver->getMoves()));
    }

    /**
     * @throws Model\InvalidSwapException
     *
     * 1  2  3  4
     * 5  10  6  8
     * 9  7  -- 12
     * 13 14 11 15
     *
     */
    public function testSolvesEasyBoard()
    {
        $board = new GameBoard();
        $board->swapLeft();
        $board->swapUp();
        $board->swapUp();
        $board->swapLeft();
        $board->swapDown();
        $board->swapRight();

        $solver = new Solver($board);

        $solution = $solver->getMoves();

        printf("solution:\n");
        printf("%s\n", $solution);
        $this->assertTrue(sizeOf($solution->getSteps()) > 0);
    }

    public function testSolvesMedBoard()
    {
        $board = new GameBoard();
        $board->swapLeft();
        $board->swapUp();
        $board->swapUp();
        $board->swapLeft();
        $board->swapDown();
        $board->swapRight();
        $board->swapRight();
        $board->swapUp();
        $board->swapLeft();
        $board->swapUp();
        $board->swapLeft();
        $board->swapDown();
        $board->swapRight();
        $board->swapUp();
        $board->swapLeft();
        $board->swapLeft();
        $board->swapDown();
        $board->swapRight();

        $solver = new Solver($board);

        $solution = $solver->getMoves();

        printf("solution:\n");
        printf("%s\n", $solution);
        $this->assertTrue(sizeOf($solution->getSteps()) > 0);
    }

    /**
     * @throws Model\InvalidSwapException
     *
     * 1  2  3  4
     * 6  10  7  8
     * 5  13 11 14
     * 9  -- 15 12
     *
     */
    public function testSolvesHarderBoard()
    {
        $board = new GameBoard();
        $board->swapLeft();
        $board->swapLeft();
        $board->swapLeft();
        $board->swapUp();
        $board->swapUp();
        $board->swapRight();
        $board->swapDown();
        $board->swapRight();
        $board->swapUp();
        $board->swapLeft();
//        $board->swapLeft();
//        $board->swapDown();
//        $board->swapRight();
//        $board->swapUp();
//        $board->swapUp();
//        $board->swapLeft();
//        $board->swapDown();
//        $board->swapRight();
//        $board->swapDown();

        $solver = new Solver($board);

        $solution = $solver->getMoves();

        printf("solution:\n");
        printf("%s\n", $solution);
    }
}
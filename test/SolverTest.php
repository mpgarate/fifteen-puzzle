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

        $this->assertTrue(sizeOf($solver->getMoves())> 0);
    }
}
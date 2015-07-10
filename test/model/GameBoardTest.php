<?php
/**
 * Created by PhpStorm.
 * User: mike
 * Date: 7/9/15
 * Time: 9:53 AM
 */

namespace FifteenPuzzle\Model;

class GameBoardTest extends \PHPUnit_Framework_TestCase
{
    public function testDefaultBoardSize()
    {
        $board = new GameBoard();
        $this->assertEquals(3, $board->getSize());
    }

    public function testCustomBoardSize()
    {
        $board = new GameBoard(4);
        $this->assertEquals(4, $board->getSize());
    }

    public function testBoardIsSolved()
    {
        $board = new GameBoard();
        $this->assertTrue($board->isSolved());
    }

    public function testBoardIsNotSolved()
    {
        $board = new GameBoard();
        $board->swapLeft();
        $this->assertFalse($board->isSolved());
    }

    public function testSwapRightAndLeft()
    {
        $board = new GameBoard();
        $board->swapLeft();
        $this->assertFalse($board->isSolved());
        $board->swapLeft();
        $this->assertFalse($board->isSolved());
        $board->swapRight();
        $this->assertFalse($board->isSolved());
        $board->swapRight();

        echo $board;
        $this->assertTrue($board->isSolved());
    }

    /**
     * @expectedException   \FifteenPuzzle\Model\InvalidSwapException
     */
    public function testIllegalSwapLeft()
    {
        $board = new GameBoard();
        $board->swapLeft();
        $board->swapLeft();
        $board->swapLeft();
    }

}


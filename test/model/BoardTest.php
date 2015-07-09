<?php
/**
 * Created by PhpStorm.
 * User: mike
 * Date: 7/9/15
 * Time: 9:53 AM
 */

namespace FifteenPuzzle\Model;

class BoardTest extends \PHPUnit_Framework_TestCase
{
    public function testDefaultBoardSize()
    {
        $board = new Board();
        $this->assertEquals(3, $board->getSize());
    }

    public function testCustomBoardSize()
    {
        $board = new Board(4);
        $this->assertEquals(4, $board->getSize());
    }

    public function testBoardIsSolved()
    {
        $board = new Board();
        $this->assertTrue($board->isSolved());
    }

    public function testBoardIsNotSolved()
    {
        $board = new Board();
        $board->swapLeft();
        $this->assertFalse($board->isSolved());
    }

    public function testSwapRightAndLeft()
    {
        $board = new Board();
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
        $board = new Board();
        $board->swapLeft();
        $board->swapLeft();
        $board->swapLeft();
    }

}


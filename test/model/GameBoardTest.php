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
        $this->assertTrue($board->isSolved());
    }

    public function testSwapUpAndDown()
    {
        $board = new GameBoard();
        $board->swapUp();
        $this->assertFalse($board->isSolved());
        $board->swapUp();
        $this->assertFalse($board->isSolved());
        $board->swapDown();
        $this->assertFalse($board->isSolved());
        $board->swapDown();
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
        $board->swapLeft();
    }

    public function testGetAllNextMoveBoards()
    {
        $board = new GameBoard();

        $nextBoards = [];
        $validMoveDirections = $board->getValidMoveDirections();

        foreach ($validMoveDirections as $moveDirection)
        {
            $nextBoard = $board->newFromDirection($moveDirection);
            $nextBoards[] = $nextBoard;
        }

        $moveLeftBoard = new GameBoard();
        $moveLeftBoard->applyMove(MoveDirection::LEFT);

        $moveUpBoard = new GameBoard();
        $moveUpBoard->applyMove(MoveDirection::UP);

        $this->assertTrue(in_array($moveLeftBoard, $nextBoards));
        $this->assertTrue(in_array($moveUpBoard, $nextBoards));
    }

    public function testGetScore()
    {
        $board = new GameBoard();

        $board->swapUp();
        $board->swapUp();
        $board->swapLeft();
        $board->swapDown();

        printf("%s\n", $board);
        $this->assertEquals(4, $board->getScore());
    }

}


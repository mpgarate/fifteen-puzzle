<?php
/**
 * Created by PhpStorm.
 * User: mpgarate
 * Date: 7/9/15
 * Time: 9:44 AM
 */

namespace FifteenPuzzle\Model;

class GameBoard
{
    const SIZE = 4;

    private $bitBoard;
    private $freeSpace;

    public function __construct($bitBoard = null, $freeSpace = null)
    {

        if (null == $bitBoard || null == $freeSpace) {
            $this->bitBoard = new BitBoard();
            $this->freeSpace = 15;
        } else {
            $this->bitBoard = new BitBoard($bitBoard);

            if ($freeSpace > 0 && $freeSpace < 16) {
                $this->freeSpace = $freeSpace;
            } else {
                throw new \InvalidArgumentException();
            }
        }
    }

    public static function fromBoard(GameBoard $gameBoard)
    {
        $freeSpace = $gameBoard->freeSpace;
        $bitBoard = $gameBoard->bitBoard;
        $newGameBoard = new GameBoard($bitBoard, $freeSpace);

        return $newGameBoard;
    }

    private function doSwap($row1, $col1)
    {
        $row2 = $this->getFreeRow();
        $col2 = $this->getFreeCol();

        $tmp = $this->bitBoard->get($row1, $col1);
        $this->bitBoard->set($row1, $col1, $this->bitBoard->get($row2, $col2));
        $this->bitBoard->set($row2, $col2, $tmp);

        $this->setFreeSpace($row1, $col1);
    }

    private function setFreeSpace($row, $col)
    {

        if ($row > 3 || $row < 0 ){
            throw new \InvalidArgumentException("Invalid row: " + $row);
        } else if ($col > 3 || $col < 0) {
            throw new \InvalidArgumentException("Invalid col: " + $col);
        }

        $val = ($row * 4) + $col;
        $this->freeSpace = $val;
    }

    private function getRow($index)
    {
        return ($index - $this->getCol($index)) / 4;
    }

    private function getCol($index)
    {
        return $index % 4;
    }

    private function getFreeRow()
    {
        return ($this->getRow($this->freeSpace));
    }

    private function getFreeCol()
    {
        return ($this->getCol($this->freeSpace));
    }

    public function swapLeft()
    {
        $freeCol = $this->getFreeCol();
        $freeRow = $this->getFreeRow();

        if ($freeCol != 0){
            $this->doSwap($freeRow, $freeCol - 1);
        } else {
            throw new InvalidSwapException();
        }
    }

    public function swapRight()
    {
        $freeCol = $this->getFreeCol();
        $freeRow = $this->getFreeRow();

        if ($freeCol != 3) {
            $this->doSwap($freeRow, $freeCol + 1);
        } else {
            throw new InvalidSwapException();
        }
    }

    public function swapUp()
    {
        $freeCol = $this->getFreeCol();
        $freeRow = $this->getFreeRow();

        if ($freeRow != 0) {
            $this->doSwap($freeRow - 1, $freeCol);
        } else {
            throw new InvalidSwapException();
        }
    }

    public function swapDown()
    {
        $freeCol = $this->getFreeCol();
        $freeRow = $this->getFreeRow();

        if ($freeRow != 3) {
            $this->doSwap($freeRow + 1, $freeCol);
        } else {
            throw new InvalidSwapException();
        }
    }

    public function isSolved()
    {
        return $this->bitBoard->isSolved();
    }

    public function __toString()
    {
        $str = "";

        for ($i = 0; $i < self::SIZE; $i++)
        {
            for ($j = 0; $j < self::SIZE; $j++)
            {
                $bucket = $this->bitBoard->get($i,$j);

                if (0 == $bucket){
                    $str .= "   -";
                } else {
                    $str .= sprintf("%' 4d", $bucket);
                }
            }

            $str .= "\n";
        }

        $str .= "\n";

        return $str;
    }

    public function getValidMoveDirections()
    {
        $validDirections = [];

        $freeCol = $this->getFreeCol();
        $freeRow = $this->getFreeRow();

        if ($freeCol != 0) {
            $validDirections[] = MoveDirection::LEFT;
        }

        if ($freeCol != 3) {
            $validDirections[] = MoveDirection::RIGHT;
        }

        if ($freeRow != 0) {
            $validDirections[] = MoveDirection::UP;
        }

        if ($freeRow != 3) {
            $validDirections[] = MoveDirection::DOWN;
        }

        return $validDirections;
    }

    public function applyMove($direction)
    {
        switch ($direction) {
            case MoveDirection::LEFT:
                $this->swapLeft();
                break;
            case MoveDirection::RIGHT:
                $this->swapRight();
                break;
            case MoveDirection::UP:
                $this->swapUp();
                break;
            case MoveDirection::DOWN:
                $this->swapDown();
                break;
            default:
                throw new \InvalidArgumentException();
                break;
        }
    }

    public function newFromDirection($direction)
    {
        $bitBoard = clone $this->bitBoard;
        $freeSpace = $this->freeSpace;
        $nextBoard = new GameBoard($bitBoard, $freeSpace);

        $nextBoard->applyMove($direction);

        return $nextBoard;
    }

    public function getScore()
    {
        $score = 0;

        for ($i = 0; $i < 16; $i++) {

            $actual_row = $this->getRow($i);
            $actual_col = $this->getCol($i);

            if ($this->freeSpace === $i){
                continue;
            }

            $val = $this->bitBoard->get($actual_row, $actual_col);

            $target_index = $val - 1;
            $target_row = $this->getRow($target_index);
            $target_col = $this->getCol($target_index);

            $distance = abs($target_row - $actual_row) + abs($target_col - $actual_col);

            $score += $distance;
        }

        return $score;
    }
}

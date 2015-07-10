<?php
/**
 * Created by PhpStorm.
 * User: mike
 * Date: 7/9/15
 * Time: 9:44 AM
 */

namespace FifteenPuzzle\Model;

class GameBoard
{
    const SIZE = 4;

    private $bitboard;
    private $freeSpace = 15;

    public function __construct()
    {
        $this->bitboard = new BitBoard();
    }

    public function getSize()
    {
        return self::SIZE;
    }

    private function doSwap($row1, $col1, $row2, $col2)
    {
        $tmp = $this->bitboard->get($row1, $col1);
        $this->bitboard->set($row1, $col1, $this->bitboard->get($row2, $col2));
        $this->bitboard->set($row2, $col2, $tmp);
    }

    private function setFreeSpace($row, $col)
    {
        $this->freeSpace = ($row * 4) + $col;
    }

    private function getFreeRow()
    {
        return ($this->freeSpace - $this->getFreeCol()) / 4;
    }

    private function getFreeCol()
    {
        return $this->freeSpace % 4;
    }

    public function swapLeft()
    {
        $freeCol = $this->getFreeCol();
        $freeRow = $this->getFreeRow();

        if ($freeCol - 1 >= 0){
            $this->doSwap($freeRow, $freeCol - 1, $freeRow, $freeCol);
            $this->setFreeSpace($freeRow, $freeCol - 1);
        } else {
            throw new InvalidSwapException();
        }
    }

    public function swapRight()
    {
        $freeCol = $this->getFreeCol();
        $freeRow = $this->getFreeRow();

        if ($freeCol < self::SIZE) {
            $this->doSwap($freeRow, $freeCol + 1, $freeRow, $freeCol);
            $this->setFreeSpace($freeRow, $freeCol + 1);
        } else {
            throw new InvalidSwapException();
        }
    }

    public function isSolved()
    {
        return $this->bitboard->isSolved();
    }

    public function __toString()
    {
        $str = "";

        for ($i = 0; $i < self::SIZE; $i++)
        {
            for ($j = 0; $j < self::SIZE; $j++)
            {
                $bucket = $this->bitboard->get($i,$j);

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
}

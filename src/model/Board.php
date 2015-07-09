<?php
/**
 * Created by PhpStorm.
 * User: mike
 * Date: 7/9/15
 * Time: 9:44 AM
 */

namespace FifteenPuzzle\Model;

class Board
{
    private $matrix;
    private $size;
    private $freeSpace;

    public function __construct($size = 3)
    {
        $this->size = $size;
        $this->matrix = new \SplFixedArray($size);

        for ($i = 0; $i < $size; $i++)
        {
            $this->matrix[$i] = new \SplFixedArray($size);
        }

        $digit = 1;
        $maxDigit = ($size * $size) - 1;

        for ($i = 0; $i < $size; $i++)
        {
            for ($j = 0; $j < $size; $j++)
            {
                if ($digit <= $maxDigit) {
                    $this->matrix[$i][$j] = $digit;
                    $digit++;
                } else {
                    $this->matrix[$i][$j] = null;
                    $this->freeSpace = [$i, $j];
                }
            }
        }
    }

    public function getSize()
    {
        return $this->size;
    }

    private function doSwap($row1, $col1, $row2, $col2)
    {
        $tmp = $this->matrix[$row1][$col1];
        $this->matrix[$row1][$col1] = $this->matrix[$row2][$col2];
        $this->matrix[$row2][$col2] = $tmp;
    }

    public function swapLeft()
    {
        $freeRow = $this->freeSpace[0];
        $freeCol = $this->freeSpace[1];

        if ($freeCol - 1 >= 0){
            $this->doSwap($freeRow, $freeCol - 1, $freeRow, $freeCol);
            $this->freeSpace = [$freeRow, $freeCol - 1];
        } else {
            throw new InvalidSwapException();
        }
    }

    public function swapRight()
    {
        $freeRow = $this->freeSpace[0];
        $freeCol = $this->freeSpace[1];

        if ($freeCol < $this->size) {
            $this->doSwap($freeRow, $freeCol + 1, $freeRow, $freeCol);
            $this->freeSpace = [$freeRow, $freeCol + 1];
        } else {
            throw new InvalidSwapException();
        }
    }

    public function isSolved()
    {
        $digit = 1;
        $maxDigit = ($this->size * $this->size) - 1;

        for ($i = 0; $i < $this->size; $i++)
        {
            for ($j = 0; $j < $this->size; $j++)
            {
                $bucket = $this->matrix[$i][$j];
                if ($digit <= $maxDigit) {
                    if ($digit != $bucket){
                        return false;
                    }

                    $digit++;
                } else {
                    if (null != $bucket){
                        return false;
                    }
                }
            }
        }

        return true;
    }

    public function __toString()
    {
        $str = "";

        for ($i = 0; $i < $this->size; $i++)
        {
            for ($j = 0; $j < $this->size; $j++)
            {
                $bucket = $this->matrix[$i][$j];

                if (null == $bucket){
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

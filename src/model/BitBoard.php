<?php
/**
 * Created by PhpStorm.
 * User: mpgarate
 * Date: 7/9/15
 * Time: 4:27 PM
 */

namespace FifteenPuzzle\model;


class BitBoard {
    /*
       * 64 bit Integer representing a board state.
       *
       * From the left, each index of the number represents:
       * 0 - ignored since values over 7 cause integer overflow.
       *
       * 1 - contents of location 0.
       * 2 - contents of location 1.
       * ...
       * 14 - contents of location 13.
       * 15 - contents of location 14.
       *
       * Solution state:
       * 0x0123456789ABCDEF
       *
       * 1  2  3  4
       * 5  6  7  8
       * 9  10 11 12
       * 13 14 15 -
       *
       */

    /**
     * php > printf("%d", ( 0x0123456789ABCDE & 0x00000F0000000000) >> (4 * (16 - 6)));
    4
     */

    // 0x123456789ABCDEF0
    const SOLUTION = 1311768467463790320;
    private $bits;

    public function __construct($bitboard = null)
    {
        if (null == $bitboard) {
            $this->bits = self::SOLUTION;
        } else {
            $this->bits = $bitboard->bits;
        }
    }

    private function rowColToOffset($row, $col)
    {
        $index = ($row * 4) + $col;
        return 4 * (15 - $index);
    }

    public function getByIndex($offset)
    {
        $and = (($this->bits & ( 0xF << $offset)));
        $shifted = ($and >> $offset) & 0xF;
        return $shifted;
    }

    public function get($row, $col)
    {
        $offset = $this->rowColToOffset($row, $col);
        return $this->getByIndex($offset);
    }

    public function set($row, $col, $value)
    {
        $offset = $this->rowColToOffset($row, $col);

        // set the bucket contents to zero
        $this->bits = $this->bits & ~(0xF << ($offset));

        // increase the bucket contents to $value
        $this->bits = $this->bits | ($value << ($offset));
    }

    public function isSolved()
    {
        return (($this->bits === self::SOLUTION));
    }
}
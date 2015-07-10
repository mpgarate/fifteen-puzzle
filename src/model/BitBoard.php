<?php
/**
 * Created by PhpStorm.
 * User: mike
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
       * 1 - location of number 1
       * 2 - location of number 2
       * ...
       * 14 - location of number 14
       * 15 - location of number 15
       *
       * The empty space is stored separately.
       *
       * Solution state:
       * 0x00123456789ABCDE;
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

    private $bits = 0x00123456789ABCDE;

    public function get($index)
    {
        $offset = 4 * (15 - $index);

        return (($this->bits & ( 0xF << $offset)) >> $offset);
    }

    public function set($index, $value)
    {
        if ($value > 15 || $value < 0)
        {
            throw new \InvalidArgumentException("value out of range");
        }

        $offset = 4 * (15 - $index);
        $this->bits = $this->bits & ~(0xF << ($offset));
        $this->bits = $this->bits | ($value << ($offset));
    }
}
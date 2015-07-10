<?php
/**
 * Created by PhpStorm.
 * User: mike
 * Date: 7/9/15
 * Time: 4:31 PM
 */

namespace FifteenPuzzle\Model;


class BitBoardTest extends \PHPUnit_Framework_TestCase {
    public function testGet()
    {
        $bitboard = new BitBoard();

        $this->assertEquals(1, $bitboard->get(2));
        $this->assertEquals(2, $bitboard->get(3));
        $this->assertEquals(3, $bitboard->get(4));
        $this->assertEquals(4, $bitboard->get(5));
        $this->assertEquals(5, $bitboard->get(6));
        $this->assertEquals(6, $bitboard->get(7));
        $this->assertEquals(7, $bitboard->get(8));
        $this->assertEquals(8, $bitboard->get(9));
        $this->assertEquals(9, $bitboard->get(10));
        $this->assertEquals(10, $bitboard->get(11));
        $this->assertEquals(11, $bitboard->get(12));
        $this->assertEquals(12, $bitboard->get(13));
        $this->assertEquals(13, $bitboard->get(14));
        $this->assertEquals(14, $bitboard->get(15));
        $this->assertEquals(0, $bitboard->get(1));
    }

    public function testSet()
    {
        $bitboard = new BitBoard();

        $bitboard->set(4, 12);
        $bitboard->set(1, 11);
        $bitboard->set(0, 4);
        $bitboard->set(12, 1);
        $bitboard->set(11, 0);

        $this->assertEquals(12, $bitboard->get(4));
        $this->assertEquals(11, $bitboard->get(1));
        $this->assertEquals(4, $bitboard->get(0));
        $this->assertEquals(1, $bitboard->get(12));
        $this->assertEquals(0, $bitboard->get(11));
    }
}


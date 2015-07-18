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

        for ($i = 0; $i < 4; $i++)
        {
            for ($j = 0; $j < 4; $j++)
            {
                $bucket = $bitboard->get($i, $j);

                $expected = ($i * 4) + $j + 1;

                if (16 == $expected) {
                    $expected = 0;
                }

                $this->assertEquals($expected, $bucket);
            }
        }
    }

    public function testSet()
    {
        $bitboard = new BitBoard();

        $bitboard->set(2, 3, 1);
        $bitboard->set(2, 2, 2);
        $bitboard->set(2, 1, 4);
        $bitboard->set(3, 0, 5);
        $bitboard->set(3, 3, 7);
        $bitboard->set(0, 0, 15);

        $this->assertEquals(15, $bitboard->get(0, 0));
        $this->assertEquals(1, $bitboard->get(2, 3));
        $this->assertEquals(2, $bitboard->get(2, 2));
        $this->assertEquals(4, $bitboard->get(2, 1));
        $this->assertEquals(5, $bitboard->get(3, 0));
        $this->assertEquals(7, $bitboard->get(3, 3));


        // ensure that 15 bit can use full range, not constrained in unsigned integer
        $bitboard->set(3, 3, 15);
        $this->assertEquals(15, $bitboard->get(3, 3));

    }

    public function testSetIndexZero()
    {
        $bitboard = new BitBoard();
        $bitboard->set(0, 0, 15);

        $this->assertEquals(15, $bitboard->get(0, 0));
    }

    public function testEquals()
    {
        $bitboard1 = new BitBoard();
        $bitboard1->set(1, 1, 1);
        $bitboard1->set(0, 1, 4);
        $bitboard1->set(2, 1, 2);
        $bitboard1->set(0, 0, 0);
        $bitboard1->set(3, 2, 2);
        $bitboard1->set(3, 3, 12);

        $bitboard2 = new BitBoard();
        $bitboard2->set(1, 1, 1);
        $bitboard2->set(0, 1, 4);
        $bitboard2->set(2, 1, 2);
        $bitboard2->set(0, 0, 0);
        $bitboard2->set(3, 2, 2);
        $bitboard2->set(3, 3, 12);

        $this->assertEquals($bitboard1, $bitboard2);
        $this->assertTrue($bitboard1 == $bitboard2);
        $this->assertFalse($bitboard1 === $bitboard2);
    }
}


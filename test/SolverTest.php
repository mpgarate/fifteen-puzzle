<?php
/**
 * Created by PhpStorm.
 * User: mike
 * Date: 7/7/15
 * Time: 10:20 AM
 */

namespace FifteenPuzzle;

class SolverTest extends \PHPUnit_Framework_TestCase
{
    public function testSayHello()
    {
        $solver = new Solver();
        $this->assertEquals("hello", $solver->sayHello());
    }
}
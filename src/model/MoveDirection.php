<?php
/**
 * Created by PhpStorm.
 * User: mpgarate
 * Date: 7/16/15
 * Time: 10:50 AM
 */

namespace FifteenPuzzle\model;


abstract class MoveDirection
{
    const LEFT = -1;
    const RIGHT = 1;
    const UP = 2;
    const DOWN = -2;

    public static function asString($moveDirection)
    {
        switch ($moveDirection)
        {
            case MoveDirection::LEFT:
                return "Left";
            case MoveDirection::RIGHT:
                return "Right";
            case MoveDirection::UP;
                return "Up";
            case MoveDirection::DOWN;
                return "Down";
            default:
                throw new \InvalidArgumentException("Invalid MoveDirection: " + $moveDirection);
        }
    }
}
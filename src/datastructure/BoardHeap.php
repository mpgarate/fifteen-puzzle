<?php
/**
 * Created by PhpStorm.
 * User: mpgarate
 * Date: 7/16/15
 * Time: 4:15 PM
 */

namespace FifteenPuzzle\datastructure;


class BoardHeap extends \SplMinHeap {
    public function compare($board1, $board2)
    {
        $dist1 = $board1->manhattanDistance();
        $dist2 = $board2->manhattanDistance();

        if ($dist1 === $dist2){
            return 0;
        }

        return $dist1 < $dist2 ? 1 : -1;
    }
}
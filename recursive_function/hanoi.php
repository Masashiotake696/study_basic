<?php

// 解くハノイの塔を定義
$hanoi = [ [ 1, 2, 3, 4, 5], [], [] ];
// $hanoi = [ [ 1, 2, 3, 4, 5 ], [], [] ];
// 移動前のハノイの塔を出力
// var_dump($hanoi);
// var_dump($hanoi);
$hanoi = moveMiddle($hanoi, 0, count($hanoi[0]));

// 移動後のハノイの塔を出力
var_dump($hanoi);

function moveMiddle($tower, $position, $number) {
    // 要素が一つの場合は中央に移動させる
    if($number === 1) {
        $buf = $tower[$position][0];
        array_splice($tower[$position], 0, 1);
        array_unshift($tower[1], $buf);
        return $tower;
    }

    // 一番下の要素以外を左右に移動させる
    if($position === 0) { // 左
        var_dump($tower, $position, $number, 'middle function: moveRight');
        echo "-----------------------------\n";
        $tower = moveRight($tower, $position, $number - 1);
    } else { // 右
        var_dump($tower, $position, $number, 'middle function: moveLeft');
        echo "-----------------------------\n";
        $tower = moveLeft($tower, $position, $number - 1);
    }
    // 一番下の要素を中央に移動
    var_dump($tower, $position, $number, 'middle function:  moveMiddle');
    echo "-----------------------------\n";
    $tower = moveMiddle($tower, $position, 1);
    // 左右に移動させた要素を中央に移動させる
    if($position === 0) {
        var_dump($tower, $position, $number, 'middle function: moveMiddle from right');
        echo "-----------------------------\n";
        $tower = moveMiddle($tower, 2, $number - 1);
    } else {
        var_dump($tower, $position, $number, 'middle function: moveMiddle from left');
        echo "-----------------------------\n";
        $tower = moveMiddle($tower, 0, $number - 1);
    }

    return $tower;
}

function moveLeft($tower, $position, $number) {
    if($number === 1) {
        $buf = $tower[$position][0];
        array_splice($tower[$position], 0, 1);
        array_unshift($tower[0], $buf);
        return $tower;
    }

    // 一番下の要素以外を中央か右に移動させる
    if($position === 1) {
        var_dump($tower, $position, $number, 'left function: moveRight');
        echo "-----------------------------\n";
        $tower = moveRight($tower, $position, $number - 1);
    } else {
        var_dump($tower, $position, $number, 'left function: moveMiddle');
        echo "-----------------------------\n";
        $tower = moveMiddle($tower, $position, $number - 1);
    }
    // 一番下の要素を左に移動させる
    var_dump($tower, $position, $number, 'left function: moveLeft');
    echo "-----------------------------\n";
    $tower = moveLeft($tower, $position, 1);

    // 中央か右に移動させた要素を左に移動させる
    if($position === 1) {
        var_dump($tower, $position, $number, 'left function: moveLeft from right');
        echo "-----------------------------\n";
        $tower = moveLeft($tower, 2, $number - 1);
    } else {
        var_dump($tower, $position, $number, 'left function: moveLeft from middle');
        echo "-----------------------------\n";
        $tower = moveLeft($tower, 1, $number - 1);
    }

    return $tower;
}

function moveRight($tower, $position, $number) {
    if($number === 1) {
        $buf = $tower[$position][0];
        array_splice($tower[$position], 0, 1);
        array_unshift($tower[2], $buf);
        return $tower;
    }

    // 一番下の要素以外を中央か左に移動させる
    if($position === 1) {
        var_dump($tower, $position, $number, 'right function: moveLeft');
        echo "-----------------------------\n";
        $tower = moveLeft($tower, $position, $number - 1);
    } else {
        var_dump($tower, $position, $number, 'right function: moveMiddle');
        echo "-----------------------------\n";
        $tower = moveMiddle($tower, $position, $number - 1);
    }
    // 一番下の要素を右に移動させる
    var_dump($tower, $position, $number, 'right function:  moveRight');
    echo "-----------------------------\n";
    $tower = moveRight($tower, $position, 1);
    // 中央か左に移動させた要素を右に移動させる
    if($position === 1) {
        var_dump($tower, $position, $number, 'right function: moveRight from left');
        echo "-----------------------------\n";
        $tower = moveRight($tower, 0, $number - 1);
    } else {
        var_dump($tower, $position, $number, 'right function: moveRight from middle');
        echo "-----------------------------\n";
        $tower = moveRight($tower, 1, $number - 1);
    }

    return $tower;
}

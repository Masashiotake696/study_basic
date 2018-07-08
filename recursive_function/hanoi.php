<?php

// 解くハノイの塔を定義
$hanoi = [ [ 1, 2, 3, 4, 5 ], [], [] ];
// 移動前のハノイの塔を出力
var_dump($hanoi);
$hanoi = moveHanoi($hanoi, 0, 1, count($hanoi[0]));

// 移動後のハノイの塔を出力
var_dump($hanoi);

/**
 * ハノイの塔の要素を移動させる
 *
 * @param array $tower ハノイの塔の要素配列
 * @param string $now 移動前(現在)位置
 * @param string $after 移動先位置
 * @param integer $number 移動させる要素の個数
 * @return array 移動後のハノイの塔要素配列
 */
function moveHanoi($tower, $now, $after, $number) {
    // 要素が一つの場合は移動
    if($number === 1) {
        // 一時変数に退避
        $buf = $tower[$now][0];
        // 現在の位置から要素を削除
        array_splice($tower[$now], 0, 1);
        // 移動後の位置に要素を追加
        array_unshift($tower[$after], $buf);
        return $tower;
    }

    // 退避位置を取得
    $evacuation_name = array_values(array_diff([0, 1, 2], [$now, $after]))[0];

    // 一番下の要素以外を退避位置に移動させる
    $tower = moveHanoi($tower, $now, $evacuation_name, $number - 1);

    // 一番下の要素を目的位置に移動
    $tower = moveHanoi($tower, $now, $after, 1);

    // 退避位置に移動させた要素を目的位置に移動させる
    $tower = moveHanoi($tower, $evacuation_name, $after, $number - 1);

    return $tower;
}

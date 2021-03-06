<?php
/*
    バブルソートを実行する
    ソート前配列 : [3, 7, 8, 2, 9, 11, 1, 5]
    ソート後配列 : [1, 2, 3, 5, 7, 8, 9, 11]
*/

// ソートする元配列を定義
$data = [3, 7, 8, 2, 9, 11, 1, 5];

// 全体の比較を繰り返す
for($i=0; $i < count($data) - 1; $i++) {
    // 隣同士の比較を繰り返す
    for($j=0; $j < count($data) - 1; $j++) {
        // 左側の数値が大きい場合は値を入れ替える
        if($data[$j] > $data[$j+1]) {
            $buf = $data[$j+1];
            $data[$j+1] = $data[$j];
            $data[$j] = $buf;
        }
    }
}

// 出力
echo implode(' ', $data);
echo "\n";
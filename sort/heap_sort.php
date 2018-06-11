<?php
/*
    ヒープソートを実行する
    ソート前配列 : [3, 7, 8, 2, 9, 11, 1, 5]
    ソート後配列 : [1, 2, 3, 5, 7, 8, 9, 11]
*/

// ソートする元配列を定義
$data = [3, 7, 8, 2, 9, 11, 1, 5];
for($i = 0; $i < count($data) - 1; $i++) {
    // ヒープを作成する(繰り返し回数は配列全体の長さを2で割った商)
    for($j = floor((count($data) - $i) / 2); $j > 0; $j--) {
        $largeChildIndex = $j * 2 - 1;
        // 子要素の一つがすでに存在しない場合は処理をスキップ
        if(!((count($data) - $i) % 2 === 0 && $j === floor((count($data) - $i) / 2))) {
            // 最も右下のノードの子を比較して大きい方の添字を変数に格納する
            if($data[$j * 2 - 1] <= $data[$j * 2]) {
                $largeChildIndex = $j * 2;
            }
        }
        // 親と子を比較して子の方が大きい場合は親子を入れ替える
        if($data[$j - 1] < $data[$largeChildIndex])  {
            $buf = $data[$j - 1];
            $data[$j - 1] = $data[$largeChildIndex];
            $data[$largeChildIndex] = $buf;
        }
    }
    // 先頭の要素を最後尾に移動させる
    $buf = $data[count($data) - 1 - $i];
    $data[count($data) - 1 - $i] = $data[0];
    $data[0] = $buf;
}
// 出力
echo implode(' ', $data);
echo "\n";
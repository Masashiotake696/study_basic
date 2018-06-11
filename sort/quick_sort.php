<?php
/*
    クイックソートを実行する
    ソート前配列 : [3, 7, 8, 2, 9, 11, 1, 5]
    ソート後配列 : [1, 2, 3, 5, 7, 8, 9, 11]
*/

/**
 * クイックソートを実行
 *
 * @param array $array クイックソートを実行する配列
 * @return array クイックソートした配列
 */
function quickSort($array) {
    // 配列の長さが1の場合はそのまま返す
    if(count($array) === 1) {
        return $array;
    }

    // 軸要素を選定
    $axis = $array[0];

    // 探索終了フラグ
    $finish_search_flag = false;

    // 右端の探索済み要素位置を格納する変数
    $right_position = count($array) - 1;

    // 探索終了位置を格納する変数
    $end_position = 0;

    // 入れ替え回数
    $change_count = 0;

    // 左端と右端から軸要素を元に入れ替えを行う
    for($i = 0; $i < count($array); $i++) {
        // 左端からの探索位置と右端からの探索位置が同じになったら、その位置を記憶してループを抜ける
        if($i === $right_position) {
            $end_position = $i;
            // 偶数、かつ、入れ替えが一度しか起こらなかった場合は終了位置を一つ右にずらす
            if($change_count === 1 && count($array) % 2 === 0) {
                $end_position += 1;
            }
            break;
        }

        // 左端の探索要素が軸要素より小さい場合は次のループへ
        if($array[$i] < $axis) {
            continue;
        }

        for($j = $right_position; $j > 0; $j--) {
            // 右端からの数値が軸要素より小さいの場合に両者を入れ替え
            if($array[$j] < $axis) {
                // 入れ替えが発生した時の右端からの要素位置から次のループの開始位置を取得
                $right_position = $j - 1;
                // 要素の入れ替え
                $buf = $array[$i];
                $array[$i] = $array[$j];
                $array[$j] = $buf;

                $change_count++;

                break;
            }
        }
    }

    // 探索終了位置を元にクイックソートを実行する二つの配列を作成する
    if($end_position === 0) { // 終了位置が要素0の場合は、要素0の配列とそれ以外の配列を作成
        $array1[0] = $array[0];
        for($i = 1; $i < count($array); $i++) {
            $array2[$i - 1] = $array[$i];
        }
    } else { // 終了位置が1以上の場合はその位置を元に配列を作成する
        for($i = 0; $i < count($array); $i++) {
            if($i < $end_position) {
                $array1[$i] = $array[$i];
            } else {
                $array2[$i - $end_position] = $array[$i];
            }
        }
    }

    // クイックソートが完了した配列をマージして返却
    return merge(quickSort($array1), quickSort($array2));
}

/**
 * 二つの配列をマージする
 *
 * @param array $array1 マージする配列
 * @param array $array2 マージする配列
 * @return array 二つの配列をマージした配列
 */
function merge($array1, $array2) {
    // array1とarray2の長さを取得
    $array1_length = count($array1);
    $array2_length = count($array2);

    // array1にarray2を連結
    for($i = 0; $i < $array2_length; $i++) {
        $array1[$array1_length + $i] = $array2[$i];
    }

    // 連結が完了した配列を返却
    return $array1;
}



// ソートする元配列を定義
$data = [3, 7, 8, 2, 9, 11, 1, 5];

// クイックソートを実行
$result = quickSort($data);

// 出力
echo implode(' ', $result);
echo "\n";

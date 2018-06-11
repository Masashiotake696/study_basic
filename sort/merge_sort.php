<?php
/*
    マージソートを実行する
    ソート前配列 : [3, 7, 8, 2, 9, 11, 1, 5]
    ソート後配列 : [1, 2, 3, 5, 7, 8, 9, 11]
*/


/**
 * マージソートを実行する
 * @param array $array マージソートする配列
 * @return array マージソートした配列
 */
function mergeSort($array) {
    return divideArray($array);
}

/**
 * 配列を二つに分割する(割り切れない場合は後半部分を1つ分長くする)
 *
 * @param array $array 分割する配列
 * @return array 引数として受け取った配列の中身を小さい順に並び替えた配列
 */
function divideArray($array) {
    // 配列を2分割
    $centerPosition = floor(count($array) / 2);
    for($i = 0; $i < $centerPosition; $i++) {
        $firstHalf[$i] = $array[$i];
    }
    for($i = $centerPosition; $i < count($array); $i++) {
        $latterHalf[$i - $centerPosition] = $array[$i];
    }

    // 前半部分と後半部分の配列の長さに応じて条件分岐
    if(count($firstHalf) === 1 && count($latterHalf) === 1) { // 分割した配列の長さが共に1の場合はそのままマージ
        return merge($firstHalf, $latterHalf);
    } else if(count($firstHalf) === 1) { // 前半部分の配列の長さが1の場合は、前半部分はそのままで、後半部分を分割してマージ
        return merge($firstHalf, divideArray($latterHalf));
    } else { // 前半部分も後半部分も配列の長さが1でない場合は両方分割してマージ
        return merge(divideArray($firstHalf), divideArray($latterHalf));
    }
}

/**
 * 二つの配列の中身を値の小さい順に並び替えてマージする
 *
 * @param array $array1 マージする配列
 * @param array $array2 マージする配列
 * @return array 二つの配列の中身を小さい順に並び替えた配列
 */
function merge($array1, $array2) {
    // 結果を格納する配列
    $result = [];

    // 二つの配列の長さの合計を取得
    $length = count($array1) + count($array2);

    // 二つの配列の中身を小さい順に並び替えた新しい配列を作成
    for($i = 0; $i < $length; $i++) {
        // どちらかの配列の中身が空になったら残っている値を結果配列に連結して返却
        if(count($array1) === 0) {
            // 配列の残りを結果配列に連結
            for($j = 0; $j < count($array2); $j++) {
                $result[$i + $j] = $array2[$j];
            }
            return $result;
        } else if(count($array2) === 0) {
            // 配列の残りを結果配列に連結
            for($j = 0; $j < count($array1); $j++) {
                $result[$i + $j] = $array1[$j];
            }
            return $result;
        }

        // 二つの配列のうち添字0番目の値で小さい方を結果配列に格納して、元の配列に対して格納した値を除いた配列を作成する
        if($array1[0] <= $array2[0]) {
            // 添字0番目の値を結果配列に格納
            $result[$i] = $array1[0];

            // 結果配列に値を格納する配列の長さが1の場合は、空配列を代入して次のループへ
            if(count($array1) === 1) {
                $array1 = [];
                continue;
            }

            // 元の配列から結果配列に格納した値を除いた配列を新たに作成
            $buf = $array1; // array1の中身をバッファにコピー
            $array1_length = count($array1); // array1の長さを取得
            $array1 = []; // array1の中身を空にする
            for($k = 0; $k < $array1_length; $k++) {
                if($k === 0) { // 結果配列に格納した値はスキップ
                    continue;
                }
                $array1[$k - 1] = $buf[$k];
            }
        } else {
            // 添字0番目の値を結果配列に格納
            $result[$i] = $array2[0];

            // 結果配列に値を格納する配列の長さが1の場合は、空配列を代入して次のループへ
            if(count($array2) === 1) {
                $array2 = [];
                continue;
            }

            // 元の配列から結果配列に格納した値を除いた配列を新たに作成
            $buf = $array2; // array2の中身をバッファにコピー
            $array2_length = count($array2); // array2の長さを取得
            $array2 = []; // array2の中身を空にする
            for($k = 0; $k < $array2_length; $k++) {
                if($k === 0) { // 結果配列に格納した値はスキップ
                    continue;
                }
                $array2[$k - 1] = $buf[$k];
            }
        }
    }
}

// ソートする元配列を定義
$data = [3, 7, 8, 2, 9, 11, 1, 5];

// マージソートを実行
$result = mergeSort($data);

// 出力
echo implode(' ', $result);
echo "\n";

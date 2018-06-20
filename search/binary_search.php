<?php

/*
    二分探索を実行する
    探索される配列：
        [
            '山本 亜美',
            '笠井 美弦',
            '近藤 康平',
            '大竹 将司',
            '小笹 佑京',
            '矢ヶ崎 哲宏',
            '蓮見 卓也',
            '信田 健児'
        ]
    探索する文字列：小笹
*/

// 探索される配列を定義
$data = [
    ['山本', '亜美', 'やまもと', 'あみ'],
    ['笠井', '美弦', 'かさい', 'みつる'],
    ['近藤', '康平', 'こんどう', 'こうへい'],
    ['大竹', '将司', 'おおたけ', 'まさし'],
    ['小笹', '佑京', 'おざさ', 'ゆうき'],
    ['矢ヶ崎', '哲宏', 'やがさき', 'あきひろ'],
    ['蓮見', '卓也', 'はすみ', 'たくや'],
   [ '信田', '健児', 'しのだ', 'けんじ'],
];

// 配列の長さを取得
$length = count($data);

// 五十音順に昇順で並び替え
for($i=0; $i < $length - 1; $i++) {
    // 隣同士の比較を繰り返す
    for($j=0; $j < $length - 1; $j++) {
        // 左側の数値が大きい場合は値を入れ替える
        if($data[$j][2] > $data[$j+1][2]) {
            $buf = $data[$j+1];
            $data[$j+1] = $data[$j];
            $data[$j] = $buf;
        } else if($data[$j][2] == $data[$j+1][2]) { // 性が一致していた場合は、名で比較
            if($data[$j][3] > $data[$j+1][3]) {
                $buf = $data[$j+1];
                $data[$j+1] = $data[$j];
                $data[$j] = $buf;
            }
        }
    }
}

// 探索用配列を用意
$search_data = $data;

// 探索する文字列を入力してもらう
echo '検索したい名前(ひらがな)を入力してください: ';
$search_name = trim(fgets(STDIN));

// ループ回数を取得
$loop = $length / 2;

// 探索が終了していない位置を記憶する変数
$index = $length - 1;

// 結果を格納する配列
$result = [];

for($i = 0; $i < $loop; $i++) {
    // 中間位置を取得($indexが偶数か奇数かで場合分け)
    if($index % 2 === 0) {
        $index = $index / 2;
    } else {
        $index = (int)(floor($index / 2) + 1);
    }

    // 中間位置の値と比較
    if($search_data[$index][2] > $search_name) {
        // 参照している値が添字1の場合は添字0の値を結果に入れてループを抜ける
        if($index === 1) {
            // 入力された名前が存在するか判定
            if($search_data[0][2] === $search_name){
                $result = $search_data[0];
                break;
            } else {
                echo "そんな名前は知りません\n";
                exit;
            }
        }
        // 検索される配列を定義し直す
        $buf = $search_data;
        $search_data = [];
        for($j = 0; $j < $index; $j++){
            $search_data[] = $buf[$j];
        }
        // 検索される配列の長さが1の場合は、添字0の値を結果に入れてループを抜ける
        if(count($search_data) === 1) {
            // 入力された名前が存在するか判定
            if($search_data[0][2] === $search_name){
                $result = $search_data[0];
                break;
            } else {
                echo "そんな名前は知りません\n";
                exit;
            }
        }
        // 探索が終了していない位置を記憶
        $index = count($search_data) - 1;
    } else if($search_data[$index][2] < $search_name) {
        // 参照している値が添字1の場合は添字2の値を結果に入れてループを抜ける
        if($index === 1) {
            // 入力された名前が存在するか判定
            if($search_data[2][2] === $search_name){
                $result = $search_data[2];
                break;
            } else {
                echo "そんな名前は知りません\n";
                exit;
            }
        }
        // 検索される配列を定義し直す
        $buf = $search_data;
        $search_data = [];
        for($j = $index + 1; $j < count($buf); $j++) {
            $search_data[] = $buf[$j];
        }
        // 検索される配列の長さが1の場合は、添字0の値を結果に入れてループを抜ける
        if(count($search_data) === 1) {
            // 入力された名前が存在するか判定
            if($search_data[0][2] === $search_name) {
                $result = $search_data[0];
                break;
            } else {
                echo "そんな名前は知りません\n";
                exit;
            }
        }
        // 探索が終了していない位置を記憶
        $index = count($search_data) - 1;
    } else {
        // 入力された名前が存在するか判定
        if($search_data[$index][2] === $search_name){
            $result = $search_data[$index];
            break;
        } else {
            echo "そんな名前は知りません\n";
            exit;
        }
    }
}

var_dump($result);

<?php

/*
    索引探索を実行する
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
    ['大竹', 'てすと', 'おおたけ', 'てすと'],
    ['小笹', '佑京', 'おざさ', 'ゆうき'],
    ['矢ヶ崎', '哲宏', 'やがさき', 'あきひろ'],
    ['蓮見', '卓也', 'はすみ', 'たくや'],
    ['信田', '健児', 'しのだ', 'けんじ'],
];

// 索引パターンを定義
$kana = [
    'あ' => '[あ-お]',
    'か' => '[か-こが-ご]',
    'さ' => '[さ-そざ-ぞ]',
    'た' => '[た-とだ-ど]',
    'な' => '[な-の]',
    'は' => '[は-ほば-ぼぱ-ぽ]',
    'ま' => '[ま-も]',
    'や' => '[や-よ]',
    'わ' => '[わ-ん]',
    'その他' => '.+',
];

// 配列の長さを取得
$length = count($data);

// 探索される配列を五十音順に昇順で並び替え(検索配列を五十音順に並べたいなら必要だけどいるか？？？？)
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

// 索引をキーとした配列
$index_array = [];

// 検索される配列に索引をつける
for($i = 0; $i < $length - 1; $i++) {
    foreach($kana as $key => $pattern) {
        // どの行に属するかを比較
        if(preg_match('/^' . $pattern . '/u', $data[$i][2])) {
            // 一致する行があったら、その行名をキーとしてデータを格納
            $index_array[$key][] = $data[$i];
            break;
        }
    }
}

// 探索する文字列を入力してもらう
echo '検索したい苗字(ひらがな)を入力してください: ';
$search_name = trim(fgets(STDIN));

// 入力値と等しい行を取得
$line_array = [];
foreach($kana as $key => $pattern) {
    if(preg_match('/^' . $pattern . '/u', $search_name)) {
        $line_array = $index_array[$key];
        break;
    }
}

// 配列の長さを取得
$line_array_length = count($line_array);
if($line_array_length === 0) {
    echo "そんな名前は知りません\n";
    exit;
}

// 検索結果配列
$return_array = [];

// 名前を検索
for($i = 0; $i < $line_array_length; $i++) {
    if($line_array[$i][2] === $search_name) {
        $return_array[] = $line_array[$i];
    }
}

if(count($return_array) === 0) {
    echo "そんな名前は知りません\n";
    exit;
}
var_dump($return_array);

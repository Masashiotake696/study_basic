<?php

/**
 * OPI(Otake PI)アルゴリズム
 *
 * 入力された文字列の一文字ずつに対して、文字列と順番が対応する円周率(14桁)の桁の数値分だけ進める
 */

// 暗号化したい文字列を入力してもらう
echo '暗号化したい文字列(英大文字)を入力してください: ';
$input_word = trim(fgets(STDIN));
// 14桁の円周率を文字列で取得
$pi = str_replace('.', '', ((String)pi()));

// 暗号化
for($i = 0; $i < mb_strlen($input_word); $i++) {
    $ascii = ord($input_word[$i]); // ASCII値を取得
    $ascii = ($ascii + $pi[$i % strlen($pi)] - 65) % 26 + 65;
    $input_word[$i] = chr($ascii); // 元に戻す
}

echo '暗号化: ' . $input_word . "\n";

// 復号
for($i = 0; $i < mb_strlen($input_word); $i++) {
    $ascii = ord($input_word[$i]); // ASCII値を取得
    $ascii = ($ascii - $pi[$i % strlen($pi)] - 65) % 26 + 65;
    $input_word[$i] = chr($ascii); // 元に戻す
}

echo '復号: ' . $input_word  . "\n";

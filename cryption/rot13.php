<?php

$serarch_word = "HAL";

for($i = 0; $i < mb_strlen($serarch_word); $i++) {
    $ascii = ord($serarch_word[$i]); // ASCII値を取得
    $ascii = ($ascii + 13 - 65) % 26 + 65;
    $serarch_word[$i] = chr($ascii); // 元に戻す
}

var_dump($serarch_word);

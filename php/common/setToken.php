<?php

$toke_byte = openssl_random_pseudo_bytes(16);
$tmp_token = bin2hex($toke_byte);
// 生成したトークンをセッションに保存します
$_SESSION['tmp_token'] = $tmp_token;

?>


<?php
    session_start();
    $user= $_SESSION['user'];
    if($user == ''){
        header('Location:errorPage.php');
        die();
    }
    require("../common/hsc.php");
?>


<!DOCTYPE html>
<html lang="ja">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>病院予約システム</title>
    <link rel="stylesheet" href="../css/reset.css">
    <link rel="stylesheet" href="../css/style.css">
</head>
<body>
<header class="header"></header>
<div class="wrapper">
<h1>予約内容の確認</h1>
<p>下記の内容で予約します。よろしいでしょうか？</p>
print();

戻る
</div>
</body>
</html>
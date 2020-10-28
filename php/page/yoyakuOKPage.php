<?php
    session_start();

    $user= $_SESSION['user'];
    if($user == ''){
        header('Location: errorPage.php');
        die();
    }
    // require("common.php");
    $time=$_GET['time'];
    $day=$_GET['day'];

?>


<!DOCTYPE html>
<html lang="ja">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>病院予約システム</title>
    <link rel="stylesheet" href="../../css/reset.css">
    <link rel="stylesheet" href="../../css/style.css">

</head>

<body>
<header class="header"></header>
    <div class="wrapper">
        <h1>予約完了</h1>
        <p> 日付：<?php echo $day; ?></p> 
        <p> 時間：<?php echo $time; ?></p> 

        <p>上記の内容で予約が完了しました。</p>
        <div class="fwablock">
            <a href="myPage.php">トップページに戻る</a><br>
            <a href="../destroy.php">ログアウト</a>
        </div>
    </div>

</body>

</html>
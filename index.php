<?php
session_start();
require("php/common/setToken.php");
require("php/common/hsc.php");
?>
<!DOCTYPE html>
<html lang="ja">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>予約システム</title>
    <link rel="stylesheet" href="css/reset.css">
    <link rel="stylesheet" href="css/style.css">
</head>

<body>

    <header class="header"></header>
    <div class="wrapper">
    <h1>病院予約システム</h1>
    <p>ログインしてください。</p>
    <form action="php/login.php" method="post">
        <dl>
            <dt><label for="user">診察券番号：</label></dt>
            <dd><input type="text" name="user" id="user"></dd></br>
            <dt><label for="pass">パスワード：</label></dt>
            <dd><input type="password" name="pass" id="pass"></dd>
        </dl>
        <input type="hidden" name="form_token" value="<?php echo  h($tmp_token)?>">
        <p><input type="submit" value="ログイン"></p>
    </form>

    </div>
</body>

</html>
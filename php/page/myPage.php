<?php
    session_start();

    $user= $_SESSION['user'];
    if($user == ''){
        header('Location: errorPage.php');
        die();
    }
    require("../common/hsc.php");
    $yoyakuNaiyo = $_SESSION['yoyakuNaiyo'];
//     echo('<pre>');
//     var_dump($yoyakuNaiyo);
//     echo('</pre>');
?>
<!DOCTYPE html>
<html lang="ja">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>病院予約システム</title>
    <link rel="stylesheet" href="../../css/reset.css">
    <link rel="stylesheet" href="../../css/style.css">
    <link rel="stylesheet" href="../../css/popup.css">
    <script src="../../js/popup.js"></script>
</head>

<body>
<header class="header">
<div class="logout"><a href="logoutPage.php">ログアウト</a></div>
</header>

<div class="wrapper">
<h1>マイページ</h1>
<p>日付：<?php echo date("Y/m/d") ;?></p>
ようこそ、<?php print h($_SESSION['氏名']);?>さん。

<div class="yoyakuTable">
<?php if(sizeof($yoyakuNaiyo) > 0){?>
    <p>現在の予約内容は下記の通りです。</p>
<table>
    <thead>
        <tr class="pinkdot_top pinkdot_bottom">
        <th>予約日</th><th>予約時間</th><th>予約種別</th><th>予防接種種類</th>
        <!-- <th>登録日時</th> -->
        <th>キャンセル</th>
        </tr>
    </thead>
    <tbody>
<?php
    $i=1;
    foreach($yoyakuNaiyo as $key => $value){ 
    print('<tr class="pinkdot_bottom">');
    print("<td>" . h($value[1]) . "</td><td>" . h($value[2]) ."</td><td>" . h($value[3]) . "</td><td>" . h($value[4]) . 
    // "</td><td>" . date('Y-m-d h:m',  strtotime(h($value[5]))) . 
    "</td><td>
    <form method=\"POST\" name=\"deleteForm" . $i . "\" id=\"deleteForm" . $i . "\" action=\"../delete.php\">
    <input type=\"hidden\" name=\"target_del\" value=\"" .h($value[6]) . "\">
    <input type=\"submit\" value=\"取消\" id=\"btn_delid" . $i . "\"name=\"btn_del" . $i . "\" onclick=\"return confirm_test('deleteForm" . $i . "')\" />
    </form></td>");
    print('</tr>');
    $i++;
    }
?>        
    </tbody>
</table>
    <!-- hidden -->
    <div id="popup" >
        <p>本当に削除しますか？</p>
        <button id="ok" onclick="okfunc()">OK</button>
        <button id="no" onclick="nofunc()">キャンセル</button>
    </div>
    <!-- /hidden -->
<?php } else { ?>
    <p>現在の予約はありません。</p>
<?php } ?>
</div>
<p>予約内容を選択してください。</p>
<ul class="syubetuSentaku fwablock">
    <li><a href="select_ippan.php">一般診療</a></li>
    <li><a href="select_yobo.php">予防接種</a></li>
</ul>
    </div>
    <div id="grayCover"></div>
</body>
</html>
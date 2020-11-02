<?php
session_start();

$user = $_SESSION['user'];
$syubetu = $_POST['yoyakuSyubetu'];
$day = $_POST['day'];
$time = $_POST['time'];

if ($user == '' || $syubetu == '' || $day == '' || $time == '') {
    header('Location:errorPage.php');
    die();
}
require("common/checkToken.php");
require("common/hsc.php");


header("Content-type: text/html; charset=utf-8");
define('DB_HOST', 'localhost');
define('DB_USERNAME', 'root');
define('DB_PASSWORD', '');
$result = null;


try {
    $dbh = new PDO('mysql:host=localhost;dbname=clinic;charset=utf8', DB_USERNAME, DB_PASSWORD);
    // echo "接続成功</br>";
    if ($syubetu == '1') {
        $yobousessyuId = $_POST['yoboId'];

        //nothing
    } elseif ($syubetu == '2') {
        $sth = $dbh->prepare("INSERT INTO `予約情報`(`利用者ID`, `診療種別`, `予約日`, `予約時間`,`備考`) VALUES (:user, 2, :day, :time,'なし')");
    } else {
        die('種別が不正です');
    }
    $sth->bindValue(':user', $user, PDO::PARAM_INT);
    $sth->bindValue(':day', $day, PDO::PARAM_STR);
    $sth->bindValue(':time', $time, PDO::PARAM_STR);
    $sth->execute();
    // $result = $sth->fetchAll(PDO::FETCH_BOTH);

    $sth = null;
    $dbh = null;

    require("getYoyakuNaiyo.php");
    header("Location: page/yoyakuOKpage.php?day=" . $day . "&time=" . $time);
} catch (PDOException $e) {
    print "接続失敗: " . $e->getMessage() . "<br/>";
    die();
}
?>

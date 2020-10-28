<?php
    session_start();
    $_SESSION['syubetu']=1;
    $user= $_SESSION['user'];
    if($user == ''){
        header('Location:errorPage.php');
        die();
    }
    require("common.php");

?>
    <?php 

        header("Content-type: text/html; charset=utf-8");
        define('DB_HOST','localhost');
        define('DB_USERNAME','root');
        define('DB_PASSWORD','');
    
        $user=$_POST['user'];
        $pass=$_POST['pass'];
        $result=null;
        
        //データベースに接続し、ログイン不可ならエラーページにリダイレクトする
        
    
        try {
            $dbh = new PDO('mysql:host=localhost;dbname=clinic;charset=utf8',DB_USERNAME, DB_PASSWORD);
            // echo "接続成功</br>";

            $sth = $dbh->prepare("SELECT count(*) as COUNT FROM `利用者` WHERE `利用者ID` = :id AND `パスワード` = :pass");
            $sth->bindValue(':id',$user,PDO::PARAM_INT);
            $sth->bindValue(':pass',$pass,PDO::PARAM_STR);
            $sth->execute();
            // $result = $sth->fetchAll(PDO::FETCH_BOTH);

            if ($sth->fetchColumn() == 1) {
                $sth = null;

                // $sth = $dbh->prepare("SELECT 氏名, datediff(now(), 生年月日) as 月数, 生年月日 from 利用者 WHERE `利用者ID` = :id AND `パスワード` = :pass");
                $sth = $dbh->prepare("SELECT
                y.予約日
                ,y.予約時間
                ,(SELECT ＿診療種別.名称 from ＿診療種別 WHERE y.診療種別=＿診療種別.キー)as 診療種別
                ,(SELECT ys.名称 from 予防接種 ys WHERE y.予防接種番号 = ys.予防接種番号)as 予防接種種別
                ,y.登録日時
                FROM 予約情報 y
                WHERE  y.`利用者ID` = :id
                order by y.予約日 asc, y.予約時間 asc");
                $sth->bindValue(':id',$user,PDO::PARAM_INT);
                $sth->execute();
                $result = $sth->fetchAll(PDO::FETCH_BOTH);
                var_dump($result);

            }else{
                //ログイン失敗ページにリダイレクト
                header('Location:errorPage.php?err=1');
                exit();
            }

            $sth = null;
            $dbh = null;

        } catch (PDOException $e) {
            print "接続失敗: " . $e->getMessage() . "<br/>";
            die();
        }
        ?>



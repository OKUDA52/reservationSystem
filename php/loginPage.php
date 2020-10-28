
    <?php 
        function h($s){return htmlspecialchars($s,ENT_QUOTES,'UTF-8'); }//共通メソッド
        
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

            if ($sth->fetchColumn() > 0) {
                $sth = null;

                $sth = $dbh->prepare("SELECT 氏名, datediff(now(), 生年月日) as 月数, 生年月日 from 利用者 WHERE `利用者ID` = :id AND `パスワード` = :pass");
                $sth->bindValue(':id',$user,PDO::PARAM_INT);
                $sth->bindValue(':pass',$pass,PDO::PARAM_STR);
                $sth->execute();
                $result = $sth->fetchAll(PDO::FETCH_BOTH);
                                // foreach($result as $row){
                //     print "NAME:" . $row['氏名'] . "</br>";
                // }
            } else {
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
<h1>ログインページ</h1>
<p>日付：<?php echo date("Y/m/d") ;?></p>
ようこそ、<?php print h($result[0]['氏名']); ?>さん。
<p>予約内容を選択してください。</p>


</body>
</html>
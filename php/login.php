<!-- セキュリティゲートページ
    セッション変数発行 -->
    <?php 
        session_start();
        require("common/checkToken.php");
        $user=$_POST['user'];
        $pass=$_POST['pass'];

        if($user =='' || $pass==''){
            header('Location:destroy.php');
            die();
        }

        require_once("dbConnect.php");

    
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

                $sth = $dbh->prepare("SELECT 利用者ID,氏名, datediff(now(), 生年月日) as 月数 from 利用者 WHERE `利用者ID` = :id ");
                $sth->bindValue(':id',$user,PDO::PARAM_INT);
                $sth->execute();
                $result = $sth->fetchAll(PDO::FETCH_BOTH);

                $_SESSION['user'] = $user;
                $_SESSION['氏名']=$result[0]['氏名'];
                $_SESSION['月数']=$result[0]['月数'];
                $_SESSION['利用者ID']=$result[0]['利用者ID'];
                
            } else {
                //ログイン失敗ページにリダイレクト
                header('Location:destroy.php');
                exit();
            }

            // ＤＢ切断
            $sth = null;
            $dbh = null;

            require("getYoyakuNaiyo.php");

            header('Location: page/myPage.php');

        } catch (PDOException $e) {
            print "接続失敗: " . $e->getMessage() . "<br/>";
            die();
        }
        ?>
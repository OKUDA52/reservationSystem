
    <?php 
        session_start();

        if(!isset($_SESSION['利用者ID']) || $_SESSION['利用者ID'] == ''){
            header('Location:page/errorPage');
            die();
        }
        if(!isset($_POST['target_del']) || $_POST['target_del'] == ''){
            header('Location:page/errorPage');
            die();
        }
        // require("common.php");
        $user=$_SESSION['利用者ID'];
        $getKey=$_POST['target_del'];
        echo $user;
        echo $getKey;
        
       
        require_once("dbConnect.php");
            
        //データベースに接続し、ログイン不可ならエラーページにリダイレクトする
        
    
        try {
            $dbh = new PDO('mysql:host=localhost;dbname=clinic;charset=utf8',DB_USERNAME, DB_PASSWORD);
            // echo "接続成功</br>";
              
                $sth = $dbh->prepare("INSERT INTO `キャンセル情報`(`予約番号`,`キャンセル者`) VALUES (:deleteKey, :id);");

                $sth->bindValue(':deleteKey', $getKey, PDO::PARAM_INT);
                $sth->bindValue(':id', $user, PDO::PARAM_INT);

                $sth->execute();

                // var_dump($sth);
                
            $sth = null;
            $dbh = null;

            require('getYoyakuNaiyo.php');
            header('Location: page/myPage.php');

        } catch (PDOException $e) {
            print "接続失敗: " . $e->getMessage() . "<br/>";
            die();
        }
        ?>
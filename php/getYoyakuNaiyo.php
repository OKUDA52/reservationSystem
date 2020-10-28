<!-- ログイン済みを前提に、userIDに紐づいた予約内容を$_SESSION['yoyakuNaiyo']に格納する -->
<!-- 
echo $_SESSION['user'];
echo $_SESSION['氏名'];
echo $_SESSION['月数'];
echo $_SESSION['利用者ID']; 
-->
  
    <?php 
        $user=$_SESSION['user'];
     
        if($user ==''){
            header('Location:destroy.php');
            die();
        }
        // require("common.php");
        require_once("dbConnect.php");
 
    
        try {
            $dbh = new PDO('mysql:host=localhost;dbname=clinic;charset=utf8',DB_USERNAME, DB_PASSWORD);
            // echo "接続成功</br>";
            
            $sth = $dbh->prepare("SELECT
            y.利用者ID
            ,y.予約日
            ,y.予約時間
            ,(SELECT ＿診療種別.名称 from ＿診療種別 WHERE y.診療種別=＿診療種別.キー)as 診療種別
            ,(SELECT ys.名称 from 予防接種 ys WHERE y.予防接種番号 = ys.予防接種番号)as 予防接種種別
            ,y.登録日時
            ,y.予約番号
            FROM 予約情報 y
            WHERE  y.`利用者ID` = :id
            and y.予約番号 NOT IN(SELECT 予約番号 from キャンセル情報)
            order by y.予約日 asc, y.予約時間 asc");
            $sth->bindValue(':id',$user,PDO::PARAM_INT);
            $sth->execute();
            $result = $sth->fetchAll(PDO::FETCH_BOTH);
            $_SESSION['yoyakuNaiyo']=$result;
    
            $sth = null;
            $dbh = null;

        } catch (PDOException $e) {
            print "接続失敗: " . $e->getMessage() . "<br/>";
            die();
        }
        ?>
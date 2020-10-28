<!-- セキュリティ出口ページ -->
<!-- セッションとクッキーを破壊して外部にリダイレクト -->

<?php
session_start();
if (isset($_COOKIE[session_name()])) { 
    setcookie(session_name(), '', time()-42000, '/');
}
$_SESSION = array();
session_destroy();
header('Location: ../index.php');
?>
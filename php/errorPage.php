<?php
 var_dump(is_int($_GET['err']));
 var_dump(is_int(1));
 var_dump(filter_var('1',FILTER_VALIDATE_INT));
if(isset($_GET['err']) && is_int($_GET['err'])){
    $errCode=$_GET['err'];
}else{
    $errCode=0;
}

?>

<!DOCTYPE html>
<html lang="ja">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>予約システム</title>
    <link rel="stylesheet" href="../css/reset.css">
    <link rel="stylesheet" href="../css/style.css">
</head>
<body>
    <?php if($errCode==0){ ?>
        <h1>エラーが発生しました。トップページに戻ります。</h1>
        <P><a href="../index.php"> このページは5秒後に自動的に移動しますが、クリックでも戻ることができます。</a></P>

    <?php }elseif($errCode==1){ ?>
        <h1>入力内容をお確かめの上、もう一度ログインしてください。</h1>
        <P><a href="../index.php"> このページは5秒後に自動的に移動しますが、クリックでも戻ることができます。</a></P>
    <?php  }?>
</body>
</html>
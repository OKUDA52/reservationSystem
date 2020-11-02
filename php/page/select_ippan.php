<?php
session_start();
$user = $_SESSION['user'];
if ($user == '') {
    header('Location:errorPage.php');
    die();
}
require("../common/hsc.php");
require("../common/setToken.php");

?>
<!DOCTYPE html>
<html lang="ja">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>病院予約システム</title>
    <link rel="stylesheet" href="../../css/reset.css">
    <link rel="stylesheet" href="../../css/style.css">
    <link rel="stylesheet" href="../../css/yoyakuForm.css">

</head>
<?php
    $sell_num = 1;//出力するのが何番目のセルか
    $day = 1;//出力するのがどの日付か

    $year = (int)date('Y');
    $month = (int)date('m');
    $today = (int)date('d');
    
    $daysOfMonth = (int)date('t') + 1;
    $firstYobi = (int)date("w",strtotime($year . "-" . ($month) . "-1"));

    // 翌月以降
    $nextTimeStamp=strtotime($year . "-" . ($month+1) . "-1");
    $nextMonth = (int)date("m",$nextTimeStamp);
    $nextDaysOfMonth = (int)date("t",$nextTimeStamp)+1;
    $nextFirstYobi = (int)date("w",$nextTimeStamp);

?>
<body>
    <header class="header"></header>
    <div class="wrapper">
        <h1>一般診療予約</h1>

        <p>予約日時を選択してください。</p>

            <table class="holder_form">
                <tr>
                    <td class="left_box">
                        <p><?php echo $month . "月"; ?></p>
                        <table class="calender_yoyaku">
                            <thead>
                                <tr class="pinkdot_top pinkdot_bottom">
                                    <th>月</th>
                                    <th>火</th>
                                    <th>水</th>
                                    <th>木</th>
                                    <th>金</th>
                                    <th>土</th>
                                    <th>日</th>
                                </tr>
                            </thead>

                            <tbody>
                                <tr class="pinkdot_bottom">
                                  <?php
                                  require("../printCalender.php");?>
                                </tr>
                            </tbody>
                        </table>
                    </td>
                    <td class="right_box">
                        <br><br><br><br>
                        <!-- 時間 -->
                        <table>
                            <tr>
                                <td id="time1" class="timeSelect">12:00</td>
                            </tr>
                            <tr>
                                <td id="time2" class="timeSelect">14:30</td>
                            </tr>
                            <tr>
                                <td id="time3" class="timeSelect">15:00</td>
                            </tr>
                            <tr>
                                <td id="time4" class="timeSelect">15:30</td>
                            </tr>
                            <tr>
                                <td id="time5" class="timeSelect">16:00</td>
                            </tr>
                        </table>
                    </td>
                </tr>
            </table>
         <p>選択した日付：<div id="selectDay">xxxx-xx-xx</div></p>
          <p>選択した時間：<div id="selectTime">xx:xx</div></p>
            <form action="../yoyakuSyori.php" method="post">
            <input type="hidden" id="yoyakuSyubetu" name="yoyakuSyubetu" value="2">
            <input type="hidden" id="day" name="day" value="<?php echo h($date); ?>">
            <input type="hidden" id="time" name="time" value="12:30">
            <input type="hidden" name="form_token" value="<?php echo  h($tmp_token)?>">
            <input type="button" id="btn_modoru" value="戻る">
            <input type="submit" value="予約する">
            
        </form>

    </div>
    <!-- 当月分カレンダーの日付選択用リスナー追加処理 -->
    <script>
            let year = <?php echo $year; ?>;
            let firstday = <?php echo $today; ?>;
            let lastday = <?php echo $daysOfMonth; ?>;
            let month =  <?php echo $month; ?>;
            // let targetId = null;
            for (let i = firstday; i < lastday; i++) {
                let targetId = year + '-' + month + '-' + i;
                document.getElementById(targetId).addEventListener("click", () => {
                    document.getElementById("selectDay").innerHTML =  targetId.toString();
                    document.getElementById("day").value =  targetId.toString();
                });

            }
    </script>
    <!-- 当月分カレンダーの時間選択用リスナー追加処理 -->
    <script>
            // let timeId = null;
            // let timeInnerhtml=null;

            for (let i = 1; i < 6; i++) {
                let timeId = 'time' + i;
                let timeInnerhtml=document.getElementById(timeId).innerHTML;
                document.getElementById(timeId).addEventListener("click", () => {
                    document.getElementById("selectTime").innerHTML = timeInnerhtml;
                    document.getElementById("time").value = timeInnerhtml;
                });
                
                target=null;
            }
    </script>
<!-- 戻るボタン 完了-->
    <script>
        const myfunc = document.getElementById("btn_modoru").addEventListener("click", () => {
            // console.log('onck');
            location.href = "myPage.php";
        });
    </script>

</body>

</html>
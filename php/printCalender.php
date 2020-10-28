

<?php
// 表示ページのbodyより上に移植
// $sell_num = 1;//出力するのが何番目のセルか
// $day = 1;//出力するのがどの日付か

// $year = (int)date('y');
// $month = (int)date('m');
// $today = (int)date('d');

// $daysOfMonth = (int)date('t') + 1;
// $firstYobi = (int)date("w",strtotime($year . "-" . ($month) . "-1"));

// // 翌月以降
// $nextTimeStamp=strtotime($year . "-" . ($month+1) . "-1");
// $nextMonth = (int)date("m",$nextTimeStamp);
// $nextDaysOfMonth = (int)date("t",$nextTimeStamp)+1;
// $nextFirstYobi = (int)date("w",$nextTimeStamp);

    while ($sell_num < $firstYobi) {
        echo ("<td></td>");
        $sell_num++;
    }
    while ($day < $today) {
        echo ("<td class=\"yoyakuNG\">" . $day . "</td>");
        if ($sell_num % 7 == 0) {
            echo "</tr><tr class=\"pinkdot_bottom\">";
        }
        $sell_num++;
        $day++;
    }
    while ($day < $daysOfMonth) {
        echo ("<td id=\"" . $year . "-" . $month . "-" . $day . "\" class=\"yoyakuKano\">" . $day . "</td>");
        if ($sell_num % 7 == 0) {
            echo "</tr><tr class=\"pinkdot_bottom\">";
        }
        $sell_num++;
        $day++;
    }
    while (true){
        if(($sell_num % 7) == 0) {
            echo ("<td></td>");
            break;
        } else {
            echo ("<td></td>");
            $sell_num++;
        }
    }
?>
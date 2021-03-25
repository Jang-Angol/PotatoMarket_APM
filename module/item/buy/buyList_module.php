<?php
    include "DB/database.php";
?>
<div class="buy_item_list">
    <div class="buy_item">
        <table class="buy_item_table">
<?php
    if(!isset($sql)){
        $sql = "SELECT no, user_no, trade_type, trade_state, server, title, date FROM ITEM_TB WHERE trade_type = 2 ORDER BY no DESC LIMIT 8;";
    }
    
    $result = mysqli_query($connect, $sql);
    if($row = mysqli_fetch_array($result)){
        $user_sql = "SELECT server, user_name FROM USER_TB WHERE no = ".$row["user_no"].";";
            $user_result = mysqli_query($connect, $user_sql);
            $user_row = mysqli_fetch_array($user_result);
            switch($user_row["server"]){
                case 0:
                    $server = "DEV";
                    break;
                case 1: 
                    $server = "LT";
                    break;
                case 2:
                    $server = "HP";
                    break;
                case 3:
                    $server = "MD";
                    break;
                case 4:
                    $server = "WF";
                    break;
                default:
                    echo "Not valid value";
                    exit;
            }
        echo<<< END
         <tr><th class="trade_item_state_$row[trade_type]$row[trade_state]"></th>
            <td class="buy_item_server server_icon_$row[server]"></td>
            <td class="buy_item_title">
            <a href="itemBuyView.php?id=$row[no]">$row[title]</a></td>
            <td class="buy_user_name">$server$user_row[user_name]</td>
            <td class="buy_item_date">$row[date]</td></tr>

END;
        while ($row = mysqli_fetch_array($result)){
            $user_sql = "SELECT server, user_name FROM USER_TB WHERE no = ".$row["user_no"].";";
            $user_result = mysqli_query($connect, $user_sql);
            $user_row = mysqli_fetch_array($user_result);
            switch($user_row["server"]){
                case 0:
                    $server = "DEV";
                    break;
                case 1: 
                    $server = "LT";
                    break;
                case 2:
                    $server = "HP";
                    break;
                case 3:
                    $server = "MD";
                    break;
                case 4:
                    $server = "WF";
                    break;
                default:
                    echo "Not valid value";
                    exit;
            }
        echo<<< END
         <tr><th class="trade_item_state_$row[trade_type]$row[trade_state]"></th>
            <td class="buy_item_server server_icon_$row[server]"></td>
            <td class="buy_item_title">
            <a href="itemBuyView.php?id=$row[no]">$row[title]</a></td>
            <td class="buy_user_name">$server$user_row[user_name]</td>
            <td class="buy_item_date">$row[date]</td></tr>

END;
        } 
    } else {
        echo "<div class='item_list_blink'>등록된 아이템이 없습니다</div>";
    }
    mysqli_close($connect);
    unset($sql);
?>
        </table>
    </div>
</div>
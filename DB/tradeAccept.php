<?php
    include "database.php";

    $item_no = $_POST["item_no"];
    $trade_no = $_POST["trade_no"];
    $trade_type = $_POST["trade_type"];
    //FIND ITEM TRADE STATE
    $sql = "SELECT trade_state FROM ITEM_TB WHERE no = $item_no;";
    $result = mysqli_query($connect, $sql);
    $row = mysqli_fetch_array($result);
    //FIND DOING APPLY
    $trade_sql = "SELECT no, apply_state FROM TRADE_TB WHERE item_no = $item_no AND apply_accept = 1;";
    $trade_result = mysqli_query($connect, $trade_sql);
    $trade_row = mysqli_fetch_array($trade_result);

    if($trade_row){       
        //CANCLE PREVIOUS APPLY
        $trade_sql = "UPDATE TRADE_TB SET apply_accept = 0 WHERE no = $trade_row[no];";
        $trade_result = mysqli_query($connect, $trade_sql);
        //RESERVATION CANCLE
        if($row["trade_state"] == 2){
            $reserv_sql = "UPDATE ITEM_TB SET trade_state = 1 WHERE no = $item_no;";
            $reserv_result = mysqli_query($connect, $reserv_sql);
            if($reserv_result){
                echo "item_state_change(1234)";
            }
        }
        if($trade_result){
            //APPLY ACCEPT
            $trade_sql = "UPDATE TRADE_TB SET apply_accept = 1 WHERE no = $trade_no;";
            $trade_result = mysqli_query($connect, $trade_sql);
            //FIND NEW APPLY
            $trade_sql = "SELECT no, apply_state FROM TRADE_TB WHERE no = $trade_no AND apply_accept = 1;";
            $trade_result = mysqli_query($connect, $trade_sql);
            $trade_row = mysqli_fetch_array($trade_result);
            if($trade_row){
                //RESERVATION APPLY
                if($trade_row["apply_state"] == 3){
                    $reserv_sql = "UPDATE ITEM_TB SET trade_state = 2 WHERE no = $item_no;";
                    $reserv_result = mysqli_query($connect, $reserv_sql);
                    echo "item_state_change(1234)";
                }
            } else {
                echo "ERROR1";
            }
        } else {
            echo "ERROR2";
        }
    } else {
        //ACCEPT APPLY
        $trade_sql = "UPDATE TRADE_TB SET apply_accept = 1 WHERE no = $trade_no;";
        $trade_result = mysqli_query($connect, $trade_sql);
        //FIND NEW APPLY
        $trade_sql = "SELECT no, apply_state FROM TRADE_TB WHERE no = $trade_no AND apply_accept = 1;";
        $trade_result = mysqli_query($connect, $trade_sql);
        $trade_row = mysqli_fetch_array($trade_result);
        if($trade_row){
            //RESERVATION APPLY
            if($trade_row["apply_state"] == 3){
                $reserv_sql = "UPDATE ITEM_TB SET trade_state = 2 WHERE no = $item_no;";
                $reserv_result = mysqli_query($connect, $reserv_sql);
                echo "item_state_change(1234)";
            }
        } else {
            echo "ERROR3";
        }
    }
?>
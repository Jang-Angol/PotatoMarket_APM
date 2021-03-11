<?php
    include "database.php";

    $item_no = $_POST["item_no"];
    $trade_no = $_POST["trade_no"];
    $trade_type = $_POST["trade_type"];
    //FIND DOING APPLY
    $sql = "SELECT no, apply_state FROM TRADE_TB WHERE item_no = $item_no AND apply_accept = 1;";
    $result = mysqli_query($connect, $sql);
    $row = mysqli_fetch_array($result);

    if($row){       
        //CANCLE PREVIOUS APPLY
        $sql = "UPDATE TRADE_TB SET apply_accept = 0 WHERE no = $row[no];";
        $result = mysqli_query($connect, $sql);
        if($result){
            //APPLY ACCEPT
            $sql = "UPDATE TRADE_TB SET apply_accept = 1 WHERE no = $trade_no;";
            $result = mysqli_query($connect, $sql);
        } else {
            echo "ERROR2";
        }
    } else {
        //ACCEPT APPLY
        $sql = "UPDATE TRADE_TB SET apply_accept = 1 WHERE no = $trade_no;";
        $result = mysqli_query($connect, $sql);
        if($result){
            echo "error3";
        } else {
            echo "error4";
        }
    }
?>
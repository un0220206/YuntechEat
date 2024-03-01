<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>YuntechEat</title>
 </head>
<body>
<hr>
<?php
    session_start();
    $title = $_SESSION['page_ch'] . " - 刪除";
    echo "<center><h2>$title</h2></center>";    
?>
<hr>
<?php
    $table = $_SESSION['table'];
    $array = $_SESSION['insert'];
    $link = mysqli_connect("localhost", "root", "", "yuntecheat")
                or die("無法開啟MySQL資料庫連接!<br/>");
    mysqli_query($link, 'SET NAMES utf8');
    echo "<center>";
    switch($table) {
        case "member":
            $member_id = $_SESSION["Member_id"];
            if ($result = mysqli_query($link, "DELETE FROM member WHERE memberID = $member_id")) {
                echo "<font color='blue'>！資料刪除成功！</font>";
                //mysqli_free_result($result);
            } else {
                echo "<font color='red'>！資料刪除失敗！</font>";
            }
            break;
        case "deliverystaff":
            $deliveryStaff_id = $_SESSION["DeliveryStaff_id"];
            if ($result = mysqli_query($link, "DELETE FROM deliverystaff WHERE deliverystaffID = $deliveryStaff_id")) {
                echo "<font color='blue'>！資料刪除成功！</font>";
                //mysqli_free_result($result);
            } else {
                echo "<font color='red'>！資料刪除失敗！</font>";
            }
            break;
        case "restaurant":
            $restaurant_id = $_SESSION["Restaurant_id"];
            if ($result = mysqli_query($link, "DELETE FROM restaurant WHERE restaurantID = $restaurant_id")) {
                echo "<font color='blue'>！資料刪除成功！</font>";
                //mysqli_free_result($result);
            } else {
                echo "<font color='red'>！資料刪除失敗！</font>";
            }
            break;
        case "food":
            $restaurant_id = $_SESSION["Restaurant_id"];
            $food_id = $_SESSION["Food_id"];
            if (is_numeric($food_id)) {
                if ($result = mysqli_query($link, "DELETE FROM food WHERE restaurantID = $restaurant_id AND foodID = $food_id")) {
                    echo "<font color='blue'>！資料刪除成功！</font>";
                    //mysqli_free_result($result);
                } else {
                    echo "<font color='red'>！資料刪除失敗！</font>";
                }
            }
            break;
        case "orderhistory":
            $order_id = $_SESSION["Order_id"];
            if ($result = mysqli_query($link, "DELETE FROM orderhistory WHERE orderID = $order_id")) {
                echo "<font color='blue'>！資料刪除成功！</font>";
                //mysqli_free_result($result);
            } else {
                echo "<font color='red'>！資料刪除失敗！</font>";
            }
            break;
        case "orderdetail":
            $order_id = $_SESSION["Order_id"];
            $restaurant_id = $_SESSION["Restaurant_id"];
            $food_id = $_SESSION["Food_id"];
            if ($result = mysqli_query($link, "DELETE FROM orderdetail WHERE orderID = $order_id AND restaurantID = $restaurant_id AND foodID = $food_id")) {
                echo "<font color='blue'>！資料刪除成功！</font>";
                //mysqli_free_result($result);
            } else {
                echo "<font color='red'>！資料刪除失敗！</font>";
            }
            break;
    }
    echo "</center><p>";
    mysqli_close($link);
?>
<form action="control.php" method="post">
<center>
<?php
    echo "<button type='submit' name='btn' value='回" . $_SESSION['page_ch'] . "畫面'>回" . $_SESSION['page_ch'] . "畫面</button>";
?>
</body>
</html>
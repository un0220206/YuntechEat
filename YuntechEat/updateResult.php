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
    $title = $_SESSION['page_ch'] . " - 修改";
    echo "<center><h2>$title</h2></center>";    
?>
<hr>
<?php
    $table = $_SESSION['table'];
    $array = $_SESSION['update'];
    $link = mysqli_connect("localhost", "root", "", "yuntecheat")
                or die("無法開啟MySQL資料庫連接!<br/>");
    mysqli_query($link, 'SET NAMES utf8');
    echo "<center>";
    switch($table) {
        case "member":
            $member_id = $_SESSION["Member_id"];
            if ($result = mysqli_query($link, "UPDATE member SET account = '$array[0]', password = '$array[1]', name = '$array[2]', gender = '$array[3]', birthday = '$array[4]', email = '$array[5]' WHERE memberID = $member_id")) {
                echo "<font color='blue'>！資料更新成功！</font>";
                //mysqli_free_result($result);
            } else {
                echo "<font color='red'>！資料更新失敗！</font>";
            }
            break;
        case "deliverystaff":
            $deliveryStaff_id = $_SESSION["DeliveryStaff_id"];
            if ($result = mysqli_query($link, "UPDATE deliverystaff SET name = '$array[0]', tel = '$array[1]' WHERE deliveryStaffID = $deliveryStaff_id")) {
                echo "<font color='blue'>！資料更新成功！</font>";
                //mysqli_free_result($result);
            } else {
                echo "<font color='red'>！資料更新失敗！</font>";
            }
            break;
        case "restaurant":
            $restaurant_id = $_SESSION["Restaurant_id"];
            if ($result = mysqli_query($link, "UPDATE restaurant SET name = '$array[0]', tel = '$array[1]', address = '$array[2]' WHERE restaurantID = $restaurant_id")) {
                echo "<font color='blue'>！資料更新成功！</font>";
                //mysqli_free_result($result);
            } else {
                echo "<font color='red'>！資料更新失敗！</font>";
            }
            break;
        case "food":
            $restaurant_id = $_SESSION["Restaurant_id"];
            $food_id = $_SESSION["Food_id"];
                echo "<font color='blue'>！資料更新成功！</font>";
            if ($result = mysqli_query($link, "UPDATE food SET name = '$array[0]', price = '$array[1]', imageURL = '$array[2]', description = '$array[3]' WHERE restaurantID = $restaurant_id AND foodID = $food_id")) {
                //mysqli_free_result($result);
            } else {
                echo "<font color='red'>！資料更新失敗！</font>";
            }
            break;
        case "orderhistory":
            $order_id = $_SESSION["Order_id"];
            if ($result = mysqli_query($link, "UPDATE orderhistory SET memberID = '$array[0]', deliveryStaffID = '$array[1]', creationDatetime = '$array[2]', arrived = '$array[3]' WHERE orderID = $order_id")) {
                echo "<font color='blue'>！資料更新成功！</font>";
                //mysqli_free_result($result);
            } else {
                echo "<font color='red'>！資料更新失敗！</font>";
            }
            break;
        case "orderdetail":
            $order_id = $_SESSION["Order_id"];
            $restaurant_id = $_SESSION["Restaurant_id"];
            $food_id = $_SESSION["Food_id"];
            if ($result = mysqli_query($link, "UPDATE orderdetail SET foodCount = '$array[0]' WHERE orderID = $order_id AND restaurantID = $restaurant_id AND foodID = $food_id")) {
                echo "<font color='blue'>！資料更新成功！</font>";
                //mysqli_free_result($result);
            } else {
                echo "<font color='red'>！資料更新失敗！</font>";
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
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
    $title = $_SESSION['page_ch'] . " - 新增";
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
            if ($array[0] != "") {
                if ($result = mysqli_query($link, "INSERT INTO member VALUES ('$array[0]', '$array[1]', '$array[2]', '$array[3]', '$array[4]', '$array[5]', '$array[6]')")) {
                    echo "<font color='blue'>！資料新增成功！</font>";
                    //mysqli_free_result($result);
                } else {
                    echo "<font color='red'>！資料新增失敗！</font>";
                }
            } else {
                echo "<font color='red'>！資料新增失敗！</font>";
            }
            break;
        case "deliverystaff":
            if ($array[0] != "") {
                if ($result = mysqli_query($link, "INSERT INTO deliverystaff VALUES ('$array[0]', '$array[1]', '$array[2]')")) {
                    echo "<font color='blue'>！資料新增成功！</font>";
                    //mysqli_free_result($result);
                } else {
                    echo "<font color='red'>！資料新增失敗！</font>";
                }
            } else {
                echo "<font color='red'>！資料新增失敗！</font>";
            }
            break;
        case "restaurant":
            if ($array[0] != "") {
                if ($result = mysqli_query($link, "INSERT INTO restaurant VALUES ('$array[0]', '$array[1]', '$array[2]', '$array[3]')")) {
                    echo "<font color='blue'>！資料新增成功！</font>";
                    //mysqli_free_result($result);
                } else {
                    echo "<font color='red'>！資料新增失敗！</font>";
                }
            } else {
                echo "<font color='red'>！資料新增失敗！</font>";
            }
            break;
        case "food":
            $restaurant_id = $_SESSION["Restaurant_id_insert"];
            if ($array[0] != "") {
                if ($result = mysqli_query($link, "INSERT INTO food VALUES ('$restaurant_id', '$array[0]', '$array[1]', '$array[2]', '$array[3]', '$array[4]')")) {
                    echo "<font color='blue'>！資料新增成功！</font>";
                    //mysqli_free_result($result);
                } else {
                    echo "<font color='red'>！資料新增失敗！</font>";
                }
            } else {
                echo "<font color='red'>！資料新增失敗！</font>";
            }
            break;
        case "orderhistory":
            $member_id = $_SESSION["Member_id"];
            $deliveryStaff_id = $_SESSION["DeliveryStaff_id"];
            if ($array[0] != "") {
                if ($result = mysqli_query($link, "INSERT INTO orderhistory VALUES ('$array[0]', '$member_id', '$deliveryStaff_id', '$array[1]', '$array[2]')")) {
                    echo "<font color='blue'>！資料新增成功！</font>";
                    //mysqli_free_result($result);
                } else {
                    echo "<font color='red'>！資料新增失敗！</font>";
                }
            } else {
                echo "<font color='red'>！資料新增失敗！</font>";
            }
            break;
        case "orderdetail":
            $order_id = $_SESSION["Order_id_insert"];
            $restaurant_id = $_SESSION["Restaurant_id"];
            $food_id = $_SESSION["Food_id"];
            if ($result = mysqli_query($link, "INSERT INTO orderdetail VALUES ('$order_id', '$restaurant_id', '$food_id', '$array[0]')")) {
                echo "<font color='blue'>！資料新增成功！</font>";
                //mysqli_free_result($result);
            } else {
                echo "<font color='red'>！資料新增失敗！</font>";
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
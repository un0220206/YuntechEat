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
    $title = $_SESSION['page_ch'] . " - 查詢";
    echo "<center><h2>$title</h2></center>";    
?>
<hr>
<?php
    $table = $_SESSION['table'];
    $link = mysqli_connect("localhost", "root", "", "yuntecheat")
                or die("無法開啟MySQL資料庫連接!<br/>");
    mysqli_query($link, 'SET NAMES utf8');
    echo "<center>";
    echo "<table>";
    switch($table) {
        case "member":
            $member_id = $_SESSION["Member_id"];
            $result = mysqli_query($link, "SELECT * FROM member WHERE memberID = $member_id");
            $ary = array("會員編號", "帳號", "密碼", "姓名", "性別", "生日", "電子郵件");
            break;
        case "deliverystaff":
            $deliveryStaff_id = $_SESSION["DeliveryStaff_id"];
            $result = mysqli_query($link, "SELECT * FROM deliverystaff WHERE deliverystaffID = $deliveryStaff_id");
            $ary = array("外送員編號", "姓名", "電話");
            break;
        case "restaurant":
            $restaurant_id = $_SESSION["Restaurant_id"];
            $result = mysqli_query($link, "SELECT * FROM restaurant WHERE restaurantID = $restaurant_id");
            $ary = array("餐廳編號", "餐廳名稱", "電話", "地址");
            break;
        case "food":
            $restaurant_id = $_SESSION["Restaurant_id"];
            $food_id = $_SESSION["Food_id"];
            $result = mysqli_query($link, "SELECT f.*, r.name, r.tel FROM food as f, restaurant as r WHERE f.restaurantID = r.restaurantID AND f.restaurantID = $restaurant_id AND f.foodID = $food_id");
            $ary = array("餐廳編號", "餐點編號", "餐點名稱", "價錢", "餐點圖片網址", "餐點簡介", "餐廳名稱", "餐廳電話");
            break;
        case "orderhistory":
            $order_id = $_SESSION["Order_id"];
            $result = mysqli_query($link, "SELECT oh.*, m.name, d.name FROM orderhistory as oh, member as m, deliverystaff as d WHERE oh.memberID = m.memberID AND oh.deliverystaffID = d.deliverystaffID AND oh.orderID = $order_id");
            $ary = array("訂單編號", "會員編號", "外送員編號", "訂單建立時間", "是否已送達", "會員姓名", "外送員姓名");
            break;
        case "orderdetail":
            $order_id = $_SESSION["Order_id"];
            $restaurant_id = $_SESSION["Restaurant_id"];
            $food_id = $_SESSION["Food_id"];
            $_SESSION['page_en'] = "orderdetail_manage_RUD";
            $result = mysqli_query($link, "SELECT od.*, oh.creationDatetime, r.name, f.name, f.price FROM orderdetail as od, orderhistory as oh, restaurant as r, food as f WHERE od.orderID = oh.orderID AND od.restaurantID = r.restaurantID AND od.foodID = f.foodID AND f.restaurantID = r.restaurantID AND od.orderID = $order_id AND od.restaurantID = $restaurant_id AND od.foodID = $food_id");
            $ary = array("訂單編號", "餐廳編號", "餐點編號", "小計", "訂單建立時間", "餐廳名稱", "餐點名稱", "餐點價錢");
            break;
    }
    if (isset($result)) {
        $total_fields = mysqli_num_fields($result);
        $row = mysqli_fetch_row($result);
        for ( $i = 0; $i < $total_fields; $i++ )
            echo "<tr> <td>$ary[$i]:</td> <td>$row[$i]</td> </tr>";
        mysqli_free_result($result);
        echo "</table><p>";
    } else {
        echo "<font color='red'>！資料查詢失敗！</font><p>";
    }
    echo "</center>";
    mysqli_close($link);
?>
<form action="control.php" method="post">
<center>
<?php
    echo "<button type='submit' name='btn' value='回" . $_SESSION['page_ch'] . "畫面'>回" . $_SESSION['page_ch'] . "畫面</button>";
?>
</center>
</form>
</body>
</html>
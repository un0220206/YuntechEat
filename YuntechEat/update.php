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
            echo "<tr> <td>$ary[0]:</td> <td>$member_id</td> </tr>";
            break;
        case "deliverystaff":
            $deliveryStaff_id = $_SESSION["DeliveryStaff_id"];
            $result = mysqli_query($link, "SELECT * FROM deliverystaff WHERE deliverystaffID = $deliveryStaff_id");
            $ary = array("外送員編號", "姓名", "電話");
            echo "<tr> <td>$ary[0]:</td> <td>$deliveryStaff_id</td> </tr>";
            break;
        case "restaurant":
            $restaurant_id = $_SESSION["Restaurant_id"];
            $result = mysqli_query($link, "SELECT * FROM restaurant WHERE restaurantID = $restaurant_id");
            $ary = array("餐廳編號", "餐廳名稱", "電話", "地址");
            echo "<tr> <td>$ary[0]:</td> <td>$restaurant_id</td> </tr>";
            break;
        case "food":
            $restaurant_id = $_SESSION["Restaurant_id"];
            $food_id = $_SESSION["Food_id"];
            $result = mysqli_query($link, "SELECT * FROM food WHERE restaurantID = $restaurant_id AND foodID = $food_id");
            $ary = array("餐廳編號", "餐點編號", "餐點名稱", "價錢", "餐點圖片網址", "餐點簡介");
            echo "<tr> <td>$ary[0]:</td> <td>$restaurant_id</td> </tr>";
            echo "<tr> <td>$ary[1]:</td> <td>$food_id</td> </tr>";
            break;
        case "orderhistory":
            $order_id = $_SESSION["Order_id"];
            $result = mysqli_query($link, "SELECT * FROM orderhistory WHERE orderID = $order_id");
            $ary = array("訂單編號", "會員編號", "外送員編號", "訂單建立時間", "是否已送達");
            echo "<tr> <td>$ary[0]:</td> <td>$order_id</td> </tr>";
            break;
        case "orderdetail":
            $order_id = $_SESSION["Order_id"];
            $restaurant_id = $_SESSION["Restaurant_id"];
            $food_id = $_SESSION["Food_id"];
            $_SESSION['page_en'] = "orderdetail_manage_RUD";
            $result = mysqli_query($link, "SELECT * FROM orderdetail WHERE orderID = $order_id AND restaurantID = $restaurant_id AND foodID = $food_id");
            $ary = array("訂單編號", "餐廳編號", "餐點編號", "小計");
            echo "<tr> <td>$ary[0]:</td> <td>$order_id</td> </tr>";
            echo "<tr> <td>$ary[1]:</td> <td>$restaurant_id</td> </tr>";
            echo "<tr> <td>$ary[2]:</td> <td>$food_id</td> </tr>";
            break;
    }
    echo "<form action='control.php' method='post'>";
    if (isset($result)) {
        $total_fields = mysqli_num_fields($result);
        $row = mysqli_fetch_row($result);
        if ($table == "orderdetail") {
            $i = 3;
        } else if ($table == "food"){
            $i = 2;
        } else {
            $i = 1;
        }
        for ( $i; $i < $total_fields; $i++ )
            echo "<tr> <td>$ary[$i]:</td> <td><input type = 'text' name = 'update[]' size = '60' value = '$row[$i]'></td> </tr>";
        echo "</table><p>";
        echo "</center>";
        mysqli_free_result($result);
    } else {
        echo "<font color='red'>！資料查詢失敗！</font><p>";
    }
    mysqli_close($link);
?>

<center>
<button type="submit" name="confirm" value="修改">修改</button>
<?php
    echo "<button type='submit' name='btn' value='回" . $_SESSION['page_ch'] . "畫面'>回" . $_SESSION['page_ch'] . "畫面</button>";
?>
</center>
</form>
</body>
</html>
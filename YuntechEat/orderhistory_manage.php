<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>YuntechEat</title>
</head>
<body>
    <?php
        session_start();
        $_SESSION['page_ch'] = "購買紀錄管理-訂單紀錄";
        $_SESSION['page_en'] = "orderhistory_manage";
        $_SESSION['table'] = "orderhistory";
        $link = mysqli_connect("localhost", "root", "", "yuntecheat")
                or die("無法開啟MySQL資料庫連接!<br/>");
        $sql = "SELECT orderID FROM orderhistory ORDER BY orderID";
        mysqli_query($link, 'SET NAMES utf8');
        $order_id = array();
        if ( $result = mysqli_query($link, $sql) ) { 
            $total_fields = mysqli_num_fields($result);
            while ($row = mysqli_fetch_row($result))
                array_push($order_id, $row[0]);
            mysqli_free_result($result);
        }
        $sql = "SELECT memberID FROM member ORDER BY memberID";
        $member_id = array();
        if ( $result = mysqli_query($link, $sql) ) { 
            $total_fields = mysqli_num_fields($result);
            while ($row = mysqli_fetch_row($result))
                array_push($member_id, $row[0]);
            mysqli_free_result($result);
        }
        $sql = "SELECT deliverystaffID FROM deliverystaff ORDER BY deliverystaffID";
        $deliverystaff_id = array();
        if ( $result = mysqli_query($link, $sql) ) { 
            $total_fields = mysqli_num_fields($result);
            while ($row = mysqli_fetch_row($result))
                array_push($deliverystaff_id, $row[0]);
            mysqli_free_result($result);
        }
        mysqli_close($link);
    ?>

    <hr>
    <center><h1><?php if(isset($_SESSION['page_ch'])) echo $_SESSION['page_ch']; ?></h1></center>
    <hr>
    <center>
        <form name="myForm" action="control.php" method="post">
            <h2>查詢、修改、刪除</h2>
            訂單編號: 
            <select name="Order_id">
                <?php
                    for ($i = 0; $i < count($order_id); $i++) {
                        echo "<option value=". $order_id[$i] .">". $order_id[$i] ."</option>";
                    }
                ?>
            </select><p>
            <button type="submit" name="btn" value="查詢">查詢</button>
            <button type="submit" name="btn" value="修改">修改</button>
            <button type="submit" name="btn" value="刪除">刪除</button><br>
            <hr>
            <h2>新增</h2>
            <?php
                $ary = array("訂單編號", "會員編號", "外送員編號", "訂單建立時間", "是否已送達");
                echo "<table>";
                for ($i = 0; $i < count($ary); $i++) {
                    $field = $ary[$i];
                    if ($i == 1) {
                        echo "<tr> <td>$field:</td>";
                        echo "<td><select name='Member_id'>";
                        for ($j = 0; $j < count($member_id); $j++) {
                            echo "<option value=". $member_id[$j] .">". $member_id[$j] ."</option>";
                        }
                        echo "</select></td></tr>";
                    } else if ($i == 2) {
                        echo "<tr> <td>$field:</td>";
                        echo "<td><select name='Deliverystaff_id'>";
                        for ($j = 0; $j < count($deliverystaff_id); $j++) {
                            echo "<option value=". $deliverystaff_id[$j] .">". $deliverystaff_id[$j] ."</option>";
                        }
                        echo "</select></td></tr>";
                    } else {
                        echo "<tr> <td>$field:</td> <td><input type='text' name='insert[]' size='30'></td> </tr>";
                    }
                }
                echo "</table><br>";
            ?>
            <button type="submit" name="btn" value="新增">新增</button><br>
        <hr>
        <button type="submit" name="confirm" value="回購買紀錄管理畫面">回購買紀錄管理畫面</button><br>
        </form>
    </center>
    <hr>
</body>
</html>
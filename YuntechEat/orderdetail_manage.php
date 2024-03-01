<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>YuntechEat</title>
</head>
<body>
    <?php
        session_start();
        $_SESSION['page_ch'] = "購買紀錄管理-訂單明細";
        $_SESSION['page_en'] = "orderdetail_manage";
        $_SESSION['table'] = "orderdetail";
        $link = mysqli_connect("localhost", "root", "", "yuntecheat")
                or die("無法開啟MySQL資料庫連接!<br/>");
        $sql = "SELECT orderID FROM orderdetail ORDER BY orderID";
        mysqli_query($link, 'SET NAMES utf8');
        $order_id = array();
        if ( $result = mysqli_query($link, $sql) ) { 
            $total_fields = mysqli_num_fields($result);
            while ($row = mysqli_fetch_row($result)) {
                if (!in_array($row[0], $order_id)) {
                    array_push($order_id, $row[0]);
                }
            }
            mysqli_free_result($result);
        }
        $sql = "SELECT restaurantID, foodID FROM food";
        $restaurant_id = array();
        if ( $result = mysqli_query($link, $sql) ) { 
            $total_fields = mysqli_num_fields($result);
            while ($row = mysqli_fetch_row($result)) {
                if (!array_key_exists($row[0], $restaurant_id)) {
                    $restaurant_id[$row[0]] = array();
                }
                array_push($restaurant_id[$row[0]], $row[1]);
            }
            mysqli_free_result($result);
        }
        mysqli_close($link);
    ?>
    
    <script>
        var restaurant_id = <?php echo json_encode($restaurant_id) ?>;
        
        function renew(index){
            index++;
            for(var i=0;i<restaurant_id[index].length;i++)
                document.myForm.Food_id.options[i]=new Option(restaurant_id[index][i], restaurant_id[index][i]);	// 設定新選項
            document.myForm.Food_id.length=restaurant_id[index].length;	// 刪除多餘的選項
        }
    </script>
    
    <hr>
    <center><h1><?php if(isset($_SESSION['page_ch'])) echo $_SESSION['page_ch']; ?></h1></center>
    <hr>
    <center>
        <form name="myForm" action="control.php" method="post">
            <h2>選擇操作的訂單編號(查詢、修改、刪除)</h2>
            訂單編號: 
            <select name="Order_id">
                <?php
                    for ($i = 0; $i < count($order_id); $i++) {
                        echo "<option value=". $order_id[$i] .">". $order_id[$i] ."</option>";
                    }
                ?>
            </select><p>
            <button type="submit" name="confirm" value="確定">確定</button><br>
            <hr>
            <h2>新增</h2>
            <?php
                $ary = array("訂單編號", "餐廳編號", "餐點編號", "小計");
                echo "<table>";
                for ($i = 0; $i < count($ary); $i++) {
                    $field = $ary[$i];
                    if ($i == 0) {
                        echo "<tr> <td>$field:</td>";
                        echo "<td><select name='Order_id_insert'>";
                        for ($j = 0; $j < count($order_id); $j++) {
                            echo "<option value=". $order_id[$j] .">". $order_id[$j] ."</option>";
                        }
                        echo "</select></td></tr>";
                    } else if ($i == 1) {
                        echo "<tr> <td>$field:</td>";
                        echo "<td><select name = 'Restaurant_id' onChange='renew(this.selectedIndex);'>";
                        $array = array_keys($restaurant_id);
                        for ($j = 0; $j < count($array); $j++) {
                            echo "<option value=". $array[$j] .">". $array[$j] ."</option>";
                        }
                        echo "</select></td></tr>";
                    } else if ($i == 2) {
                        echo "<tr> <td>$field:</td>";
                        echo "<td><select name='Food_id'>";
                        $array = array_keys($restaurant_id);
                        for ($j = 0; $j < count($restaurant_id[$array[0]]); $j++) {
                            echo "<option value=". $restaurant_id[$array[0]][$j] .">". $restaurant_id[$array[0]][$j] ."</option>";
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
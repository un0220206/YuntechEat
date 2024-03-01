<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>YuntechEat</title>
	<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
<style type="text/css">
body {
	background-image: url(images/main_bg.png);
	background-repeat: no-repeat;
	background-position:center top;
}
body,td,th {
	font-size: medium;
	position: relative;
	text-align: center;
}
</style>
</head>
<body>
<center>
<h1>&nbsp;</h1>
<p>&nbsp;</p>
<p>&nbsp;</p>
<p>&nbsp;</p>
</center>
    <?php
        session_start();
        $_SESSION['page_ch'] = "食物管理";
        $_SESSION['page_en'] = "food_manage";
        $_SESSION['table'] = "food";
        $link = mysqli_connect("localhost", "root", "", "yuntecheat")
                or die("無法開啟MySQL資料庫連接!<br/>");
        $sql = "SELECT restaurantID, foodID FROM food";
        mysqli_query($link, 'SET NAMES utf8');
        $food_id = array();
        if ( $result = mysqli_query($link, $sql) ) { 
            $total_fields = mysqli_num_fields($result);
            while ($row = mysqli_fetch_row($result)) {
                if (!array_key_exists($row[0], $food_id)) {
                    $food_id[$row[0]] = array();
                }
                array_push($food_id[$row[0]], $row[1]);
            }
            mysqli_free_result($result);
        }
        $sql = "SELECT restaurantID FROM restaurant";
        $restaurant_id = array();
        if ( $result = mysqli_query($link, $sql) ) { 
            $total_fields = mysqli_num_fields($result);
            while ($row = mysqli_fetch_row($result))
                array_push($restaurant_id, $row[0]);
            mysqli_free_result($result);
        }         
        mysqli_close($link);
    ?>
    <script>
        var restaurant_id = <?php echo json_encode($food_id) ?>;
        
        function renew(index){
            index++;
            for(var i=0;i<restaurant_id[index].length;i++)
                document.myForm.Food_id.options[i]=new Option(restaurant_id[index][i], restaurant_id[index][i]);	// 設定新選項
            document.myForm.Food_id.length=restaurant_id[index].length;	// 刪除多餘的選項
        }
    </script>

    
    <center><h1><?php if(isset($_SESSION['page_ch'])) echo $_SESSION['page_ch']; ?></h1></center>
    

    <form name="myForm" action="control.php" method="post">
        <center>
        <h2>查詢、修改、刪除</h2>
        餐廳編號: 
        <select name = "Restaurant_id" onChange="renew(this.selectedIndex);">
            <?php
                $array = array_keys($food_id);
                for ($i = 0; $i < count($array); $i++) {
                    echo "<option value=". $array[$i] .">". $array[$i] ."</option>";
                }
            ?>
        </select><p>
        
        餐點編號: 
        <select name="Food_id">
            <?php
                $array = array_keys($food_id);
                for ($i = 0; $i < count($food_id[$array[0]]); $i++) {
                    echo "<option value=". $food_id[$array[0]][$i] .">". $food_id[$array[0]][$i] ."</option>";
                }
            ?>
        </select><p>
        
        <button type="submit" name="btn" value="查詢">查詢</button>
        <button type="submit" name="btn" value="修改">修改</button>
        <button type="submit" name="btn" value="刪除">刪除</button><br>
        
        <h2>新增餐點</h2>
        <?php
            $ary = array("餐廳編號", "餐點編號", "餐點名稱", "價錢", "餐點圖片網址", "餐點簡介");
            echo "<table>";
            for ($i = 0; $i < count($ary); $i++) {
                $field = $ary[$i];
                if ($i == 0) {
                    echo "<tr> <td>$field:</td>";
                    echo "<td><select name='Restaurant_id_insert'>";
                    for ($j = 0; $j < count($restaurant_id); $j++) {
                        echo "<option value=". $restaurant_id[$j] .">". $restaurant_id[$j] ."</option>";
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
        <button type="submit" name="confirm" value="回主畫面">回主畫面</button><br>
        </center>
    </form>
    <hr>
</body>
</html>
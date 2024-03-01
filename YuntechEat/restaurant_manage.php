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
        $_SESSION['page_ch'] = "餐廳管理";
        $_SESSION['page_en'] = "restaurant_manage";
        $_SESSION['table'] = "restaurant";
        $link = mysqli_connect("localhost", "root", "", "yuntecheat")
                or die("無法開啟MySQL資料庫連接!<br/>");
        $sql = "SELECT restaurantID FROM restaurant";
        mysqli_query($link, 'SET NAMES utf8');
        $restaurant_id = array();
        if ( $result = mysqli_query($link, $sql) ) { 
            $total_fields = mysqli_num_fields($result);
            while ($row = mysqli_fetch_row($result))
                array_push($restaurant_id, $row[0]);
            mysqli_free_result($result);
        } 
        mysqli_close($link);
    ?>
    
    <center><h1><?php if(isset($_SESSION['page_ch'])) echo $_SESSION['page_ch']; ?></h1></center>
    

    <form action="control.php" method="post">
        <center>
        <h2>查詢、修改、刪除</h2>
        餐廳編號: 
        <select name="Restaurant_id">
            <?php
                for ($i = 0; $i < count($restaurant_id); $i++) {
                    echo "<option value=". $restaurant_id[$i] .">". $restaurant_id[$i] ."</option>";
                }
            ?>
        </select><p>
        <button type="submit" name="btn" value="查詢">查詢</button>
        <button type="submit" name="btn" value="修改">修改</button>
        <button type="submit" name="btn" value="刪除">刪除</button><br>
        
        <h2>新增合作餐廳</h2>
        <?php
            $ary = array("餐廳編號", "餐廳名稱", "電話", "地址");
            echo "<table>";
            for ($i = 0; $i < count($ary); $i++) {
                $field = $ary[$i];
                echo "<tr> <td>$field:</td> <td><input type='text' name='insert[]' size='30'></td> </tr>";
            }
            echo "</table><br>";
        ?>
        <button type="submit" name="btn" value="新增">新增</button><br>
        <center>
<p>&nbsp;</p>
        <button type="submit" name="confirm" value="回主畫面">回主畫面</button><br>
        </center>
    </form>
    
</body>
</html>
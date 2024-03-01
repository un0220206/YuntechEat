<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>YuntechEat</title>
</head>
<body>
    <?php
        session_start();
        $order_id = $_SESSION["Order_id"];
        $_SESSION['page_en'] = "orderdetail_manage";
        $link = mysqli_connect("localhost", "root", "", "yuntecheat")
                or die("無法開啟MySQL資料庫連接!<br/>");
        $sql = "SELECT * FROM orderdetail WHERE orderID = $order_id";
        mysqli_query($link, 'SET NAMES utf8');
        $restaurant_id = array();
        if ( $result = mysqli_query($link, $sql) ) { 
            $total_fields = mysqli_num_fields($result);
            while ($row = mysqli_fetch_row($result)) {
                if (!array_key_exists($row[1], $restaurant_id)) {
                    $restaurant_id[$row[1]] = array();
                }
                array_push($restaurant_id[$row[1]], $row[2]);
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

    <form name="myForm" action="control.php" method="post">
        <center>
        <h2>查詢、修改、刪除</h2>
            餐廳編號: 
            <select name = "Restaurant_id" onChange="renew(this.selectedIndex);">
                <?php
                    $array = array_keys($restaurant_id);
                    for ($i = 0; $i < count($array); $i++) {
                        echo "<option value=". $array[$i] .">". $array[$i] ."</option>";
                    }
                ?>
            </select><p>
            
            餐點編號: 
            <select name="Food_id">
                <?php
                    $array = array_keys($restaurant_id);
                    for ($i = 0; $i < count($restaurant_id[$array[0]]); $i++) {
                        echo "<option value=". $restaurant_id[$array[0]][$i] .">". $restaurant_id[$array[0]][$i] ."</option>";
                    }
                ?>
            </select><p>
            
            <button type="submit" name="btn" value="查詢">查詢</button>
            <button type="submit" name="btn" value="修改">修改</button>
            <button type="submit" name="btn" value="刪除">刪除</button><br>
            <hr>
        <?php
                echo "<button type='submit' name='btn' value='回" . $_SESSION['page_ch'] . "畫面'>回" . $_SESSION['page_ch'] . "畫面</button>";
            ?>
            </center>
    </form>
    <hr>
</body>
</html>
<?php
    session_start();
    if (isset($_POST['manage'])) $manage = $_POST['manage'];
    if (isset($_POST['btn'])) $btn = $_POST['btn'];
    if (isset($_POST['confirm'])) $confirm = $_POST['confirm'];
    if (isset($_POST["Member_id"])) $_SESSION['Member_id'] = $_POST["Member_id"];
    if (isset($_POST["DeliveryStaff_id"])) $_SESSION['DeliveryStaff_id'] = $_POST["DeliveryStaff_id"];
    if (isset($_POST["Restaurant_id"])) $_SESSION['Restaurant_id'] = $_POST["Restaurant_id"];
    if (isset($_POST["Food_id"])) $_SESSION['Food_id'] = $_POST["Food_id"];
    if (isset($_POST["Order_id"])) $_SESSION['Order_id'] = $_POST["Order_id"];
    if (isset($_POST['order'])) $order = $_POST['order'];
    if (isset($_POST['Order_id_insert'])) $_SESSION['Order_id_insert'] = $_POST["Order_id_insert"];
    if (isset($_POST['Restaurant_id_insert'])) $_SESSION['Restaurant_id_insert'] = $_POST["Restaurant_id_insert"];
    switch ($manage){
        case "會員管理":
            header("Location: member_manage.php");
            break;
        case "外送員管理":
            header("Location: deliverystaff_manage.php");
            break;
        case "餐廳管理":
            header("Location: restaurant_manage.php");
            break;
        case "食物管理":
            header("Location: food_manage.php");
            break;
        case "購買紀錄管理":
            header("Location: order_manage.php");
            break;
    }
    switch ($btn){
        case "查詢":
            header("Location: select.php");
            break;
        case "修改":
            header("Location: update.php");
            break;
        case "刪除":
            header("Location: delete.php");
            break;
        case "新增":
            if (isset($_POST['insert'])) $_SESSION['insert'] = $_POST['insert'];
            header("Location: insert.php");
            break;
        case "回" . $_SESSION['page_ch'] . "畫面":
            $file = $_SESSION['page_en'] . ".php";
            header("Location: $file");
            break;
    }
    switch ($confirm){
        case "修改":
            if (isset($_POST['update'])) $_SESSION['update'] = $_POST['update'];
            header("Location: updateResult.php");
            break;
        case "回主畫面":
            header("Location: main.php");
            break;
        case "回購買紀錄管理畫面":
            header("Location: order_manage.php");
            break;
        case "確定":
            header("Location: orderdetail_manage_RUD.php");
            break;
    }
    switch ($order){
        case "訂單記錄":
            header("Location: orderhistory_manage.php");
            break;
        case "訂單明細":
            header("Location: orderdetail_manage.php");
            break;
    }
?>
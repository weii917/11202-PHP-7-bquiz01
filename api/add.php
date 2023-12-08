<?php
include_once "db.php";
// 轉成首字大寫存進物件名稱變數
$DB=${ucfirst($_POST['table'])};
// 把取得table存進變數
$table=$_POST['table'];

if(isset($_FILES['img']['tmp_name'])){
    move_uploaded_file($_FILES['img']['tmp_name'],"../img/".$_FILES['img']['name']);
    $_POST['img']=$_FILES['img']['name'];
}

unset($_POST['table']);
$DB->save($_POST);

to("../back.php?=do$table");

?>
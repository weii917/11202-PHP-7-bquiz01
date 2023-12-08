<?php
include_once "db.php";
// 撈出資料庫id=1的資料，將post來的值存進變數total
// 在存進資料庫因為有id所以會是編輯
$bottom=$Bottom->find(1);
$bottom['bottom']=$_POST['bottom'];
$Bottom->save($bottom);
// header("location:$url")的小function
to("../back.php?do=bottom");


?>
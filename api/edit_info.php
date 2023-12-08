<?php
include_once "db.php";

//從點進來的地方附加隱藏的資料表名稱存進POST， 取得資料表名稱
$table=$_POST['table'];
$DB=${ucfirst($table)};
// 取得id為1的資料
$data=$DB->find(1);
// 將資料表對應的欄位修改成post過來的值
$data[$table]=$_POST[$table];
$DB->save($data);
// header("location:$url")的小function
to("../back.php?do=$table");


?>
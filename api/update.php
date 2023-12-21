<!-- 13. 做更新圖片功能到modal/upload.php再到api/update.php更新-->
<?php
include_once "db.php";
// 得到的table先存進變數，物件變數名稱
$table=$_POST['table'];
$DB=${ucfirst($table)};
$row=$DB->find($_POST['id']);
// 判斷有無上傳，移動資料到img資料夾，更新資料庫資料
if(isset ($_FILES['img']['tmp_name'])){
    move_uploaded_file($_FILES['img']['tmp_name'],'../img/'.$_FILES['img']['name']);
   
    $row['img']=$_FILES['img']['name'];
}
$DB->save($row);
to("../back.php?do=$table");
?>
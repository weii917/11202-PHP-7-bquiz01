<?php
include_once "db.php";
$table=$_POST['table'];
$DB=${ucfirst($table)};
unset($_POST['table']);

// 先判斷有沒有id被勾選刪除，在撈資料庫資料將編輯的資料存進資料庫，
// 判斷顯示的title只顯示等於id的checked
// 另外再做id存在於陣列的等於1都顯示checked
foreach($_POST['text'] as $id =>$text){
    if(isset($_POST['del'])&& in_array($id,$_POST['del'])){
        $DB->del($id);
    }else{
        $row=$DB->find($id);
        $row['text']=$text;
        if($table=='title'){
            $row['sh']=(isset($_POST['sh']) && $_POST['sh']==$id)?1:0;
        }else{

            $row['sh']=(isset($_POST['sh']) && in_array($id,$_POST['sh']))?1:0;
        }
        $DB->save($row);
    }
}
to("../back.php?do=$table");
?>
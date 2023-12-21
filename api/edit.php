<!-- 12. 完成標題圖片編輯功能-->
<?php
include_once "db.php";
$table = $_POST['table'];
$DB = ${ucfirst($table)};
unset($_POST['table']);
// 如果post裡有id，新增一個text把id放進索引，值是空的
// 因title ad用text的索引來得到id，所以mvim要編輯要製作一個text帶有id的索引
// 當table附加id當索引時，其他需要配合改變的做法
// if(isset($_POST['id'])){
//     foreach($_POST['id'] as $id){
//         $_POST['text'][$id]='';
//     }

// dd($_POST);
// exit();
// }

// 先判斷有沒有id被勾選刪除，在撈資料庫資料將編輯的資料存進資料庫，
// 因逐一取資料所以id的陣列與其他欄位的陣列都是相對應的所以透過索引可以相應取得同筆資料
// 判斷顯示的title只顯示等於id的checked
// 另外再做id存在於陣列的等於1都顯示checked
foreach ($_POST['id'] as $key => $id) {
    if (isset($_POST['del']) && in_array($id, $_POST['del'])) {
        $DB->del($id);
    } else {
        $row = $DB->find($id);
        if (isset($row['text'])) {
            $row['text'] = $_POST['text'][$key];
        }
        switch ($table) {
            case "title":
                $row['sh'] = (isset($_POST['sh']) && $_POST['sh'] == $id) ? 1 : 0;
                break;
            case "admin":
                $row['acc'] = $_POST['acc'][$key];
                $row['pw'] = $_POST['pw'][$key];
                break;
            case "menu":
                $row['href'] = $_POST['href'][$key];
                $row['sh'] = (isset($_POST['sh']) && in_array($id, $_POST['sh'])) ? 1 : 0;

                break;
            default:
                $row['sh'] = (isset($_POST['sh']) && in_array($id, $_POST['sh'])) ? 1 : 0;
        }

        $DB->save($row);
    }
}
to("../back.php?do=$table");

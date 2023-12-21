<!-- 10.處理新增的功能 -->
<?php
include_once "db.php";
// 轉成首字大寫存進物件名稱變數
$DB = ${ucfirst($_POST['table'])};
// 把取得table存進變數
$table = $_POST['table'];
switch ($table) {
    case "admin":
        unset($_POST['pw2']);
        break;
}
// 如果暫存檔有這檔案，將搬移當按到img裡面，存進post的img
if (isset($_FILES['img']['tmp_name'])) {
    move_uploaded_file($_FILES['img']['tmp_name'], "../img/" . $_FILES['img']['name']);
    $_POST['img'] = $_FILES['img']['name'];
}
if($table != 'admin'){
    $_POST['sh'] = ($table == 'title') ? 0 : 1;

}
// 把Post裡的table移除掉因為資料庫不需要這個資料
unset($_POST['table']);
// 直接用POST因為本身就是陣列，存進資料表


$DB->save($_POST);

to("../back.php?do=$table");

<?php include_once "db.php";
// 過濾表單資料
$acc=htmlspecialchars($_POST['acc']);
$pw=htmlspecialchars($_POST['pw']);


// 帳號密碼檢查
if($Admin->count(['acc'=>$acc,'pw'=>$pw])>0){
    $_SESSION['login']=$acc;
    to("../back.php");
}else{
    to("../index.php?do=login&error=帳號密碼錯誤");
}


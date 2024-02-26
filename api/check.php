<?php include_once "db.php";
// 1.過濾表單資料
// $acc=htmlspecialchars($_POST['acc']);
// $pw=htmlspecialchars($_POST['pw']);


// 帳號密碼檢查
// if($Admin->count(['acc'=>$acc,'pw'=>$pw])>0){
//     $_SESSION['login']=$acc;
//     to("../back.php");
// }else{
//     to("../index.php?do=login&error=帳號密碼錯誤");
// }

// 2.將表單檢查工作移到class db 去進行
// if($Admin->count(['acc'=>$_POST['acc'],'pw'=>$_POST['pw']])>0){
//     $_SESSION['login']=$_POST['acc'];
//    to("../back.php");
// }else{
//     to("../index.php?do=login&error=帳號或密碼錯誤");
// }



// 3.登入及帳號密碼欄位增加md5編碼
if ($Admin->count(['acc' => $_POST['acc'], 'pw' => md5($_POST['pw'])]) > 0) {
    $_SESSION['login'] = $_POST['acc'];
    to("../back.php");
} else {
    to("../index.php?do=login&error=帳號或密碼錯誤");
}

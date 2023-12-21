<!-- 9.建立modal新增圖片的畫面 -->
<h3>新增網站標題圖片</h3>
<hr>
<form action="./api/add.php" method="post" enctype="multipart/form-data">
<table>
    <tr>
        <td>標題區圖片</td>
        <td><input type="file" name="img" id=""></td>
    </tr>
    <tr>
        <td>標題區替代文字</td>
        <td><input type="text" name="text" id=""></td>
    </tr>
</table>
<div>
    <!-- back/title.php附加網址帶進來的table，要隱藏送到api/add.php -->
    <input type="hidden" name="table" value="<?=$_GET['table'];?>">
    <input type="submit" value="新增">
    <input type="reset" value="重置">
</div>

</form>
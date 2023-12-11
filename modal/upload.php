<h3>更新網站標題圖片</h3>
<hr>
<form action="./api/update.php" method="post" enctype="multipart/form-data">
<table>
    <tr>
        <td>標題區圖片</td>
        <td><input type="file" name="img" id=""></td>
    </tr>

</table>
<div>
    <!-- 只是停留更新的介面，要帶table及id值到執行頁面update -->
    <input type="hidden" name="table" value="<?=$_GET['table'];?>">
    <input type="hidden" name="id" value="<?=$_GET['id'];?>">
    <input type="submit" value="更新">
    <input type="reset" value="重置">
</div>

</form>
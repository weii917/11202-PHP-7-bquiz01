<!-- 3.複製title.php修改成 進站總人數管理畫面-->
<!-- 4.改路徑至./api/edit_info.php做修改動作 -->
<!-- 6.在表單裡增加隱藏欄位table值是GET $do檔案名稱知道目前在total頁面傳進 edit_info.php知道該執行total資料表-->
<div style="width:99%; height:87%; margin:auto; overflow:auto; border:#666 1px solid;">
    <p class="t cent botli">進站總人數管理</p>
    <form method="post" action="./api/edit_info.php">
        <table style="width:50%;margin:auto">
            <tbody>
                <tr class="yel">
                    <td width="50%">進站總人數</td>
                    <td width="50%">
                        <input type="number" name="total" value="<?= $Total->find(1)['total']; ?>">   
                        <!-- 存進Post資料表名稱從$do得到，也就是網址get到已經存進$do -->
                        <input type="hidden" name="table" value="<?=$do;?>">
                    </td>
                </tr>
            </tbody>
        </table>
        <table style="margin-top:40px; width:70%;">
            <tbody>
                <tr>
                    <td width="200px"></td>
                    <td class="cent"><input type="submit" value="修改確定"><input type="reset" value="重置"></td>
                </tr>
            </tbody>
        </table>

    </form>
</div>
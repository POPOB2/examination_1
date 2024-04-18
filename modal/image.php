<?php
$do=$_GET['do']??'title';
include_once "../base.php";
?>
<!-- 顯示該class的字串內容 -->
<h3 style="text-align: center;"><?=$Str->addModalHeader;?></h3>
<hr>
<form action="./api/add_title.php" method="POST" enctype="multipart/form-data">
    <table>
        <tr>
            <td><?=$Str->addModalCol[0];?></td>
            <td>
                <input type="file" name="img">
            </td>
        </tr>
    </table>
    <div>
        <input type="submit" value="新增">
        <input type="reset" value="重置" >
    </div>
</form>

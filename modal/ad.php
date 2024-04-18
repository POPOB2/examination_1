<?php
/* modal/title.php 執行區塊為JS於網頁背景執行淡入淡出的JS跳轉頁面(視同不同頁面)
   所以該頁和back/title.php於"根目錄/back.php"所include的base.php並無關連 */
// include_once "../base.php"; // 需另外在include base.php取得class Str
// $Str=new Str('title'); // 從該base.php帶入所需的字串
$do=$_GET['do']??'title';
include_once "../base.php";

?>
<!-- 顯示該class的字串內容 -->
<h3 style="text-align: center;"><?=$Str->addModalHeader;?></h3>
<hr>
<form action="./api/add_ad.php" method="POST" enctype="multipart/form-data">
    <table>
        <tr>
            <td><?=$Str->addModalCol[0];?></td>
            <td>
                <input type="text" name="text">
            </td>
        </tr>
    </table>
    <div>
        <input type="submit" value="新增">
        <input type="reset" value="重置" >
    </div>
</form>

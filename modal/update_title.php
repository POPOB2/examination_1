<h3 style="text-align: center;">更新標題區圖片</h3>
<hr>
<!-- 更新新圖片時將下方GET到id和POST拿到的圖片資訊送到api/update_title.php -->
<form action="./api/update_title.php" method="POST" enctype="multipart/form-data">
    <table>
        <tr>
            <td>標題區圖片 : </td>
            <td>
                <input type="file" name="img">
            </td>
        </tr>
    </table>
    <div>
        <!-- 在此次GET傳值夾帶隱藏的id -->
        <input type="hidden" name="id" value="<?=$GET['id']?>">
        <input type="submit" value="更新">
        <input type="reset" value="重置" >
    </div>
</form>

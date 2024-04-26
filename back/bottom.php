<div style="width:99%; height:87%; margin:auto; overflow:auto; border:#666 1px solid;">
    <p class="t cent botli"><?=$Str->header;?></p>
    <form method="post" action="./api/edit_title.php">
        <table width="100%">
            <tbody>
                <tr class="yel">
                    <td width="45%"><?=$Str->imgHead?></td>
                    <td width="23%"><?=$Str->textHead?></td>
                    <td width="7%">顯示</td>
                    <td width="7%">刪除</td>
                </tr>
                <?php
                $rows=$DB->all();
                foreach($rows as $row){
                ?>
                <tr>
                    <td width="45%">
                        <img src="./img/<?=$row['img'];?>" style="width:300px; height:30px">
                    </td>
                    <td width="23%">
                        <input type="text" name="text[]" value="<?=$row['text'];?>"> 
                        <input type="hidden" name="id[]" value="<?=$row['id'];?>">
                    </td>
                    <td width="7%">
                        <input type="radio" name="sh" value="<?=$row['id'];?>" <?=($row['sh']==1)?'checked':'';?>>
                    </td>
                    <td width="7%">
                        <input type="checkbox" name="del[]" value="<?=$row['id'];?>"> 
                    </td>
                    <td>
                        <input type="button" value="<?=$Str->updateImg?>" 
                               onclick="op('#cover','#cvr','./modal/update_title.php?id=<?=$row['id'];?>')">
                    </td>
                </tr>
                <?php } ?>
            </tbody>
        </table>
        <table style="margin-top:40px; width:70%;">
            <tbody>
                <tr>
                    <td width="200px">
                        <input type="button" onclick="op('#cover','#cvr','./modal/<?=$Str->table;?>.php?do=<?=$Str->table;?>')" value="<?=$Str->addBtn;?>">
                    </td>
                    <td class="cent">
                        <input type="submit" value="修改確定">
                        <input type="reset" value="重置">
                    </td>
                </tr>
            </tbody>
        </table>    
    </form>
</div>
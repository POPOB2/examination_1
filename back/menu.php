<div style="width:99%; height:87%; margin:auto; overflow:auto; border:#666 1px solid;">
    <p class="t cent botli"><?=$Str->header;?></p>
    <form method="post" action="./api/edit.php">
        <table width="100%">
            <tbody>
                <tr class="yel">
                    <td width="30%"><?=$Str->tdHead[0]?></td>
                    <td width="30%"><?=$Str->tdHead[1]?></td>
                    <td width="10%"><?=$Str->tdHead[2]?></td>
                    <td width="10%">顯示</td>
                    <td width="10%">刪除</td>
                    <td></td>
                </tr>
                <?php
                $rows=$DB->all(['parent'=>0]); // 0==主選單, 只顯示主選單, 次選單內容只顯示在浮動頁面
                foreach($rows as $row){
                ?>
                <tr>
                    <td>
                        <input type="text" name="text[]" value="<?=$row['text'];?>"> 
                    </td>
                    <td>
                        <input type="text" name="href[]" value="<?=$row['href'];?>"> 
                    </td>
                    <td>
                        <!-- 計算次選單總數 -->
                        <?=$DB->math('count','id',['parent'=>$row['id']]);?> 
                    </td>
                    <td>
                        <input type="checkbox" name="sh[]" value="<?=$row['id'];?>" <?=($row['sh']==1)?'checked':'';?>>
                    </td>
                    <td>
                        <input type="checkbox" name="del[]" value="<?=$row['id'];?>"> 
                    </td>
                    <td>
                        <input type="button" value="<?=$Str->updateImg?>" 
                               onclick="op('#cover','#cvr','./modal/edit_sub.php?id=<?=$row['id'];?>')">
                    </td>
                </tr>
                <input type="hidden" name="id[]" value="<?=$row['id'];?>">
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
        <input type="hidden" name="table" value="<?=$do?>">
    </form>
</div>
<div style="width:99%; height:87%; margin:auto; overflow:auto; border:#666 1px solid;">
    <p class="t cent botli"><?=$Str->header;?></p>
    <form method="post" action="./api/edit.php">
        <table width="100%">
            <tbody>
                <tr class="yel">
                    <td width="70%"><?=$Str->tdHead[0]?></td>
                    <td width="10%">顯示</td>
                    <td width="10%">刪除</td>
                    <td></td>
                </tr>
                <?php
                $all=$DB->math('count','id'); // 獲取資料總數
                $div=3; // 每頁幾張
                $pages=ceil($all/$div); // 頁數(ceil取數字結果的最大數)
                $now=$_GET['p']??1; // 當前所在位置 // 網址帶值以p決定所在頁數, 若無p從第1頁開始
                $start=($now-1)*$div; // 起始資料數(頁數)
/* 1p+3 = 顯示1、2、3
   3p+3 = 顯示7、8、9
   6p+3 = 顯示16、17、18 */
                // SELECT * FROM table limit 0,3
                // SELECT * FROM table limit 3,3
                // SELECT * FROM table limit 6,3
                //第一頁:p=1、now=1、start=0,略過0筆後顯示3筆 //第二頁:p=2、now=2、start=3,略過3筆後顯示3筆 // 第三頁:p=3、now=3、start=6,略過6筆後顯示3筆
                $rows=$DB->all(" limit $start,$div"); //撈出的資料為 //使用limit(參數1:略過的資料數、參數2:顯示的資料數量)的結果 //$start起始位置==略過前面的資料, $div顯示的資料數
                foreach($rows as $row){
                ?>
                <tr>
                    <td>
                        <img src="./img/<?=$row['img'];?>" style="width:150px; height:70px">
                    </td>
                    <td>
                        <input type="checkbox" name="sh[]" value="<?=$row['id'];?>" <?=($row['sh']==1)?'checked':'';?>>
                    </td>
                    <td>
                        <input type="checkbox" name="del[]" value="<?=$row['id'];?>"> 
                    </td>
                    <td>
                        <input type="button" value="<?=$Str->updateImg?>" 
                               onclick="op('#cover','#cvr','./modal/upload.php?id=<?=$row['id'];?>&table=<?=$Str->table;?>')">
                    </td>
                </tr>
                <input type="hidden" name="id[]" value="<?=$row['id'];?>">
                <?php } ?>
            </tbody>
        </table>

        <div class="cent">
            <?php
                // 最小第2頁要顯示左箭頭, 2-1=1, 1>0=顯示左箭頭
                if(($now-1) > 0){
                    $p=$now-1;
                    echo "<a href='?do={$Str->table}&p=$p'> < </a>"; // do=image, {變數化}後可套用至其他需要頁碼的功能
                }
                for($i=1; $i<=$pages; $i++){
                    $fontsize=($now==$i)?'1.4rem':''; // 當前頁數字放大可用GET的p對比判斷
                    // 在此利用網址帶p值給該image.php, 該p值影響上方的$now, $now影響$start的計算結果, $start影響$DB->all()的顯示計算
                    echo "<a href='?do={$Str->table}&p=$i'; style='font-size:$fontsize; text-decoration:none';> "; // ?==跳轉至當前頁、帶值'image'和'p' , 使網頁顯示對應位置的內容 
                    echo "$i";
                    echo " </a>";
                }
                // 目前頁+1 <= 最大總頁數, 顯示右箭頭, 假設當前頁為3,3+1=4,最大頁數為3,3不<=4,不顯示右箭頭
                if(($now+1) <= $pages){
                    $p=$now+1;
                    echo "<a href='?do={$Str->table}&p=$p'> > </a>";
                }
            ?>
        </div>

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
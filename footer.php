<div style="width:1024px; left:0px; position:relative; background:#FC3; margin-top:4px; height:123px; display:block;">
    <span class="t" style="line-height:123px;">
    <?php
        // 宣告new DB的$bottom移到base.php內, 避免每次讀取一個頁尾, 都需宣告一次new DB
        echo $Bot->find(1)['bottom']; // find獲取(id:1)的[列:bottom]
    ?>
    </span>
</div>
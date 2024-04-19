<?php
include_once "../base.php";

/* 編輯功能所需的內容
    1. 判斷是否刪除資料 
    2. 更新文字欄位
    3. 更新顯示狀態
*/
// dd($_POST['id']); // $_POST傳過來的['id']為表單id [0][1][2]
// exit();
if(!empty($_POST['id'])){ // 按下變更鈕=有傳id
    foreach($_POST['id'] as $idx => $id){ // [0][1][2] => [庫ID1][庫ID2][庫ID3]
        if(isset($_POST['del']) && in_array($id, $_POST['del'])){ // 是否有'del值' && 傳來並foreach後的$id是否在$_POST過來的'del陣列'內
            $Title->del($id); // 符合條件至表刪除該筆$id
        }else{
            $row=$Title->find($id); // 至Title表內撈出該筆$di資料
            $row['text']=$_POST['text'][$idx]; // 更新文字欄位
            // dd($id);
            // exit();
            $row['sh']=(isset($_POST['sh']) && $_POST['sh']==$id)?1:0; // ???
            $Title->save($row); // 更新至資料庫
        }
    }

}else{

}

to("../back.php?do=title");
?>
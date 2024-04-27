<?php
include_once "../base.php";
$DB=new DB($_POST['table']);
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
            $DB->del($id); // 符合條件至表刪除該筆$id
        }else{
            $row=$DB->find($id); // 至Title表內撈出該筆$di資料

            // 依不同功能進行不同處理
            switch($_POST['table']){
                // 單複選的問題
                case 'title':
                    $row['text']=$_POST['text'][$idx]; // 更新文字欄位
                    $row['sh']=(isset($_POST['sh']) && $_POST['sh']==$id)?1:0; // 單選顯示
                break;
                // 欄位名稱不同
                case 'admin':
                    $row['acc']=$_POST['acc'][$idx];
                    $row['pw']=$_POST['pw'][$idx];
                break;
                // 欄位名稱不同
                case 'menu':
                    $row['text']=$_POST['text'][$idx];
                    $row['href']=$_POST['href'][$idx];
                    $row['sh']=(isset($_POST['sh']) && in_array($id,$_POST['sh']))?1:0; // $id有在該sh的陣列內為顯示
                break;
                // 只處理文字和顯示
                case 'ad':
                case 'news':
                    $row['text']=$_POST['text'][$idx];
                    $row['sh']=(isset($_POST['sh']) && in_array($id,$_POST['sh']))?1:0;
                break;
                // 只處理顯示
                case 'image':
                case 'mvim':
                    $row['sh']=(isset($_POST['sh']) && in_array($id,$_POST['sh']))?1:0;
                break;
            }
            $DB->save($row); // 更新至資料庫
        }
    }
}

to("../back.php?do={$_POST['table']}");
?>
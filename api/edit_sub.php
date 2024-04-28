<?php
include_once "../base.php";

/* 編輯&刪除, 依據$_POST['id'] */
if(!empty($_POST['id'])){ 
    foreach($_POST['id'] as $idx => $id){ // 迴圈POST傳的id會知道需要刪的是哪一筆資料
        // checkbox被勾選為true才會傳遞POST['del']過來, 當有del傳過來就會通過判斷進行刪除
        if(isset($_POST['del']) && in_array($id, $_POST['del'])){ 
            $Menu->del($id); 
        }else{
            $row=$Menu->find($id); // 從Menu撈出該筆($id)次選單
            $row['text']=$_POST['text'][$idx];
            $row['href']=$_POST['href'][$idx];
            }
            $Menu->save($row); 
        }
    }
/* 新增資料, 依據$_POST['text2']或是$_POST['href2'] */
if(isset($_POST['text2'])){
    foreach($_POST['text2'] as $idx => $text){
        if($text!=''){
            $data['text']=$text;
            $data['href']=$_POST['href2'][$idx];
            $data['parent']=$_POST['parent'];
            $Menu->save($data);
        }
    }
}


to("../back.php?do=menu");


?>
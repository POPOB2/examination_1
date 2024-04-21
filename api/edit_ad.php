<?php
include_once "../base.php";


if(!empty($_POST['id'])){ 
    foreach($_POST['id'] as $idx => $id){
        if(isset($_POST['del']) && in_array($id, $_POST['del'])){
            $Ad->del($id); 
        }else{
            $row=$Ad->find($id); 
            $row['text']=$_POST['text'][$idx]; 

            $row['sh']=(isset($_POST['sh']) && in_array($id,$_POST['sh']))?1:0; // 複選勾選狀態改用in_array(), 確認帶進來的$id是否在該陣列內
            $Ad->save($row); 
        }
    }

}else{

}

to("../back.php?do=ad");
?>
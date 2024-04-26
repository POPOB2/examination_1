<?php
include_once "../base.php";
$DB=new DB($_POST['table']);
$data=[];
$data['id']=$_POST['id'];

if(isset($_FILES['img']['tmp_name'])){
    move_uploaded_file($_FILES['img']['tmp_name'], "../img/".$_FILES['img']['name']); // 新圖片放到這
    $data['img']=$_FILES['img']['name'];
}


$DB->save($data); // 用save()將新圖片資訊, 更新到資料庫

to("../back.php?do={$_POST['table']}");
?>
<?php
include_once "../base.php";
$text=$_POST['text'];

// 將拿到的圖片資訊轉成$img
if(isset($_FILES['img']['tmp_name'])){
    move_uploaded_file($_FILES['img']['tmp_name'],"../img/".$_FILES['img']['name']); // 新圖片放到這
    $img=$_FILES['img']['name'];
}

$id=$_POST['id']; // 上一頁$_GET到的id用form表單傳過來所以在這是$_POST的id
$row=$Title->find($id); // 用find()取一筆資料
$row['img']=$img; // 把新上傳的圖片$img塞給$row
$Title->save($row); // 用save()將新圖片資訊, 更新到資料庫

to("../back.php?do=title");
?>
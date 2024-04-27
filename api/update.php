<?php
include_once "../base.php";

$DB=new DB($_POST['table']); // 撈到傳過來的table
$row=$DB->find(1); // 用該table撈1筆$id的資料
$row[$_POST['table']]=$_POST[$_POST['table']]; // $row[]裡的table=傳過來的table // 因DB的table和欄同名可這樣用
$DB->save($row);
to("../back.php?do=".$_POST['table']);
?>
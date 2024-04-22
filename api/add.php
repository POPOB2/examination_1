<?php
include_once "../base.php";

$DB=new DB($_POST['table']);

$data=[];
if(isset($_FILES['img']['tmp_name'])){
    move_uploaded_file($_FILES['img']['tmp_name'], "../img/".$_FILES['img']['name']);
    $data['img']=$_FILES['img']['name'];
}

// 檢查有無字串, 填值
if(isset($_POST['text'])){
    $data['text']=$_POST['text'];
}

// 除了上述text, 在此依需求針對某些table額外填值
switch($_POST['table']){
    case 'title':
        $data['sh']=0;
    break;
    case 'admin':
        $data['acc']=$_POST['acc'];
        $data['pw']=$_POST['pw'];
    break;
    case 'menu':
        $data['text']=$_POST['text'];
        $data['href']=$_POST['href'];
        $data['sh']=1;
    break;
    default:
        $data['sh']=1;
}

// $text=$_POST['text'];
// $data=['text'=>$text, 'sh'=>1];
$DB->save($data);

to("../back.php?do=$DB->table");
?>
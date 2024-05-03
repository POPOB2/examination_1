<?php
$do=$_GET['do']??'main';
include "base.php";
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<!-- saved from url=(0040)http://127.0.0.1/test/exercise/collage/? -->
<html xmlns="http://www.w3.org/1999/xhtml"><head><meta http-equiv="Content-Type" content="text/html; charset=UTF-8">

<title>卓越科技大學校園資訊系統</title>
<link href="./css/css.css" rel="stylesheet" type="text/css">
<script src="./js/jquery-1.9.1.min.js"></script>
<script src="./js/js.js"></script>
</head>

<body>
<div id="cover" style="display:none; ">
	<div id="coverr">
    	<a style="position:absolute; right:3px; top:4px; cursor:pointer; z-index:9999;" onclick="cl('#cover')">X</a>
        <div id="cvr" style="position:absolute; width:99%; height:100%; margin:auto; z-index:9898;"></div>
    </div>
</div>
	<div id="main">
		<?php include "header.php"; ?>
        	<div id="ms">
             	<div id="lf" style="float:left;">
            		<div id="menuput" class="dbor">

                    	<!--主選單放此-->
						<span class="t botli">主選單區</span>
						<?php
						$mms=$Menu->all(['parent'=>0, 'sh'=>1]);
						foreach($mms as $mm){
							echo "<div class='mainmu'>";
								echo "<a href='{$mm['href']}'>";
									echo $mm['text'];
								echo "</a>";
							// 撈出次選單
							$subs=$Menu->all(['parent'=>$mm['id']]);
								echo "<div class=' mw'>";
								foreach($subs as $sub){
									echo "<div class='mainmu2'>";
										echo "<a href='{$sub['href']}'>";
											echo $sub['text'];
										echo "</a>";
									echo "</div>";
								}
								echo "</div>";
							echo "</div>";
						}
						?>

					</div>
                    	<div class="dbor" style="margin:3px; width:95%; height:20%; line-height:100px;">
                    	<span class="t">進站總人數 : <?=$Total->find(1)['total'];?></span>
                    </div>
        		</div>
			<?php
			// $do=$_GET['do']??'main';
			$file="./front/".$do.".php";
			if(file_exists($file)){
				include "./front/{$do}.php";
			}else{
				include "./front/main.php";
			}
			?>

					<div class="di di ad" style="height:540px; width:23%; padding:0px; margin-left:22px; float:left; ">
                	<!--右邊-->   
                	<button style="width:100%; margin-left:auto; margin-right:auto; margin-top:2px; height:50px;" onclick="lo('?do=admin')">管理登入</button>
                	<div style="width:89%; height:480px;" class="dbor">
                    	<span class="t botli">校園映象區</span>
						<!-- 圖片區域 -->
						<div class="cent"><img src="./icon/up.jpg" onclick="pp(1)"></div>
						<?php
							$imgs=$Image->all(['sh'=>1]);
							foreach($imgs as $idx => $img){
						?>
						<div id="ssaa<?=$idx;?>" class="cent im">
							<img src="./img/<?=$img['img'];?>">
						</div>
						<?php
							}
						?>
						<div class="cent"><img src="./icon/dn.jpg" onclick="pp(2)"></div>

						<script>
                        	var nowpage=0; // nowpage==顯示的圖片編號(最上面的圖的編號)
							var num=<?=$Image->math('count','id',['sh'=>1]);?>; // num==圖片總數 : 計算(id總數 顯示設為1的資料)
							function pp(x){
								var showQty; 
								var showImage; 
								
								if(x==1 && nowpage-1>=0){
									nowpage--;}

								if(x==2 && (nowpage+1) <= (num-3)){ 
									nowpage++;} 

								$(".im").hide() // 先隱藏全部圖片, 在用下方迴圈抓出要顯示的三張圖片
								for(showQty=0; showQty<=2; showQty++){ // showQty==顯示的圖片數量(迴圈次數==數量)
									showImage = showQty + nowpage;  // 迴圈號1、2、3 + nowpage == 下方要設為show()的圖片
									$("#ssaa" + showImage).show();
								}
							}
							pp(1); // 第一次啟用 : 1.隱藏所有.im   2.顯示#ssaa012(012+000=012)
                        </script>
                    </div>
                </div>
                            </div>
             	<div style="clear:both;"></div>
				<?php include "footer.php";?>

    </div>

</body></html>
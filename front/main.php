<div class="di" style="height:540px; border:#999 1px solid; width:53.2%; margin:2px 0px 0px 0px; float:left; position:relative; left:20px;">
	<?php include "marquee.php";?>
	<div style="height:32px; display:block;"></div>
	<!--正中央-->

	<div style="width:100%; padding:2px; height:290px;">
		<div id="mwww" loop="true" style="width:100%; height:100%;">
			<div style="width:99%; height:100%; position:relative;" class="cent">
			沒有資料 <!-- id=mwww需放在js前面, js才找的到並以now=0直接替換 -->
			</div>
		</div>
	</div>


	<script>
		var lin = new Array();
		var now = 0;

		// 撈出顯示圍設為true的gif, 並用push()往陣列後塞入撈出的資料
		<?php
		$mvs=$Mvim->all(['sh'=>1]);
		foreach($mvs as $mv){
		?>
		lin.push("./img/<?=$mv['img'];?>");
		<?php
		}
		?>

		ww(); // 需放在now=1前面, 否則未達3秒就變1, 使第一張出現圖顯示的是第二張圖

		if(lin.length > 1){ // lin=圖片陣列, 總數>1 == 至少有兩個內容(2個內容才需要輪播, 1個不用)
			setInterval("ww()", 3000); //setInterval()==設置循環間隔, 參數1:執行的動作、參數2:每隔XX毫秒
			now = 1;
		}

		function ww(){
			$("#mwww").html("<embed loop=true src='" + lin[now] + "' style='width:99%; height:100%;'></embed>") // 至#mwww置換html為(參數內容), 用loop進行迴圈
			//$("#mwww").attr("src",lin[now])
			now++; 
			if(now>=lin.length){ // 當循環內容>=字串總數意味著圖片總量撥放完畢, 將now變回0, 使循環回到now=0的第一張圖
				now = 0;
			}
		}
	</script>


	<div style="width:95%; padding:2px; height:190px; margin-top:10px; padding:5px 10px 5px 10px; border:#0C3 dashed 3px; position:relative;">
		<span class="t botli">最新消息區</span>
		<ul class="ssaa" style="list-style-type:decimal;">
		<?php
			$ns=$News->all(['sh'=>1], " limit 5");
			foreach($ns as $n){
				echo "<li>";
				echo mb_substr($n['text'],0,20)."..."; // 取20字元顯示
				echo " <span class='all' style='display:none;'>";
				echo $n['text'];
				echo " </span>";
				echo "</li>";
			}
			
		?>
		</ul>
		<div id="altt" style="position: absolute; width: 350px; min-height: 100px; background-color: rgb(255, 255, 204); top: 50px; left: 130px; z-index: 99; display: none; padding: 5px; border: 3px double rgb(255, 153, 0); background-position: initial initial; background-repeat: initial initial;"></div>
		<script>
			$(".ssaa li").hover(function(){
				$("#altt").html("<pre>" + $(this).children(".all").html() + "</pre>")
				$("#altt").show()
				}
			)
			$(".ssaa li").mouseout(function(){
				$("#altt").hide()
				}
			)
		</script>
	</div>
</div>
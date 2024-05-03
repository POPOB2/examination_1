
<div class="di" style="height:540px; border:#999 1px solid; width:53.2%; margin:2px 0px 0px 0px; float:left; position:relative; left:20px;">
	<?php include "marquee.php";?>
	<div style="height:32px; display:block;"></div>
	<!--正中央-->
	<div class="cent">更多最新消息</div>
	<hr>
			<?php
                $all=$News->math('count','id',['sh'=>1]); 
                $div=5;
                $pages=ceil($all/$div); 
                $now=$_GET['p']??1; 
                $start=($now-1)*$div; // 頁碼的文章起始編號=當前頁碼-1*一頁顯示的筆數

                $rows=$News->all(" limit $start,$div"); 

				echo "<ol start='".($start+1)."'>"; // 翻頁後 編號接續, 因id從0開始  +1從1開始
                foreach($rows as $row){
					echo "<li class='sswww'>";
						echo mb_substr($row['text'],0,20);
						echo "<span class='all' style='display:none' >";
						echo $row['text'];
						echo "</span>";
					echo "</li>";
				} 
				echo "</ol>";
				?>
            </tbody>
        </table>

        <div class="cent">
            <?php
                if(($now-1) > 0){
                    $p=$now-1;
                    echo "<a href='?do={$Str->table}&p=$p'> < </a>"; 
                }
                for($i=1; $i<=$pages; $i++){
                    $fontsize=($now==$i)?'1.4rem':''; 
                    echo "<a href='?do={$Str->table}&p=$i'; style='font-size:$fontsize; text-decoration:none';> "; 
                    echo "$i";
                    echo " </a>";
                }
                if(($now+1) <= $pages){
                    $p=$now+1;
                    echo "<a href='?do={$Str->table}&p=$p'> > </a>";
                }
            ?>
        </div>
</div>
<div id="alt" style="position: absolute; width: 350px; min-height: 100px; word-break:break-all; text-align:justify;  background-color: rgb(255, 255, 204); top: 50px; left: 400px; z-index: 99; display: none; padding: 5px; border: 3px double rgb(255, 153, 0); background-position: initial initial; background-repeat: initial initial;"></div>
	<script>
		$(".sswww").hover(function (){
				$("#alt").html("<pre>"+$(this).children(".all").html()+"</pre>").css({"top":$(this).offset().top-50})
				$("#alt").show()
			}
		)
		$(".sswww").mouseout(function(){
				$("#alt").hide()
			}
		)
	</script>
                                 
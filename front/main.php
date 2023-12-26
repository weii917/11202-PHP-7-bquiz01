<div class="di" style="height:540px; border:#999 1px solid; width:53.2%; margin:2px 0px 0px 0px; float:left; position:relative; left:20px;">
	<?php include "marquee.php"; ?>
	<div style="height:32px; display:block;"></div>
	<!--正中央-->

	<div style="width:100%; padding:2px; height:290px;">
		<div id="mwww" loop="true" style="width:100%; height:100%;">
			<div style="width:99%; height:100%; position:relative;" class="cent">沒有資料</div>
		</div>
	</div>
	<script>
		// 宣告一個陣列，把資料庫撈出來的img檔名，存進lin裡面，顯示圖片時依據索引顯示
		var lin = new Array();
		<?php
		$lins = $Mvim->all(['sh' => 1]);
		foreach ($lins as $lin) {
			echo "lin.push('{$lin['img']}');";
		}
		?>

		var now = 0;
		// 一載入網頁執行顯示照片，在now變1之前先執行1次顯示索引0第一張照片，因3秒後才會顯示輪播照片，並且now=1
		ww();
		// 如果大於1有2張圖片執行每三秒輪播圖片，
		if (lin.length > 1) {
			setInterval("ww()", 3000);
			now = 1;
		}

		function ww() {
			$("#mwww").html("<embed loop=true src='./img/" + lin[now] + "' style='width:99%; height:100%;'></embed>")
			//$("#mwww").attr("src",lin[now])
			now++;
			if (now >= lin.length)
				now = 0;
		}
	</script>
	<div style="width:95%; padding:2px; height:190px; margin-top:10px; padding:5px 10px 5px 10px; border:#0C3 dashed 3px; position:relative;">
		<span class="t botli">最新消息區
			<?php
			if ($News->count(['sh' => 1]) > 5) {
				echo "<a href='?do=news' style='float:right'>More...</a>";
			}

			?>

		</span>
		<!--class='all'框框的訊息先隱藏，當hover會觸發function動作顯示出來  -->
		<ul class="ssaa" style="list-style-type:decimal;">
			<?php
			$news = $News->all(['sh' => 1], ' limit 5');
			foreach ($news as $n) {
				echo "<li>";
				echo mb_substr($n['text'], 0, 20);
				echo "<div class='all' style='display:none'>";
				echo $n['text'];
				echo "</div>";
				echo "...</li>";
			}

			?>
		</ul>
		<div id="altt" style="position: absolute; width: 350px; min-height: 100px; background-color: rgb(255, 255, 204); top: 50px; left: 130px; z-index: 99; display: none; padding: 5px; border: 3px double rgb(255, 153, 0); background-position: initial initial; background-repeat: initial initial;">

		</div>
		<script>
			// show出來的層級div會較li大所以壓過li的訊息，
			// 滑鼠在li上會顯示li底下子項目的class='all'裡的資料
			$(".ssaa li").hover(
				function() {

					$("#altt").html("<pre>" + $(this).children(".all").html() + "</pre>")
					$("#altt").show()
				}
			)
			//移開會消失，如果滑鼠在.all那一層因為變成hover在div不是li了所以觸發mouseout事件，此區塊訊息會消失，
			// 會造成閃爍，要從最前移動不要碰到.all談出的黃框訊息
			$(".ssaa li").mouseout(
				function() {
					$("#altt").hide()
				}
			)
		</script>
	</div>
</div>
<?php  
session_start();
	$artis = $_SESSION['artis'];
	if(empty($artis)){
		require 'pull.php';
		$artis = $_SESSION['artis'];
	}
	// this file
	$arti = $artis[array_rand($artis)];
	$textContent = file_get_contents($arti);
	$title = explode('/', $arti);
 ?> 
<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<title><?php echo substr($title[3],0,-3) ?></title>
	<link rel="icon" sizes="48x48" href="http://kelvin.vip/me.ico">
</head>
<style>
#idx{
position: fixed;
top: 5vh;
right:5vw;
}
#show{
	border:1px dashed ivory;
}
</style>
<body >
  <input type="hidden" name="textContent" id="textContent" value="<?php echo $textContent; ?>">
	<div id="content" onmousedown="whichButton(event)" style="padding:10px 64px"></div>
	<div id="idx" style="">
		<input type="text" id="show"/>
	</div>
	<script src="marked.min.js"></script>
	<script>
	  // 关闭右键菜单
	  document.oncontextmenu = function(){
	　　return false;
		}
		document.onkeydown = function(e) {
			let code = e.keyCode
			document.getElementById('show').value = code;
			switch(code){
				case 78: //N
				 location.reload();
				 break;
				
				case 84: //T
				 window.scroll(0, 0);
				 break;
				case 66: //B
				 window.scroll(0, document.body.clientHeight)
				 break;
				case 85: //U
				 window.scroll(0, window.scrollY - (window.innerHeight/2));
				 break;
				case 68: //D
				 window.scroll(0, window.scrollY + (window.innerHeight/2));
				 break;




				case 72: //H
				 window.scroll(window.scrollX - 30, 0);
				 break;
				case 74: //J
				 window.scroll(0, window.scrollY + 30);
				 break;
				case 75: //K
				 window.scroll(0, window.scrollY - 30);
				 break;
				case 76: //L
				 window.scroll(window.scrollX + 30, 0);
				 break;
			}
		}
		document.getElementById('content').innerHTML = marked(document.getElementById("textContent").value);
		// 监听鼠标
		function whichButton(e){
			return;
			if(e.button === 2) {
				let idxStyle = document.getElementById('idx').style;
				idxStyle.left = e.clientX;
				idxStyle.top = e.clientY;
				idxStyle.display = 'block';
			} else {
				document.getElementById('idx').style.display = 'none';
			}
		}
	</script>
</body>
</html>

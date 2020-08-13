<?php  
session_start();
	echo'<link rel="icon" sizes="48x48" href="http://kelvin.vip/favorite.ico">';
	$type = $_GET['t'];
#phpinfo();
	$artis = $_SESSION['artis'];
	function type_filter($v){
		return explode('/', $v)[2] == $_GET['t'];
	}
	if(!empty($type)){
		$artis = array_filter($artis, 'type_filter');
	}
	if(empty($artis)){
		require 'pull.php';
		$artis = $_SESSION['artis'];
	}
	// this file
	$arti = $artis[array_rand($artis)];
	$file = explode('/', $arti)[3];
	$ext = explode('.',$file)[1];
	$mdContent = $pdfContent = '';
	if($ext=='md') {
		$mdContent = file_get_contents($arti);
#		$mdContent = str_replace('"', '&quot;', $mdContent);
	}else if($ext=='pdf'){
		$pdfContent = $arti;
	}
	?> 
<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<title><?php echo explode('.', $file)[0] ?></title>
	<meta content="www.kelvin.vip" name="Copyright"> 
	<meta content="<?php echo explode('.', $file)[0] ?>" name="Keywords"> 
	<meta content="<?php echo explode('.', $file)[0] ?>" name="Description"> 
	<link rel="icon" sizes="48x48" href="http://kelvin.vip/favorite.ico">
</head>
<style>
#idx{
position: fixed;
top: 5vh;
right:15vw;
}
#show{
border:1px dashed ivory;
background: transparent;
}
</style>
<body >
	<?php if(!empty($mdContent)){
			require 'Parsedown.php';
			$Parsedown = new Parsedown();
			echo '<div id="content" style="padding:10px 64px">'.$Parsedown->text($mdContent).'</div>';
	} ?>

	<?php if(!empty($pdfContent)) {
		echo '<embed src="'.$pdfContent.'"  width="100%" height="100%"></embed>';
	} ?>
	<div id="idx" style="">
		<input type="text" id="show"/>
	</div>
	<script src="js/common.js"></script>
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
				case 13: //Enter
				 toggleFullScreen();
				 break;

				// type
				case 82: //R ruankao
				 location.href='http://kelvin.vip?t=rk';
				 break;
				case 77: //M mysql
				 location.href='http://kelvin.vip?t=mysql';
				 break;
				case 83: //S stock
				 location.href='http://kelvin.vip?t=stock';
				 break;
				case 86: //V JVM
				 location.href='http://kelvin.vip?t=jvm';
				 break;
				case 80: //P pattern
				 location.href='http://kelvin.vip?t=pattern';
				 break;

				// operation
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
				 window.scroll(window.scrollX - 30, window.scrollY);
				 break;
				case 74: //J
				 window.scroll(window.scrollX, window.scrollY + 30);
				 break;
				case 75: //K
				 window.scroll(window.scrollX, window.scrollY - 30);
				 break;
				case 76: //L
				 window.scroll(window.scrollX + 30, window.scrollY);
				 break;
			}
		}

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

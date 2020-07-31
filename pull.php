<?php
session_start();
	echo shell_exec('cd ./kelvin-doc/ && git pull');

	$dirs_path = './kelvin-doc';
	$ex_dir = array('.', '..', 'README.md', '.git');
	$artis = array();

	$dirs = array_diff(scandir($dirs_path), $ex_dir);
	$idx = array();
	foreach($dirs as $d) {
		$fs = array_diff(scandir($dirs_path.'/'.$d), $ex_dir);
		$idx[$d] = $fs;
		foreach($fs as $f) {
			array_push($artis, $dirs_path.'/'.$d.'/'.$f);
		}
	}
	$_SESSION['artis'] = $artis;

	$_SESSION['artisIdx'] = $idx;;
	echo '<a href="http://kelvin.vip">back home</a><br/>';


?>

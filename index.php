<?php
	require_once './counter.php';
	$num  = counter();

	echo "<br/>";
	echo "<a href='showhistory.php' style='color:black;text-decoration:none'><b>历史访问:$num[0]</b></a><br/>";
	echo  "<b>今日访问:$num[1]</b>";

	
?>
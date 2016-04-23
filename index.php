<?php
	require_once './counter.php';
	$num  = counter();

	echo "<br/>";
	echo "<a href='see_history.php'><p>总访问量:$num[0]</p></a>";
	echo  "<p>您是今天第$num[1]位访问者</p>";

	
?>
<?php
function counter(){
	$numUrl = "./counter.txt";
	$ipUrl = "./ip.txt";
	$everydayUrl ="./everyday.txt";
	$everyhourUrl = "./everyhour.txt";
	$nowIp = $_SERVER['REMOTE_ADDR'];
	$nowTime = $_SERVER['REQUEST_TIME'];
	$counter = explode(';',file_get_contents($numUrl)); //总访问量
	$counter[0] = (int)$counter[0];	
	$log = explode(';',file_get_contents($ipUrl));
	$everyDay = explode(';',file_get_contents($everydayUrl));
	$everyHour = explode(';',file_get_contents($everyhourUrl));
	$flag = 0;
	$add = 0;
	$length = empty($log[0]) ? 0:count($log);
	date_default_timezone_set("PRC") ;	//设置时区
	$hour = date("H",$nowTime);
	//echo $hour;
	for($i = 0 ; $i < $length ;$i += 2){
		if($log[$i] == $nowIp){
			$flag = 1;   //这个ip出现过
			if($nowTime - $log[$i+1] > 3600){  //距离上次访问超过1个小时
				$counter[0]++;
				$add = 1;
				$log[$i+1] = $nowTime;
				for($j = 0;$j < 48;$j+=2){
					if($everyHour[$j]==$hour){
						$everyHour[$j+1] = (int)$everyHour[$j+1];
						$everyHour[$j+1] ++ ;
					}
				}
			}
		}
	}
	if($flag == 0){  //这个ip第一次出现
		$log[$i] = $nowIp;
		$log[$i+1] = $nowTime;
		$counter[0]++;
		for($j = 0;$j < 48;$j+=2){
			if($everyHour[$j]==$hour){
				$everyHour[$j+1] = (int)$everyHour[$j+1];
				$everyHour[$j+1] ++ ;
			}
		}
	}
	$length = empty($everyDay[0]) ? 0:count($everyDay);

	$today = date("Y-m-d", $nowTime);
	$first = 1;  //今日第一个访问
	$todayLog = 0 ; 
	if($add||$flag ==0){
		for($i = 0; $i<$length;$i+=2){
			if($everyDay[$i]==$today){
				$everyDay[$i+1] = (int)$everyDay[$i+1];
				$everyDay[$i+1]++;
				$todayNum = $everyDay[$i+1];
				$first = 0;
			}
		} 
		if($first){
			$everyDay[$i] = $today;
			$everyDay[$i+1] = 1;
			$todayNum = 1;
		}

	}else{
		for($i = 0; $i<$length;$i+=2){
			if($everyDay[$i]==$today){
				$todayLog = 1;
				$todayNum = $everyDay[$i+1];
			}
		}
		if($todayLog == 0){
			$todayNum = 1;   
		}
	}
	$totalNum = $counter[0];
	file_put_contents($numUrl, implode(";", $counter));
	file_put_contents($ipUrl, implode(";", $log));
	file_put_contents($everydayUrl, implode(";", $everyDay));
	file_put_contents($everyhourUrl, implode(';', $everyHour));
	$result = array($totalNum , $todayNum);
	return $result;
}
function showEveryday(){
	$everydayUrl ="./everyday.txt";
	$everyDay = explode(';',file_get_contents($everydayUrl));
	$length = empty($everyDay[0]) ? 0:count($everyDay);
	for($i = 0;$i<$length;$i+=2){
		echo $everyDay[$i].":";
		echo $everyDay[$i+1]."<br/>";
	}
}
function showEveryhour(){
	$everyhourUrl = "./everyhour.txt";
	$everyHour = explode(';',file_get_contents($everyhourUrl));
	for($i = 0;$i<48;$i+=2){
		echo $everyHour[$i]."-".$everyHour[($i+2)%48].':';
		echo $everyHour[$i+1]."<br/>";
	}
}
?>

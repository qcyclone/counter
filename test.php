<?php

date_default_timezone_set("PRC") ;  //设置时区
$conn=new mysqli("localhost", "root", "test", "oj");
//$conn=new mysqli("localhost", "root", "123456", "moodle");
$nowTime = $_SERVER['REQUEST_TIME'];
$today = date("Y-m-d", $nowTime);
$temp=$conn->query("SELECT `day`,`num` FROM `counter` WHERE `day`='$today'");
$temp=$temp->fetch_all();
function counter(){
   // print_r($temp);
    global $today;
    global $temp;
    global $conn;
    $todayNum;
    if ($temp){  
    	$privilege=$temp[0][1];
    	$todayNum = $privilege + 1;
        $conn->query("UPDATE `counter` SET `num`=`num`+1  WHERE `day`='$today'");
    }else{		//今日第一个
    //	echo $today;
        $todayNum = 1;
    	$conn->query("INSERT INTO `counter` VALUES ('$today',1)");
    }
    $total=$conn->query("SELECT SUM(`num`) FROM `counter`");
    $total = $total->fetch_all();    
    $totalNum = $total[0][0] ;
  //  print_r($totalNum);
  //  print_r($todayNum);
    $result = array($totalNum , $todayNum);
    return $result;
}
function showEveryday(){
    global $temp;
   // print_r($temp);
   // print_r(count($temp));
    for($i = 0;$i<count($temp);$i++){
        echo $temp[$i][0].': '.$temp[$i][1].'<br/>';
    }
}
?>
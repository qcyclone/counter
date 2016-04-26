<!DOCTYPE html>
<html lang="zh-CN" >
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>历史访问量</title>
	<style type="text/css">
		#center{
			width:200px;
			height: 500px;
		//	background: red;
			margin: 0 auto;
		}
		#left{
			width:200px;
			height: 500px;
		//	background:green;
			float: left;
		}
	</style>
	<?php
		require_once "./counter.php";
	?>
  </head>
  <body>
  		<div id='left'>
  			<?php showEveryday();?>
		</div>
  		<div id='center'>
  			<?php showEveryhour();?>
		</div>
		
			
		
  </body>
</html>
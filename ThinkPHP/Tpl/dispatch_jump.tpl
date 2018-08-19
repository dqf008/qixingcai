<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01//EN" "http://www.w3.org/TR/html4/strict.dtd">
<html>
	<head>
		<meta http-equiv="Content-Type" content="text/html; charset=gbk" />
		<title>提示页面</title>
		
		<style type="text/css">
			body{ margin:0; padding:0; background:#efefef; font-family:Georgia, Times, Verdana, Geneva, Arial, Helvetica, sans-serif; }
			div#mother{ margin:0 auto; width:943px; height:572px; position:relative; }
			div#errorBox{ background: url(/Public/images/errors.jpg) no-repeat top left; width:943px; height:572px; margin:auto; }
			div#errorText{ color:#39351e; padding:40px 0 0 160px }
			div#errorText p{ width:303px; font-size:14px; line-height:26px; }
			div.link{ /*background:#f90;*/ height:50px; width:145px; float:left; }
			div#home{ margin:20px 0 0 444px;}
			div#contact{ margin:20px 0 0 25px;}
			h1{ font-size:40px; margin-bottom:35px; }
		</style>
		

		<script src="__PUBLIC__/js/jquery-1.7.2.min.js"></script>
	</head>
	<body>
		<input type="hidden" id="titles" name="titles" <?php if(isset($message)){echo 'value="'.$message.'"'; }else{ echo 'value="'.$error.'"'; }?> />

<a id="href" href="<?php echo($jumpUrl); ?>"></a>


<script type="text/javascript">
	var titles = document.getElementById('titles').value,href = document.getElementById('href').href;
	// $(".notic").html('操作成功');
 //    $(".notic").fadeIn().delay(1000).fadeOut();
    //setTimeout('window.location.href="'+href+'";',3000);
    location.href = 'http://localhost/cs2018/index.php/Index/period';
// (function(){
// var wait = document.getElementById('wait'),href = document.getElementById('href').href;
// var interval = setInterval(function(){
// 	var time = --wait.innerHTML;
// 	if(time <= 0) {
// 		location.href = href;
// 		clearInterval(interval);
// 	};
// }, 1000);
// })();
</script>
<div class="notic"></div>

<style>

.notic {

    position: fixed;

    top: 40%;

    left: 30%;

    width: 40%;

    box-sizing: border-box;

    margin: 0 auto;

    text-align: center;

    background-color: #000;

    color: #fff;

    padding: 30px;

    opacity: 0.6;

    border-radius: 10px;

    display: none;

    z-index: 999;

}

</style>
	</body>
</html>



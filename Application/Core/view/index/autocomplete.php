<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width,initial-scale=1.0,maximum-scale=1.0,user-scalable=0">
    <title>sdk test</title>
    <script src="http://libs.baidu.com/jquery/1.9.0/jquery.js"></script>
	<script type="text/javascript" src="http://files.cnblogs.com/noyobo/jquery.emailmatch.js"></script>
	<script type="text/javascript">
		$(document).ready(function(){
		  $("input").emailMatch();
		});
	</script>
</head>
<body>
	<input name="email" type="email" id="email" style="ime-mode: disabled;"/>
</body>
</html>
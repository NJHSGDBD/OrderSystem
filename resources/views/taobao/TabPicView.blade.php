<!DOCTYPE html>
<html>
<head>
	<title></title>
	<script src="public/js/jquery-3.2.1.min.js"></script>
</head>
<body>

<script type="text/javascript">
	$.ajax({
		type: 'GET',
		url: 'http://localhost/selenium-test/test1.php',
		data: '',
		success: function(res){
			console.log(res);
		},
		error: function(res){
			console.log(res)
		}
	})
</script>
</body>
</html>
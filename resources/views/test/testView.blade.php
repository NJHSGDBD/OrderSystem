<!DOCTYPE html>
<html lang="zh-CN">
<head>
	<title>testView</title>
	<link rel="stylesheet" type="text/css" href="./css/app.css">
	<script src="./js/app.js"></script>
</head>
<body>
	<div class="container">
		<div class="row">
			<!-- <div class="col-xs-4" style="background-color: yellow">2</div> -->
		</div>
		@if($res['name'] == 'zsq')
			<h1>{{$res['name']}}</h1>
		@endif
		@php
			echo "Welecome";
		@endphp
		<div class="dropdown">
			<button class="btn btn-default dropdown-toggle" type="button" id="dropdownMenu1" data-toggle="dropdown" aria-haspopup="true" aria-expanded="true">
				Dropdown
				<span class="caret"></span>
			</button>
			<ul class="dropdown-menu" aria-labelledby="dropdownMenu1">
				@for ($i = 0; $i < 5; $i++) 
		    		<li><a href="#">The number is {{ $i }}</a></li> 
				@endfor
				<li role="separator" class="divider"></li>
				<li><a href="#">Separated link</a></li>
			</ul>
		</div>
	</div>
</body>
<style type="text/css" scoped>
html,body{
	background-color: white;
}
.row{
}
</style>
</html>
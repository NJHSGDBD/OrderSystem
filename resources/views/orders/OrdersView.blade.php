<!DOCTYPE html>
<html>
<head>
	<title></title>
	<link rel="stylesheet" type="text/css" href="public/css/bootstrap-3.3.7.min.css">
	<link rel="stylesheet" type="text/css" href="public/css/bootstrap-datetimepicker.min.css">
	<link rel="stylesheet" type="text/css" href="public/css/bootstrap-table.css">
	<script src="public/js/jquery-3.2.1.min.js"></script>
	<script src="public/js/bootstrap-3.3.7.min.js"></script>
	<script src="public/js/bootstrap-datetimepicker.min.js" charset="UTF-8"></script>
	<script src="public/js/bootstrap-datetimepicker.zh-CN.js" charset="UTF-8"></script>
	<script src="public/js/bootstrap-table.js"></script>
	<script src="public/js/bootstrap-table-zh-CN.js"></script>
	<script src="public/js/bootstrap-table-export.js"></script>
	<script src="public/js/tableExport.js"></script>
	<script src="public/js/xlsx.core.min.js"></script>
	<script src="public/js/FileSaver.min.js"></script>
</head>
<body>
	<div class="jumbotron">
		<h1 class="text-center">Orders System</h1>
	</div>
	<nav class="navbar navbar-default" style="display: none">
		<div class="container-fluid">
			<div class="navbar-header col-md-4 col-xs-12 col-sm-6 col-lg-4">
				<a data-toggle="modal" data-target=".sort-modal-lg1" class="navbar-brand" href="#">类目<span class="caret"></span></a>
			</div>
			<div class="navbar-header col-md-4 col-xs-12 col-sm-6 col-lg-4">
				<a data-toggle="modal" data-target=".sort-modal-lg2" class="navbar-brand" href="#">品牌<span class="caret"></span></a>
			</div>
			<div class="navbar-header col-md-4 col-xs-12 col-sm-6 col-lg-4">
				<a data-toggle="modal" data-target=".sort-modal-lg3" class="navbar-brand" href="#">车型<span class="caret"></span></a>
			</div>
		</div>
	</nav>
	<hr style="margin-top: 0px">
	<div class="row">
		<button type="btn" class="btn btn-primary" id="search">搜索</button>
		<button type="btn" class="btn btn-default" id="update">更新数据</button>  <span id="latestupdate">最近的一次数据更新：</span>
		<div class="col-lg-3 date1">
			<div class="input-group">
				<label class="input-group-addon" for="check1">
					<input id="check1" type="checkbox" aria-lable="...">
				</label>
				<input id="date1" type="text" class="form-control" aria-lable='...' value="" autocomplete="off">
			</div>	
		</div>
		<div class="col-lg-1 icon"><h5 class="text-center">—</h5></div>
		<div class="col-lg-3 date2">
			<div class="input-group">
				<label class="input-group-addon" for="check2">
					<input id="check2" type="checkbox" aria-lable="...">
				</label>
				<input id="date2" type="text" class="form-control" aria-lable='...' autocomplete="off">
			</div>
		</div>
	</div>
	<div class="modal fade sort-modal-lg1" id="" tabindex="-1" role="dialog" aria-labelledby="mySmallModalLabel">
		<div class="modal-dialog modal-lg" role="document">
			<div class="modal-content">
				<div class="modal-header">
					<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
					<h4 class="modal-title" id="myModalLabel">选择类目</h4>
				</div>
				<div class="modal-body">
					类目列表
				</div>
				<div class="modal-footer">
					<button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
					<button type="button" class="btn btn-primary">GO</button>
				</div>
			</div>
		</div>
	</div>
	<div class="modal fade sort-modal-lg2" id="" tabindex="-1" role="dialog" aria-labelledby="mySmallModalLabel">
		<div class="modal-dialog modal-lg" role="document">
			<div class="modal-content">
				<div class="modal-header">
					<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
					<h4 class="modal-title" id="myModalLabel">选择品牌</h4>
				</div>
				<div class="modal-body">
					品牌列表
				</div>
				<div class="modal-footer">
					<button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
					<button type="button" class="btn btn-primary">GO</button>
				</div>
			</div>
		</div>
	</div>
	<div class="modal fade sort-modal-lg3" id="" tabindex="-1" role="dialog" aria-labelledby="mySmallModalLabel">
		<div class="modal-dialog modal-lg" role="document">
			<div class="modal-content">
				<div class="modal-header">
					<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
					<h4 class="modal-title" id="myModalLabel">选择车型</h4>
				</div>
				<div class="modal-body">
					车型列表
				</div>
				<div class="modal-footer">
					<button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
					<button type="button" class="btn btn-primary">GO</button>
				</div>
			</div>
		</div>
	</div>
	<div class="table-responsive">
		<!-- 响应式表格 -->
		<table class="table table-hover table-bordered" id="result_table">

		</table>
	</div>
	<script type="text/javascript">
		//格式化时间戳
		function formatDateTime(inputTime) {  
			var date = new Date(inputTime);
			var y = date.getFullYear();  
			var m = date.getMonth() + 1;  
			m = m < 10 ? ('0' + m) : m;  
			var d = date.getDate();  
			d = d < 10 ? ('0' + d) : d;  
			var h = date.getHours();
			h = h < 10 ? ('0' + h) : h;
			var minute = date.getMinutes();
			var second = date.getSeconds();
			minute = minute < 10 ? ('0' + minute) : minute;  
			second = second < 10 ? ('0' + second) : second; 
			return y + '-' + m + '-' + d +' '+h+':'+minute+':'+second
		};
		//获取最新的更新日期
		function getLatestUpdate(){
			var date = "";
			$.ajax({
				type: 'GET',
				async: false,
				url: 'orders/getLatestUpdate',
				data: '',
				dataType: 'json',
				success: function(res){
					date = res.date_purchased;
				}
			})
			return date;
		}
		function doafterSearch(res="null"){
			if(res != "null"){
				$(".search").show();
			}
			$("#search").removeAttr("disabled");
			$("#search").text("搜索")
			$("#result_table").bootstrapTable('load',res);
		}

		$(document).ready(function(){
			$(".search").hide();
			$("#latestupdate").text("最近的一次数据更新："+getLatestUpdate())
		})

		$("#search").click(function(){
			$("#search").attr("disabled","disabled");
			$("#search").text("搜索中")
			console.log($("#check1").is(':checked'))
			console.log($("#check2").is(':checked'))
			var date1 = ($("#date1").val()).substring(0,10);
			var date2 = ($("#date2").val()).substring(0,10);
			if($("#check1").is(':checked') && $("#check2").is(':checked')){
				$.ajax({
					type: 'GET',
					url: 'orders/read/'+date1+'/'+date2,
					data: '',
					dataType: 'json',
					success: function(res){
						doafterSearch(res);
					}
				})
			}else if($("#check1").is(':checked') && !$("#check2").is(':checked')){
				$.ajax({
					type: 'GET',
					url: 'orders/read/'+date1,
					data: '',
					dataType: 'json',
					success: function(res){
						doafterSearch(res);
					}
				})
			}else if(!$("#check1").is(':checked') && $("#check2").is(':checked')){
				$.ajax({
					type: 'GET',
					url: 'orders/read/'+date2,
					data: '',
					dataType: 'json',
					success: function(res){
						doafterSearch(res);
					}
				})
			}else{
				alert("选勾选要查找的时间(段)")
				doafterSearch()
			}
		})
		$("#update").click(function(){
			$("#update").attr("disabled","disabled");
			$("#update").text("更新数据中")
			var date1 = getLatestUpdate();
			var date2 = formatDateTime(Date.parse(new Date()));
			console.log(date1)
			console.log(date2)
			$.ajax({
				type: 'GET',
				url: 'orders/getValues/'+date1+'/'+date2,
				data: '',
				success:function(res){
					$("#update").removeAttr("disabled");
					$("#update").text("已更新数据")
					if(res == 'success'){
						alert('已更新');
						$("#latestupdate").text("最近的一次数据更新："+getLatestUpdate())
					}else{
						alert('没有该日期的数据')
					}
				}
			})
		})
		//日期选择表
		$("#date1").datetimepicker({
			language: "zh-CN",
			autoclose: true,
			todayBtn: "linked",
			todayHighlight: true,
			minView: "2"
		});
		$("#date2").datetimepicker({
			language: "zh-CN",
			autoclose: true,
			todayBtn: "linked",
			todayHighlight: true,
			minView: "2"
		});
		//bootstrap表格
		$("#result_table").bootstrapTable({
			method: 'get',
			url: '',
			queryParams: "",
			sidePagination: "client",
			striped: false,
			search: true,
			searchOnEnterKey: true,
			uniqueId: "orders_id",
			pageNumber: 1,
			pageSize: 15,
			pageList:[15,30,50,100],
			pagination: true,
			sortable: true,
			sortOrder: 'asc',
			showRefresh: false,
			showColumns: true,
			buttonsAlign: 'center',
			clickToSelect: true,
			// detailView : true,
			columns:[
			{
				field: 'orders_id',
				title: '订单ID',
				sortable: true
			},{
				field: 'date_purchased',
				title: '购买日期',
				sortable: true
			},{
				field: 'customers_id',
				title: '客户ID',
				sortable: true,
				visible: false
			},{
				field: 'customers_name',
				title: '顾客姓名',
			},{
				field: 'customers_email_address',
				title: '顾客邮箱',
			},{
				field: 'customers_state',
				title: '顾客所在省份',
			},{
				field: 'customers_country',
				title: '顾客所在国家',
			},{
				field: 'delivery_state',
				title: '送货省',
			},{
				field: 'delivery_country',
				title: '送货国',
			},{
				field: 'orders_status',
				title: '订单状态'
			},{
				field: 'kind',
				title: '销售种类'
			},{
				field: 'manufactruers',
				title: '厂商名称'
			},{
				field:'products_id',
				title: '产品ID'
			},{
				field:'category_id',
				title: '产品类目ID'
			},{
				field: 'products_model',
				title: '产品型号'
			},{
				field: 'products_name',
				title: '产品名'
			},{
				field: 'products_price',
				title: '产品单价'
			},{
				field: 'products_quantity',
				title: '产品数量'
			},{
				field: 'orders_subtotal',
				title: '订单小计'
			},{
				field: 'shipping_method',
				title: '物流数据'
			},{
				field: 'a',
				title: '顾客所在国家/地区（注册时）'
			},{
				field: 'b',
				title: '账户注册日期'
			}],
			onLoadSuccess: function(){  //加载成功时执行
				console.info("加载成功");
			},
		    onLoadError: function(){  //加载失败时执行
		    	console.info("加载数据失败");
		    },
		    onExpandRow: function (index, row, $detail) {
		    	// ProductsTable(index,row,$detail)
		    	console.log(index)
		    	console.log(row)
		    	console.log($detail)
		    },
		    onClickRow: function(index,row,$detail){
		    	console.log(index)
		    	console.log(row)
		    	console.log($detail)
		    },
		    showExport : true,
		    exportDataType : 'all',
		    exportTypes:['json','txt','sql','excel','xlsx','csv'],
		    exportOptions : {
		    	fileName : '订单数据导出',
		    	worksheetName : 'Sheet1',
		    	tableName: '订单数据表'
		    },
		});
		function ProductsTable(index,row,$detail){
			var cur_table = $detail.html('<table></table>').find('table');
			$(cur_table).bootstrapTable({
				url: '/orders/readProducts',
				method: 'get',
				uniqueId: 'orders_products_id',
				columns: [
				{
					field:'products_id',
					title: '产品ID'
				},{
					field: 'products_model',
					title: '产品型号'
				},{
					field: 'products_name',
					title: '产品名'
				}]
			});
		}
	</script>
	<style type="text/css">
		.row{
			background-color: skyblue
		}
		.jumbotron{
			margin:0;
		}
		.navbar-brand{
			width: 100%;
			text-align: center;
		}
		.navbar-default{
			background-color: white;
			border-color: black;
		}
		.modal-backdrop{
			background-color: transparent;
		}
		.datetimepicker-inline,.table-condensed{
			width: 100%
		}
		.row{
			background-color: white;
			margin: 0px;
		}
		.date1{
			padding-right: 0px
		}
		.icon{
			padding:0px;
			width: 30px
		}
		.date2{
			padding-left: 0px
		}
	</style>
</body>
</html>
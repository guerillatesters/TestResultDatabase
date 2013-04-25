<html>
<head>
<style type="text/css" title="currentStyle">
			
			@import "./DataTables-1.9.4/media/css/demo_table.css";
			@import "./chosen/chosen.css";
		</style>

<script type="text/javascript" src="./DataTables-1.9.4/media/js/jquery.js"></script>
<script src="./js/jquery-ui-1.10.2.custom.min.js"></script>
<script type="text/javascript" src="./DataTables-1.9.4/media/js/jquery.dataTables.min.js"></script>
<script type="text/javascript" src="./TableTools-2.1.4/media/js/TableTools.min.js"></script>
<script type="text/javascript" src="./ColVis-1.0.8/media/js/ColVis.min.js"></script>
<script type="text/javascript" src="./js/reloadajax.js"></script>
<script type="text/javascript" src="./js/helpers.js"></script>
<script type="text/javascript" src="./js/menu.js"></script>
<script type="text/javascript" src="./js/menu_trend.js"></script>
<script type="text/javascript" src="./js/table.js"></script>
<script type="text/javascript" src="./js/tableselect.js"></script>
<script src="./chosen/chosen.jquery.js" type="text/javascript"></script>
<!--
<link href="./css/hot-sneaks/jquery-ui-1.9.2.custom.min.css" rel="stylesheet">
<link href="./css/ui-darkness/jquery-ui-1.9.2.custom.min.css" rel="stylesheet">
<link href="./css/mycss.css" rel="stylesheet">
-->

<link href="./css/sunny/jquery-ui-1.10.2.custom.min.css" rel="stylesheet">

<script>  
$(function() {    
	 $( "#tabs" ).tabs({ active: 0 });  
	 });  
</script>
</head>

<body>

	<div class="ui-widget">
		<div class="ui-widget-header ui-corner-top">
			<h1>Test results</h1>
		</div>

		<div id="tabs">
			<ul>
				<li><a href="#tabs-1">Results</a></li>
				<li><a href="#tabs-2">Trending</a></li>
			</ul>
			<div id="tabs-1" class="ui-widget-content ui-corner-bottom">
				<div id="menu"></div>
				<p>&nbsp;</p>
				<table cellpadding="0" cellspacing="0" border="0" class="display" id="example">
					<thead>
						<tr id="headers"></tr>
					</thead>
					<tbody>
					</tbody>
				</table>
				<div id="choice"></div>				
			 </div>
			
			<div id="tabs-2">
			<div id="menu2"></div>
				<p>&nbsp;</p>
				<table cellpadding="0" cellspacing="0" border="0" class="display" id="example2">
					<thead>
						<tr id="headers2"></tr>
					</thead>
					<tbody>
					</tbody>
				</table>			
				<div id="choice2"></div>	
			 </div>
			</div>
		</div>
	

</body>
</html>
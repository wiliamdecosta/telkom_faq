<html>
	<head>
	<title>Load Ext JS</title>
	<?php $this->load->view('template/jspageheader.php'); ?>
	<?php $this->load->view('template/jspanelheader.php'); ?>
	<?php $this->load->view('template/jsloader.php'); ?>
	<script>
		Ext.onReady(function(){
			Ext.Ajax.disableCaching = false;

			var module_agama = new Humas.module.agama({renderTo:'user-agama', width:600, height:400});
			module_agama.grid.store.load();
		});
	</script>
	</head>
<body style="margin-left:20px;margin-top:20px;">
<a href="<?php echo BASE_URL."userlogin/logout"; ?>"> Keluar </a>
<div id="user-agama" />
</div>
</body>
</html>
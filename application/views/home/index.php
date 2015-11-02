<!DOCTYPE html>
<html>
	<head>
		<title>Telkom - FAQ & Requirement</title>

		<!-- Load CSS Here -->
		<?php $this->load->view('template/default/csspageheader.php'); ?>
	</head>

<body>
    
    <div id="loading-mask" style=""></div>
    <div id="loading">
        <div class="loading-indicator">
            <img src="<?php echo IMAGE_APP_PATH."extanim32.gif"; ?>" width="32" height="32" style="margin-right:8px;" align="absmiddle"/>Loading...
        </div>
    </div>
    
    <!-- Load JS Script After Loading Indicator -->
    <?php $this->load->view('template/default/jspageheader.php'); ?>
    <?php $this->load->view('template/default/jspanelheader.php'); ?>
	
	<!-- Load App Script here -->
	<script type="text/javascript" src="<?php echo JS_APP_PATH; ?>/script/jsloader.php"></script>
	
	<!-- Load All Base Script here -->
	<script type="text/javascript" src="<?php echo JS_APP_PATH; ?>/base/base-jsloader.php"></script>
	
	<!-- Load Tree Panel -->
	<?php $this->load->view('home/tree_panel.php'); ?>
	<div id="header"> <h2 style="color:#FFFFFF">FAQ & Requirements</h2> </div>

</body>
</html>
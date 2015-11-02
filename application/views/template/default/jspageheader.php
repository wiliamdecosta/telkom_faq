<?php
    $ci = & get_instance();
    $user_realname = $ci->session->userdata('user_realname');
?>

<script type="text/javascript" src="<?php echo JS_APP_PATH;?>/extjs/ext3/ext-base.js"></script>
<script type="text/javascript" src="<?php echo JS_APP_PATH;?>/extjs/ext3/ext-all.js"></script>

<script type="text/javascript">
    Ext.BLANK_IMAGE_URL = '<?php echo CSS_APP_PATH;?>/ext3/images/default/s.gif';
    WS_URL = "<?php echo WS_URL; ?>";
    BASE_URL = "<?php echo BASE_URL; ?>";
    COM_URL = "<?php echo COM_URL; ?>";
    _RNAME = "<?php echo $user_realname; ?>";
</script>

<script type="text/javascript" src="<?php echo JS_APP_PATH; ?>/extjs/ext-init.js"></script>

<script type="text/javascript" src="<?php echo JS_APP_PATH; ?>/extjs/ext3/TabCloseMenu.js"></script>
<script type="text/javascript" src="<?php echo JS_APP_PATH; ?>/extjs/ext3/StatusBar.js"></script>
<script type="text/javascript" src="<?php echo JS_APP_PATH; ?>/extjs/ext3/FileUploadField.js"></script>
<script type="text/javascript" src="<?php echo JS_APP_PATH; ?>/extjs/ext3/RowExpander.js"></script>
<script type="text/javascript" src="<?php echo JS_APP_PATH; ?>/extjs/ext3/IFrameComponent.js"></script>
<script type="text/javascript" src="<?php echo JS_APP_PATH; ?>/extjs/ext3/LockingGridView.js"></script>
<script type="text/javascript" src="<?php echo JS_APP_PATH; ?>/extjs/ext3/GroupHeaderPlugin.js"></script>
<script type="text/javascript" src="<?php echo JS_APP_PATH; ?>/extjs/ext3/uxvismode.js"></script>
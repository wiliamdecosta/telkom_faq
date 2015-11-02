
					</div><!-- /.page-content -->
				</div>
			</div><!-- /.main-content -->

			<div class="footer">
				<div class="footer-inner">
					<!-- #section:basics/footer -->
					<div class="footer-content">
						<span class="bigger-120">
							<span class="blue bolder">Core</span>
							CI Project &copy; 2015
						</span>

					</div>

					<!-- /section:basics/footer -->
				</div>
			</div>

			<a href="#" id="btn-scroll-up" class="btn-scroll-up btn btn-sm btn-inverse">
				<i class="ace-icon fa fa-angle-double-up icon-only bigger-110"></i>
			</a>
		</div><!-- /.main-container -->



		<!-- ace scripts -->
		<script src="<?php echo BS_JS_PATH; ?>ace/elements.scroller.js"></script>
		<script src="<?php echo BS_JS_PATH; ?>ace/elements.colorpicker.js"></script>
		<script src="<?php echo BS_JS_PATH; ?>ace/elements.fileinput.js"></script>
		<script src="<?php echo BS_JS_PATH; ?>ace/elements.typeahead.js"></script>
		<script src="<?php echo BS_JS_PATH; ?>ace/elements.wysiwyg.js"></script>
		<script src="<?php echo BS_JS_PATH; ?>ace/elements.spinner.js"></script>
		<script src="<?php echo BS_JS_PATH; ?>ace/elements.treeview.js"></script>
		<script src="<?php echo BS_JS_PATH; ?>ace/elements.wizard.js"></script>
		<script src="<?php echo BS_JS_PATH; ?>ace/elements.aside.js"></script>
		<script src="<?php echo BS_JS_PATH; ?>ace/ace.js"></script>
		<script src="<?php echo BS_JS_PATH; ?>ace/ace.touch-drag.js"></script>
		<script src="<?php echo BS_JS_PATH; ?>ace/ace.sidebar.js"></script>
		<script src="<?php echo BS_JS_PATH; ?>ace/ace.sidebar-scroll-1.js"></script>
		<script src="<?php echo BS_JS_PATH; ?>ace/ace.submenu-hover.js"></script>
		<script src="<?php echo BS_JS_PATH; ?>ace/ace.widget-box.js"></script>
		<script src="<?php echo BS_JS_PATH; ?>ace/ace.settings.js"></script>
		<script src="<?php echo BS_JS_PATH; ?>ace/ace.settings-rtl.js"></script>
		<script src="<?php echo BS_JS_PATH; ?>ace/ace.settings-skin.js"></script>
		<script src="<?php echo BS_JS_PATH; ?>ace/ace.widget-on-reload.js"></script>
		<script src="<?php echo BS_JS_PATH; ?>ace/ace.searchbox-autocomplete.js"></script>

		<script type="text/javascript">
            
			jQuery(function($) {
			    setInitialTheme();
			    setTimeout( function(){
			        $("body").show();
			        loadContent('dashboard');
			    }, 500);
			    
			    $("#btn-logout").on(ace.click_event, function() {
					BootstrapDialog.confirm({
					    title:'Konfirmasi Logout',
					    message: 'Apakah Anda yakin untuk logout ?',
					    btnCancelLabel: 'Tidak',
                        btnOKLabel: 'Ya, Logout',
					    callback: function(result) {
    					    if(result) {
    					        $(location).attr('href','<?php echo BASE_URL."base/logout";?>');
    					    }
					    }
					});
				});

				$("#btn-user-profile").on(ace.click_event, function() {
				    $(".nav-menu-content").removeClass("active");
					loadContent('user-profile');
				});

				$(".nav-menu-content").on(ace.click_event,function(){
				    $(".nav-menu-content").removeClass("active");
				    $("#"+$(this).attr('id')).addClass("active");
				    var menu_id = $(this).attr('id');
				    loadContent(menu_id);
				});

			});

			function loadContent(id) {
                $("#main-content").html('<div align="center"><h3 class="smaller lighter grey"> <i class="ace-icon fa fa-spinner fa-spin orange bigger-300"></i> <br/> Loading . . . </h3></div>');
			    setTimeout( function(){
            	    $.post( "<?php echo BASE_URL.'panel/load_content/'; ?>" + id, function( data ) {
                        $( "#main-content" ).html( data );
                    });
       		    }, 500 );
			}
			
			/* called by ace.settings-skin.js */
			function updateVarTheme(skin_class) {
			    $.post( "<?php echo WS_URL.'base.variables_controller/set_theme'; ?>", 
        		    { var_name: 'panel-theme', var_value: skin_class },                
        		    function( response ) {
        		        if(response.success == false) showBootDialog(false, BootstrapDialog.TYPE_DEFAULT, 'Perhatian', response.message);
        		    }
    		    );
		    }
		    
		    function setInitialTheme() {
		        $.post( "<?php echo WS_URL.'base.variables_controller/get_theme'; ?>", 
		            { var_name: 'panel-theme' },
        		    function( response ) {
        		        if(response.success == false) {
    	                    showBootDialog(false, BootstrapDialog.TYPE_DEFAULT, 'Perhatian', response.message);
    	                }else {
            		        setThemeSkin( response.items );
            		        $("#skin-colorpicker option[data-skin='"+ response.items +"']").attr("selected","selected");
            		        $(".colorpick-btn").removeClass("selected");
                            $(".btn-colorpicker").css("background-color", $("#skin-colorpicker").val());
                            //$(".colorpick-btn[data-color='"+ $("#skin-colorpicker").val() +"']").addClass("selected");
                        }
        		    }
    		    );
		    }
		    
        </script>


	</body>
</html>
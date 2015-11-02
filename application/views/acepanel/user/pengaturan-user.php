<!-- Bootgrid Dialog -->
<link rel="stylesheet" href="<?php echo BS_PATH; ?>bootgrid/jquery.bootgrid.css" />
<link rel="stylesheet" href="<?php echo BS_PATH; ?>bootgrid/modification.css" />
<script src="<?php echo BS_PATH; ?>bootgrid/jquery.bootgrid.min.js"></script>
<script src="<?php echo BS_PATH; ?>bootgrid/properties.js"></script>

<div class="page-header">
	<h1>
		Users &amp; Groups
		<small>
			<i class="ace-icon fa fa-angle-double-right"></i>
			Pengaturan User
		</small>
	</h1>
</div><!-- /.page-header -->

<div class="row" id="row-content" style="display:none;">
	<div class="col-xs-12">
		<!-- PAGE CONTENT BEGINS -->
		<div class="row">
		    <div class="col-xs-12">
		        <div class="well well-sm">
		            <div class="inline middle blue bigger-150"> Daftar User </div>
		        </div>
		        <p>
					<button class="btn btn-white btn-success btn-round" id="btn-add">
						<i class="ace-icon glyphicon glyphicon-plus bigger-120 green"></i>
					    Tambah
					</button>

					<button class="btn btn-white btn-danger btn-round" id="btn-delete">
						<i class="ace-icon glyphicon glyphicon-trash bigger-120 red"></i>
						Hapus
					</button>
				</p>

		        <table id="grid-selection" class="table table-striped table-bordered table-hover">
                <thead>
                  <tr>
                    <th data-identifier="true" data-visible = "false" data-type="string" data-header-align="center" data-align="center" data-column-id="user_id"> User ID </th>
                     <th data-header-align="center" data-align="center" data-formatter="opt-edit" width="80">Pilihan</th>
                     <th data-column-id="user_name" data-header-align="center" data-align="center">Username</th>
                     <th data-column-id="user_email"> Email </th>
                     <th data-column-id="user_realname"> Nama Lengkap </th>
                     <th data-column-id="user_status" data-header-align="center" data-align="center" data-formatter="user_status">Status</th>
                  </tr>
                </thead>
              </table>
		    </div>
	    </div>
        <!-- PAGE CONTENT ENDS -->
	</div><!-- /.col -->
</div><!-- /.row -->

<?php include_once("add-edit-user.php"); ?>

<script>
    jQuery(function($) {
        createTable();

        /* show content */
        $("#grid-selection").bootgrid().on("loaded.rs.jquery.bootgrid", function (e){
           $("#row-content").slideDown("slow", function(){});
        });

        $("#btn-add").on(ace.click_event, function() {
            showFormAdd();
        });

        $("#btn-delete").on(ace.click_event, function(){
            if($("#grid-selection").bootgrid("getSelectedRows") == "") {
                showBootDialog(true, BootstrapDialog.TYPE_INFO, 'Info', 'Silahkan pilih data yang akan dihapus');
            }else {
                deleteRecords( $("#grid-selection").bootgrid("getSelectedRows") );
            }
        });

    });

    function createTable() {
        $("#grid-selection").bootgrid({
    	     formatters: {
                "user_status" : function (col, row) {
                    return  ( row.user_status == "a" ) ? "Aktif" : "Tidak Aktif";
                },
                "opt-edit" : function(col, row) {
                    return '<div class="hidden-sm hidden-xs action-buttons"><a href="#" onclick="showFormEdit(\''+ row.user_id +'\')" class="green"><i class="ace-icon fa fa-pencil bigger-130"></i></a> <a href="#" onclick="deleteRecords(\''+ row.user_id +'\')" class="red"><i class="ace-icon glyphicon glyphicon-trash bigger-130"></i></a> </div>';
                }
             },
    	     rowCount:[10,25,50,100,-1],
    		 ajax: true,
    	     post: function () {
    	         /* To accumulate custom parameter with the request object */
    	         return { bootgrid_request : "Y" };
    	     },
    	     requestHandler:function(request) {
    	        if(request.sort) {
    	            var sortby = Object.keys(request.sort)[0];
    	            request.dir = request.sort[sortby];

    	            delete request.sort;
    	            request.sort = sortby;
    	        }
    	        return request;
    	     },
    	     responseHandler:function (response) {
    	        if(response.success == false) {
    	            showBootDialog(true, BootstrapDialog.TYPE_DANGER, 'Perhatian', response.message);
    	        }
    	        return response;
    	     },
       	     url: '<?php echo WS_URL2."base.user_controller/read"; ?>',
    	     selection: true,
    	     multiSelect: true,
    	     sorting:true,
    	     labels: {
    	        all         : properties.bootgridinfo.all,
    	        noResults   : properties.bootgridinfo.noresults,
    	        infos       : properties.bootgridinfo.datainfo,
    	        search      : properties.bootgridinfo.search,
    	        loading     : properties.bootgridinfo.loading
	         }
    	});
    }

    function reloadTable() {
        $("#grid-selection").bootgrid("reload");
    }

    function deleteRecords(theID) {
        BootstrapDialog.confirm({
            type: BootstrapDialog.TYPE_WARNING,
		    title:'Konfirmasi Hapus',
		    message: 'Apakah Anda yakin untuk menghapus data tersebut ?',
		    btnCancelLabel: 'Tidak',
            btnOKLabel: 'Ya',
		    callback: function(result) {
    	        if(result) {
    	            $.post( "<?php echo WS_URL.'base.user_controller/destroy'; ?>",
            		    { items: JSON.stringify(theID) },
                        function( response ) {
                            if(response.success == false) {
                	            showBootDialog(true, BootstrapDialog.TYPE_DANGER, 'Perhatian', response.message);
                	        }else {
                    	        loadContent('user.pengaturan-user');
                                showBootDialog(true, BootstrapDialog.TYPE_SUCCESS, 'Info', response.message);
                            }
                        }
                	);
    	        }
		    }
		});

    }

</script>
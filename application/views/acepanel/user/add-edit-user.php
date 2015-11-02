<div id="modal-add-edit-user" class="modal fade" tabindex="-1">
	<div class="modal-dialog">
		<div class="modal-content">
		    <!-- modal title -->
			<div class="modal-header no-padding">
				<div class="table-header">
					<span class="form-add-edit-title"> Tambah/Edit User </span>
				</div>
			</div>

			<!-- modal body -->
			<div class="modal-body">
				test
			</div>

			<!-- modal footer -->
			<div class="modal-footer no-margin-top">
			    <div class="bootstrap-dialog-footer">
			        <div class="bootstrap-dialog-footer-buttons">
        			    <button class="btn btn-primary btn-xs radius-4">
        					<i class="ace-icon fa fa-floppy-o"></i>
        					Simpan
        				</button>
        				<button class="btn btn-danger btn-xs radius-4" data-dismiss="modal">
        					<i class="ace-icon fa fa-times"></i>
        					Tutup
        				</button>
    				</div>
				</div>
			</div>
		</div><!-- /.modal-content -->
	</div><!-- /.modal-dialog -->
</div><!-- /.end modal -->

<script>
    function showFormAdd() {
        $(".form-add-edit-title").html("Tambah User");
        $("#modal-add-edit-user").modal({backdrop: 'static'});
    }

    function showFormEdit(theID) {
        $(".form-add-edit-title").html("Edit User");
        $("#modal-add-edit-user").modal({backdrop: 'static'});
    }
</script>
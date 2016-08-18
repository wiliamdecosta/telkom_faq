/**
 * @class Tracking.grid.report_maintenance_detail
 * Grid for table track_maintenance_detail
 *
 * @author agung.hp
 * @since 29-10-2015 10:12:52
 */
Tracking.grid.report_maintenance_detail = Ext.extend(Webi.grid.GridPanel, {
    viewConfig:{forceFit:false},
    enableAdd:false,
    enableEdit:false,
    enableDelete:false,
    initComponent : function() {
        this.store = new Tracking.store.maintenance_detail();
        var cbStatusRequirement = new Tracking.combo.StatusRequirement();
        this.columns = [
            {header: Tracking.properties.mnt_det_id, hidden: true, sortable: true, dataIndex: 'mnt_det_id'},
			{header: Tracking.properties.mnt_id, hidden: true, sortable: true, dataIndex: 'mnt_id', width: 65, renderer: Webi.format.intRenderer},
			{header: Tracking.properties.mnt_det_pic, hidden: false, sortable: true, dataIndex: 'mnt_det_pic', width: 208},
			{header: 'Deskripsi', hidden: false, sortable: true, dataIndex: 'mnt_det_desc', width: 240},
			{header: Tracking.properties.mnt_det_start_date, hidden: false, sortable: true, dataIndex: 'mnt_det_start_date', width: 120, renderer: Webi.format.dateRenderer},
			{header: Tracking.properties.mnt_det_due_date, hidden: false, sortable: true, dataIndex: 'mnt_det_due_date', width: 120, renderer: Webi.format.dateRenderer},
			{header: Tracking.properties.mnt_det_status, hidden: false, sortable: true, dataIndex: 'mnt_det_status', width: 160, renderer: Webi.format.comboRenderer(cbStatusRequirement)},
			{header: Tracking.properties.mnt_det_created_date, hidden: false, sortable: true, dataIndex: 'mnt_det_created_date', width: 120, renderer: Webi.format.dateRenderer},
			{header: Tracking.properties.mnt_det_created_by, hidden: false, sortable: true, dataIndex: 'mnt_det_created_by', width: 120},
			{header: Tracking.properties.mnt_det_updated_date, hidden: false, sortable: true, dataIndex: 'mnt_det_updated_date', width: 120, renderer: Webi.format.dateRenderer},
			{header: Tracking.properties.mnt_det_updated_by, hidden: false, sortable: true, dataIndex: 'mnt_det_updated_by', width: 120}
        ];

        // super
        Tracking.grid.report_maintenance_detail.superclass.initComponent.call(this);
    },
    getDefaultData: function(){
        var defaultData = {
			'mnt_det_id': '',
			'mnt_id': this.store.baseParams.mnt_id || '',
			'mnt_det_pic': '',
			'mnt_det_desc': '',
			'mnt_det_start_date': '',
			'mnt_det_due_date': '',
			'mnt_det_status': '',
			'mnt_det_created_date': '',
			'mnt_det_created_by': '',
			'mnt_det_updated_date': '',
			'mnt_det_updated_by': ''
        };
        return defaultData;
    }
});
Ext.reg('grid_report_maintenance_detail', Tracking.grid.report_maintenance_detail);
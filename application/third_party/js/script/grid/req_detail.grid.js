/**
 * @class Tracking.grid.req_detail
 * Grid for table track_req_detail
 *
 * @author agung.hp
 * @since 29-10-2015 10:12:52
 */
Tracking.grid.req_detail = Ext.extend(Webi.grid.GridPanel, {
    viewConfig:{forceFit:false},
    initComponent : function() {
        this.store = new Tracking.store.req_detail();
        var cbStatusRequirement = new Tracking.combo.StatusRequirement();
        this.columns = [
            {header: Tracking.properties.req_det_id, hidden: true, sortable: true, dataIndex: 'req_det_id'},
			{header: Tracking.properties.req_id, hidden: true, sortable: true, dataIndex: 'req_id', width: 65, renderer: Webi.format.intRenderer},
			{header: Tracking.properties.req_det_pic, hidden: false, sortable: true, dataIndex: 'req_det_pic', width: 208},
			{header: 'Deskripsi', hidden: false, sortable: true, dataIndex: 'req_det_desc', width: 240},
			{header: Tracking.properties.req_det_start_date, hidden: false, sortable: true, dataIndex: 'req_det_start_date', width: 120, renderer: Webi.format.dateRenderer},
			{header: Tracking.properties.req_det_due_date, hidden: false, sortable: true, dataIndex: 'req_det_due_date', width: 120, renderer: Webi.format.dateRenderer},
			{header: Tracking.properties.req_det_status, hidden: false, sortable: true, dataIndex: 'req_det_status', width: 160, renderer: Webi.format.comboRenderer(cbStatusRequirement)},
			{header: Tracking.properties.req_det_created_date, hidden: false, sortable: true, dataIndex: 'req_det_created_date', width: 120, renderer: Webi.format.dateRenderer},
			{header: Tracking.properties.req_det_created_by, hidden: false, sortable: true, dataIndex: 'req_det_created_by', width: 120},
			{header: Tracking.properties.req_det_updated_date, hidden: false, sortable: true, dataIndex: 'req_det_updated_date', width: 120, renderer: Webi.format.dateRenderer},
			{header: Tracking.properties.req_det_updated_by, hidden: false, sortable: true, dataIndex: 'req_det_updated_by', width: 120}
        ];

        // super
        Tracking.grid.req_detail.superclass.initComponent.call(this);
    },
    getDefaultData: function(){
        var defaultData = {
			'req_det_id': '',
			'req_id': this.store.baseParams.req_id || '',
			'req_det_pic': '',
			'req_det_start_date': '',
			'req_det_due_date': '',
			'req_det_status': '',
			'req_det_created_date': '',
			'req_det_created_by': '',
			'req_det_updated_date': '',
			'req_det_updated_by': ''
        };
        return defaultData;
    }
});
Ext.reg('grid_req_detail', Tracking.grid.req_detail);
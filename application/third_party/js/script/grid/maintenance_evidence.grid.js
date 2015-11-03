/**
 * @class Tracking.grid.maintenance_evidence
 * Grid for table track_maintenance_evidence
 *
 * @author agung.hp
 * @since 29-10-2015 10:12:52
 */
Tracking.grid.maintenance_evidence = Ext.extend(Webi.grid.GridPanel, {
    viewConfig:{forceFit:false},
    initComponent : function() {
        this.store = new Tracking.store.maintenance_evidence();
        
        this.columns = [
            {header: Tracking.properties.mnt_evd_id, hidden: true, sortable: true, dataIndex: 'mnt_evd_id'},
			{header: Tracking.properties.mnt_id, hidden: true, sortable: true, dataIndex: 'mnt_id', width: 65, renderer: Webi.format.intRenderer},
			{header: Tracking.properties.mnt_evd_file, hidden: false, sortable: true, dataIndex: 'mnt_evd_file', width:268, renderer:function(value, meta, record){
			    return '<a href="'+ COM_URL +'application/third_party/upload/maintenance_evidence_attachments/'+ value +'" target="_blank">' + value + '</a>';
			}},
			{header: Tracking.properties.mnt_evd_desc, hidden: false, sortable: true, dataIndex: 'mnt_evd_desc', width:248},
			{header: Tracking.properties.mnt_evd_created_date, hidden: false, sortable: true, dataIndex: 'mnt_evd_created_date', width: 120, renderer: Webi.format.dateRenderer},
			{header: Tracking.properties.mnt_evd_created_by, hidden: false, sortable: true, dataIndex: 'mnt_evd_created_by', width: 120},
			{header: Tracking.properties.mnt_evd_updated_date, hidden: false, sortable: true, dataIndex: 'mnt_evd_updated_date', width: 120, renderer: Webi.format.dateRenderer},
			{header: Tracking.properties.mnt_evd_updated_by, hidden: false, sortable: true, dataIndex: 'mnt_evd_updated_by', width: 120}
        ];

        // super
        Tracking.grid.maintenance_evidence.superclass.initComponent.call(this);
    },
    getDefaultData: function(){
        var defaultData = {
			'mnt_evd_id': '',
			'mnt_id': this.store.baseParams.mnt_id || '',
			'mnt_evd_file': '',
			'mnt_evd_desc': '',
			'mnt_evd_created_date': '',
			'mnt_evd_created_by': '',
			'mnt_evd_updated_date': '',
			'mnt_evd_updated_by': ''
        };
        return defaultData;
    }
});
Ext.reg('grid_maintenance_evidence', Tracking.grid.maintenance_evidence);
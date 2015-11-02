/**
 * @class Tracking.grid.evidence
 * Grid for table track_evidence
 *
 * @author agung.hp
 * @since 29-10-2015 10:12:52
 */
Tracking.grid.evidence = Ext.extend(Webi.grid.GridPanel, {
    viewConfig:{forceFit:false},
    initComponent : function() {
        this.store = new Tracking.store.evidence();
        
        this.columns = [
            {header: Tracking.properties.evd_id, hidden: true, sortable: true, dataIndex: 'evd_id'},
			{header: Tracking.properties.req_id, hidden: true, sortable: true, dataIndex: 'req_id', width: 65, renderer: Webi.format.intRenderer},
			{header: Tracking.properties.evd_file, hidden: false, sortable: true, dataIndex: 'evd_file', width:268, renderer:function(value, meta, record){
			    return '<a href="'+ COM_URL +'application/third_party/upload/evidence_attachments/'+ value +'" target="_blank">' + value + '</a>';
			}},
			{header: Tracking.properties.evd_desc, hidden: false, sortable: true, dataIndex: 'evd_desc', width:248},
			{header: Tracking.properties.evd_created_date, hidden: false, sortable: true, dataIndex: 'evd_created_date', width: 120, renderer: Webi.format.dateRenderer},
			{header: Tracking.properties.evd_created_by, hidden: false, sortable: true, dataIndex: 'evd_created_by', width: 120},
			{header: Tracking.properties.evd_updated_date, hidden: false, sortable: true, dataIndex: 'evd_updated_date', width: 120, renderer: Webi.format.dateRenderer},
			{header: Tracking.properties.evd_updated_by, hidden: false, sortable: true, dataIndex: 'evd_updated_by', width: 120}
        ];

        // super
        Tracking.grid.evidence.superclass.initComponent.call(this);
    },
    getDefaultData: function(){
        var defaultData = {
			'evd_id': '',
			'req_id': this.store.baseParams.req_id || '',
			'evd_file': '',
			'evd_desc': '',
			'evd_created_date': '',
			'evd_created_by': '',
			'evd_updated_date': '',
			'evd_updated_by': ''
        };
        return defaultData;
    }
});
Ext.reg('grid_evidence', Tracking.grid.evidence);
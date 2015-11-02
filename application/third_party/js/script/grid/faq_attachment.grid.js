/**
 * @class Tracking.grid.faq_attachment
 * Grid for table track_faq_attachment
 *
 * @author agung.hp
 * @since 29-10-2015 10:12:52
 */
Tracking.grid.faq_attachment = Ext.extend(Webi.grid.GridPanel, {
    viewConfig:{forceFit:false},
    initComponent : function() {
        this.store = new Tracking.store.faq_attachment();
        
        this.columns = [
            {header: Tracking.properties.faq_attach_id, hidden: true, sortable: true, dataIndex: 'faq_attach_id'},
			{header: Tracking.properties.faq_id, hidden: true, sortable: true, dataIndex: 'faq_id', width: 65, renderer: Webi.format.intRenderer},
			{header: Tracking.properties.faq_attach_file, hidden: false, sortable: true, dataIndex: 'faq_attach_file', width:244, renderer:function(value, meta, record){
			    return '<a href="'+ COM_URL +'application/third_party/upload/faq_attachments/'+ value +'" target="_blank">' + value + '</a>';
			}},
			{header: Tracking.properties.faq_attach_desc, hidden: false, sortable: true, dataIndex: 'faq_attach_desc', width:244},
			{header: Tracking.properties.faq_attach_created_date, hidden: false, sortable: true, dataIndex: 'faq_attach_created_date', width: 120, renderer: Webi.format.dateRenderer},
			{header: Tracking.properties.faq_attach_created_by, hidden: false, sortable: true, dataIndex: 'faq_attach_created_by', width: 120},
			{header: Tracking.properties.faq_attach_updated_date, hidden: false, sortable: true, dataIndex: 'faq_attach_updated_date', width: 120, renderer: Webi.format.dateRenderer},
			{header: Tracking.properties.faq_attach_updated_by, hidden: false, sortable: true, dataIndex: 'faq_attach_updated_by', width: 120}
        ];

        // super
        Tracking.grid.faq_attachment.superclass.initComponent.call(this);
    },
    getDefaultData: function(){
        var defaultData = {
			'faq_attach_id': '',
			'faq_id': this.store.baseParams.faq_id || '',
			'faq_attach_file': '',
			'faq_attach_desc': '',
			'faq_attach_created_date': '',
			'faq_attach_created_by': '',
			'faq_attach_updated_date': '',
			'faq_attach_updated_by': ''
        };
        return defaultData;
    }
});
Ext.reg('grid_faq_attachment', Tracking.grid.faq_attachment);
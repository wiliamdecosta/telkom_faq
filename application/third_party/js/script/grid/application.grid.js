/**
 * @class Tracking.grid.application
 * Grid for table track_application
 *
 * @author agung.hp
 * @since 29-10-2015 10:12:52
 */
Tracking.grid.application = Ext.extend(Webi.grid.GridPanel, {
    viewConfig:{forceFit:false},
    initComponent : function() {
        this.store = new Tracking.store.application();
        
        this.columns = [
            {header: Tracking.properties.app_id, hidden: true, sortable: true, dataIndex: 'app_id'},
			{header: Tracking.properties.app_name, hidden: false, sortable: true, dataIndex: 'app_name', width:327},
			{header: Tracking.properties.app_created_date, hidden: false, sortable: true, dataIndex: 'app_created_date', width: 120, renderer: Webi.format.dateRenderer},
			{header: Tracking.properties.app_created_by, hidden: false, sortable: true, dataIndex: 'app_created_by', width: 120},
			{header: Tracking.properties.app_updated_date, hidden: false, sortable: true, dataIndex: 'app_updated_date', width: 120, renderer: Webi.format.dateRenderer},
			{header: Tracking.properties.app_updated_by, hidden: false, sortable: true, dataIndex: 'app_updated_by', width: 120}
        ];

        // super
        Tracking.grid.application.superclass.initComponent.call(this);
    },
    getDefaultData: function(){
        var defaultData = {
			'app_id': '',
			'app_name': '',
			'app_created_date': '',
			'app_created_by': '',
			'app_updated_date': '',
			'app_updated_by': ''
        };
        return defaultData;
    }
});
Ext.reg('grid_application', Tracking.grid.application);
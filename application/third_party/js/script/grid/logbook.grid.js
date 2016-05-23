/**
 * @class Tracking.grid.logbook
 * Grid for table track_application
 *
 * @author agung.hp
 * @since 29-10-2015 10:12:52
 */
Tracking.grid.logbook = Ext.extend(Webi.grid.GridPanel, {
    viewConfig:{forceFit:false},
    initComponent : function() {
        this.store = new Tracking.store.logbook();
        var cbActivityType = new Tracking.combo.ActivityType();

        this.columns = [
            {header: Tracking.properties.lbook_id, hidden: true, sortable: true, dataIndex: 'lbook_id'},
            {header: Tracking.properties.lbook_type, hidden: false, sortable: true, dataIndex: 'lbook_type', width: 160, renderer: Webi.format.comboRenderer(cbActivityType)},
            {header: Tracking.properties.app_name, hidden: false, sortable: true, dataIndex: 'app_name', width:266},
            {header: Tracking.properties.lbook_date, hidden: false, sortable: true, dataIndex: 'lbook_date', width: 120, renderer: Webi.format.dateRenderer},
            {header: Tracking.properties.lbook_description, hidden: false, sortable: true, dataIndex: 'lbook_description', width: 500},

            {header: Tracking.properties.lbook_created_date, hidden: false, sortable: true, dataIndex: 'lbook_created_date', width: 120, renderer: Webi.format.dateRenderer},
            {header: Tracking.properties.lbook_created_by, hidden: false, sortable: true, dataIndex: 'lbook_created_by', width: 120},
            {header: Tracking.properties.lbook_updated_date, hidden: false, sortable: true, dataIndex: 'lbook_updated_date', width: 120, renderer: Webi.format.dateRenderer},
            {header: Tracking.properties.lbook_updated_by, hidden: false, sortable: true, dataIndex: 'lbook_updated_by', width: 120}
        ];

        // super
        Tracking.grid.logbook.superclass.initComponent.call(this);
    },
    getDefaultData: function(){
        var defaultData = {
            'lbook_id': '',
            'lbook_date': '',
            'lbook_type': 'Development',
            'app_id': '',
            'lbook_description': '',
            'lbook_created_date': '',
            'lbook_created_by': '',
            'lbook_updated_date': '',
            'lbook_updated_by': ''
        };
        return defaultData;
    }
});
Ext.reg('grid_logbook', Tracking.grid.logbook);
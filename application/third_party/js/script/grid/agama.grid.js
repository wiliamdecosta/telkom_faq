/**
 * @class App.grid.agama
 * Grid for table km_agama
 *
 * @author wiliamdecosta@gmail.com	
 * @since 5/14/2010 2:26:18 PM
 */
App.grid.agama = Ext.extend(Webi.grid.GridPanel, {
	    
    initComponent : function() {
		
		if(!this.store) this.store = new App.store.agama();
        this.columns = [
            {header: App.properties.agama_id , hidden: true, sortable: true, dataIndex: 'agama_id', width:50},
            {header: App.properties.agama_nama , hidden: false, sortable: true, dataIndex: 'agama_nama', width:200}
        ];

        // super
        App.grid.agama.superclass.initComponent.call(this);
    },
    
    getDefaultData: function(){
        var defaultData = {
			'agama_id': '',
			'agama_nama': ''
        };
        return defaultData;
    }
});
Ext.reg('grid_agama', App.grid.agama);
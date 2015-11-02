/**
 * @class App.grid.pegawai
 * Grid for table km_agama
 *
 * @author wiliamdecosta@gmail.com	
 * @since 5/14/2010 2:26:18 PM
 */
App.grid.pegawai = Ext.extend(Webi.grid.GridPanel, {
	    
    initComponent : function() {
		
		if(!this.store) this.store = new App.store.pegawai();
        this.columns = [
            {header: App.properties.peg_id, hidden: true, sortable: true, dataIndex: 'peg_id', width:50},
            {header: App.properties.agama_id, hidden: true, sortable: true, dataIndex: 'agama_id'},
            {header: App.properties.peg_nik, hidden: false, sortable: true, dataIndex: 'peg_nik'},
            {header: App.properties.peg_nama, hidden: false, sortable: true, dataIndex: 'peg_nama'},
            {header: App.properties.agama_nama, hidden: false, sortable: true, dataIndex: 'agama_nama'},
            {header: App.properties.peg_tgl_lahir, hidden: false, sortable: true, dataIndex: 'peg_tgl_lahir', renderer: Webi.format.dateRenderer},
            {header: App.properties.peg_alamat, hidden: false, sortable: true, dataIndex: 'peg_alamat'}
		];

        // super
        App.grid.pegawai.superclass.initComponent.call(this);
    },
    
    getDefaultData: function(){
        var defaultData = {
        	'peg_id': '',
			'agama_id': '',
			'peg_nik': '',
			'peg_nama': '',
			'peg_tgl_lahir': '',
			'peg_alamat': ''
        };
        return defaultData;
    }
});
Ext.reg('grid_pegawai', App.grid.pegawai);
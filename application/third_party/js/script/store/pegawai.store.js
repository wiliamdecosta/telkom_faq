/**
 * @class App.store.pegawai
 * Store for table km_perusahaan
 *
 * @author agung.hp
 * @since 16-01-2010 22:50:43
 */
App.store.pegawai = function(config){
	var config = config || {};
	Ext.applyIf(config, {
        proxy: new Ext.data.HttpProxy({
            api: {
                read : WS_URL + 'pegawai_controller/read',
                create : WS_URL + 'pegawai_controller/create',
                update: WS_URL + 'pegawai_controller/update',
                destroy: WS_URL + 'pegawai_controller/destroy'
            }
        }),
        reader: new Ext.data.JsonReader({
            totalProperty: 'total',
            successProperty: 'success',
            idProperty: 'peg_id',
            root: 'items',
            messageProperty: 'message'
        }, [
		    {name: 'peg_id', type: 'int'},
		    {name: 'agama_id', type: 'int'},
			{name: 'peg_nik', allowBlank:false},
			{name: 'peg_nama', allowBlank:false},
			{name: 'agama_nama'},
			{name: 'peg_tgl_lahir', type: 'date', dateFormat: 'Y-m-d'},
			{name: 'peg_alamat'},
			{name: '_display_field_'}
			
        ]),
        writer: new Ext.data.JsonWriter({
            encode: true,
            writeAllFields: false
        }),
        autoSave: false
	});
	// call the superclass's constructor 
	App.store.pegawai.superclass.constructor.call(this, config);
};

Ext.extend(App.store.pegawai, Ext.data.Store);
Ext.reg('store_pegawai', App.store.pegawai);
/**
 * @class App.store.agama
 * Store for table km_perusahaan
 *
 * @author agung.hp
 * @since 16-01-2010 22:50:43
 */
App.store.agama = function(config){
	var config = config || {};
	Ext.applyIf(config, {
        proxy: new Ext.data.HttpProxy({
            api: {
                read : WS_URL + 'agama_controller/read',
                create : WS_URL + 'agama_controller/create',
                update: WS_URL + 'agama_controller/update',
                destroy: WS_URL + 'agama_controller/destroy'
            }
        }),
        reader: new Ext.data.JsonReader({
            totalProperty: 'total',
            successProperty: 'success',
            idProperty: 'agama_id',
            root: 'items',
            messageProperty: 'message'
        }, [
		    {name: 'agama_id', type: 'int'},
			{name: 'agama_nama'},
			{name: '_display_field_'}
			
        ]),
        writer: new Ext.data.JsonWriter({
            encode: true,
            writeAllFields: false
        }),
        autoSave: false
	});
	// call the superclass's constructor 
	App.store.agama.superclass.constructor.call(this, config);
};

Ext.extend(App.store.agama, Ext.data.Store);
Ext.reg('store_agama', App.store.agama);
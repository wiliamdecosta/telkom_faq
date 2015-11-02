/**
 * @class Tracking.store.application
 * Store for table track_application
 *
 * @author agung.hp
 * @since 29-10-2015 10:12:52
 */
Tracking.store.application = function(config){
	var config = config || {};
	Ext.applyIf(config, {
        proxy: new Ext.data.HttpProxy({
            api: {
                read : WS_URL + 'application_controller/read',
                create : WS_URL + 'application_controller/create',
                update: WS_URL + 'application_controller/update',
                destroy: WS_URL + 'application_controller/destroy'
            }
        }),
        reader: new Ext.data.JsonReader({
            totalProperty: 'total',
            successProperty: 'success',
            idProperty: 'app_id',
            root: 'items',
            messageProperty: 'message'
        }, [
		    {name: 'app_id', type: 'int'},
			{name: 'app_name', allowBlank: false},
			{name: 'app_created_date', type: 'date', dateFormat: 'Y-m-d'},
			{name: 'app_created_by'},
			{name: 'app_updated_date', type: 'date', dateFormat: 'Y-m-d'},
			{name: 'app_updated_by'},
			{name: '_display_field_'}
        ]),
        writer: new Ext.data.JsonWriter({
            encode: true,
            writeAllFields: false
        }),
        autoSave: false
	});
	// call the superclass's constructor 
	Tracking.store.application.superclass.constructor.call(this, config);
};

Ext.extend(Tracking.store.application, Ext.data.Store);
Ext.reg('store_application', Tracking.store.application);
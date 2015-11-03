/**
 * @class Tracking.store.maintenance
 * Store for table track_maintenance
 *
 * @author agung.hp
 * @since 03-11-2015 10:27:14
 */
Tracking.store.maintenance = function(config){
	var config = config || {};
	Ext.applyIf(config, {
        proxy: new Ext.data.HttpProxy({
            api: {
                read : WS_URL + 'maintenance_controller/read',
                create : WS_URL + 'maintenance_controller/create',
                update: WS_URL + 'maintenance_controller/update',
                destroy: WS_URL + 'maintenance_controller/destroy'
            }
        }),
        reader: new Ext.data.JsonReader({
            totalProperty: 'total',
            successProperty: 'success',
            idProperty: 'mnt_id',
            root: 'items',
            messageProperty: 'message'
        }, [
		    {name: 'mnt_id', type: 'int'},
			{name: 'app_id', type: 'int'},
			{name: 'app_name'},
			{name: 'mnt_desc'},
			{name: 'mnt_by'},
			{name: 'mnt_date', type: 'date', dateFormat: 'Y-m-d'},
			{name: 'mnt_evidence_desc'},
			{name: 'mnt_created_date', type: 'date', dateFormat: 'Y-m-d'},
			{name: 'mnt_created_by'},
			{name: 'mnt_updated_date', type: 'date', dateFormat: 'Y-m-d'},
			{name: 'mnt_updated_by'}
        ]),
        writer: new Ext.data.JsonWriter({
            encode: true,
            writeAllFields: false
        }),
        autoSave: false
	});
	// call the superclass's constructor 
	Tracking.store.maintenance.superclass.constructor.call(this, config);
};

Ext.extend(Tracking.store.maintenance, Ext.data.Store);
Ext.reg('store_maintenance', Tracking.store.maintenance);
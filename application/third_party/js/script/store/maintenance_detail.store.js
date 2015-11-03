/**
 * @class Tracking.store.maintenance_detail
 * Store for table track_maintenance_detail
 *
 * @author agung.hp
 * @since 03-11-2015 10:27:14
 */
Tracking.store.maintenance_detail = function(config){
	var config = config || {};
	Ext.applyIf(config, {
        proxy: new Ext.data.HttpProxy({
            api: {
                read : WS_URL + 'maintenance_detail_controller/read',
                create : WS_URL + 'maintenance_detail_controller/create',
                update: WS_URL + 'maintenance_detail_controller/update',
                destroy: WS_URL + 'maintenance_detail_controller/destroy'
            }
        }),
        reader: new Ext.data.JsonReader({
            totalProperty: 'total',
            successProperty: 'success',
            idProperty: 'mnt_det_id',
            root: 'items',
            messageProperty: 'message'
        }, [
		    {name: 'mnt_det_id', type: 'int'},
			{name: 'mnt_id', type: 'int'},
			{name: 'mnt_det_pic', allowBlank: false},
			{name: 'mnt_det_desc'},
			{name: 'mnt_det_start_date', type: 'date', dateFormat: 'Y-m-d'},
			{name: 'mnt_det_due_date', type: 'date', dateFormat: 'Y-m-d'},
			{name: 'mnt_det_status'},
			{name: 'mnt_det_created_date', type: 'date', dateFormat: 'Y-m-d'},
			{name: 'mnt_det_created_by'},
			{name: 'mnt_det_updated_date', type: 'date', dateFormat: 'Y-m-d'},
			{name: 'mnt_det_updated_by'}
        ]),
        writer: new Ext.data.JsonWriter({
            encode: true,
            writeAllFields: false
        }),
        autoSave: false
	});
	// call the superclass's constructor 
	Tracking.store.maintenance_detail.superclass.constructor.call(this, config);
};

Ext.extend(Tracking.store.maintenance_detail, Ext.data.Store);
Ext.reg('store_maintenance_detail', Tracking.store.maintenance_detail);
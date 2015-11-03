/**
 * @class Tracking.store.maintenance_evidence
 * Store for table track_maintenance_evidence
 *
 * @author agung.hp
 * @since 03-11-2015 10:27:14
 */
Tracking.store.maintenance_evidence = function(config){
	var config = config || {};
	Ext.applyIf(config, {
        proxy: new Ext.data.HttpProxy({
            api: {
                read : WS_URL + 'maintenance_evidence_controller/read',
                create : WS_URL + 'maintenance_evidence_controller/create',
                update: WS_URL + 'maintenance_evidence_controller/update',
                destroy: WS_URL + 'maintenance_evidence_controller/destroy'
            }
        }),
        reader: new Ext.data.JsonReader({
            totalProperty: 'total',
            successProperty: 'success',
            idProperty: 'mnt_evd_id',
            root: 'items',
            messageProperty: 'message'
        }, [
		    {name: 'mnt_evd_id', type: 'int'},
			{name: 'mnt_id', type: 'int'},
			{name: 'mnt_evd_file', allowBlank: false},
			{name: 'mnt_evd_desc'},
			{name: 'mnt_evd_created_date', type: 'date', dateFormat: 'Y-m-d'},
			{name: 'mnt_evd_created_by'},
			{name: 'mnt_evd_updated_date', type: 'date', dateFormat: 'Y-m-d'},
			{name: 'mnt_evd_updated_by'}
        ]),
        writer: new Ext.data.JsonWriter({
            encode: true,
            writeAllFields: false
        }),
        autoSave: false
	});
	// call the superclass's constructor 
	Tracking.store.maintenance_evidence.superclass.constructor.call(this, config);
};

Ext.extend(Tracking.store.maintenance_evidence, Ext.data.Store);
Ext.reg('store_maintenance_evidence', Tracking.store.maintenance_evidence);
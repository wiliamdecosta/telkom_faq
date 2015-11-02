/**
 * @class Tracking.store.evidence
 * Store for table track_evidence
 *
 * @author agung.hp
 * @since 29-10-2015 10:12:52
 */
Tracking.store.evidence = function(config){
	var config = config || {};
	Ext.applyIf(config, {
        proxy: new Ext.data.HttpProxy({
            api: {
                read : WS_URL + 'evidence_controller/read',
                create : WS_URL + 'evidence_controller/create',
                update: WS_URL + 'evidence_controller/update',
                destroy: WS_URL + 'evidence_controller/destroy'
            }
        }),
        reader: new Ext.data.JsonReader({
            totalProperty: 'total',
            successProperty: 'success',
            idProperty: 'evd_id',
            root: 'items',
            messageProperty: 'message'
        }, [
		    {name: 'evd_id', type: 'int'},
			{name: 'req_id', type: 'int'},
			{name: 'evd_file'},
			{name: 'evd_desc'},
			{name: 'evd_created_date', type: 'date', dateFormat: 'Y-m-d'},
			{name: 'evd_created_by'},
			{name: 'evd_updated_date', type: 'date', dateFormat: 'Y-m-d'},
			{name: 'evd_updated_by'}
        ]),
        writer: new Ext.data.JsonWriter({
            encode: true,
            writeAllFields: false
        }),
        autoSave: false
	});
	// call the superclass's constructor 
	Tracking.store.evidence.superclass.constructor.call(this, config);
};

Ext.extend(Tracking.store.evidence, Ext.data.Store);
Ext.reg('store_evidence', Tracking.store.evidence);
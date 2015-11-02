/**
 * @class Tracking.store.requirement
 * Store for table track_requirement
 *
 * @author agung.hp
 * @since 29-10-2015 10:12:52
 */
Tracking.store.requirement = function(config){
	var config = config || {};
	Ext.applyIf(config, {
        proxy: new Ext.data.HttpProxy({
            api: {
                read : WS_URL + 'requirement_controller/read',
                create : WS_URL + 'requirement_controller/create',
                update: WS_URL + 'requirement_controller/update',
                destroy: WS_URL + 'requirement_controller/destroy'
            }
        }),
        reader: new Ext.data.JsonReader({
            totalProperty: 'total',
            successProperty: 'success',
            idProperty: 'req_id',
            root: 'items',
            messageProperty: 'message'
        }, [
		    {name: 'req_id', type: 'int'},
			{name: 'app_id', type: 'int'},
			{name: 'app_name'},
			{name: 'req_desc', allowBlank: false},
			{name: 'req_by'},
			{name: 'req_date', type: 'date', dateFormat: 'Y-m-d'},
			{name: 'req_evidence_desc'},
			{name: 'req_created_date', type: 'date', dateFormat: 'Y-m-d'},
			{name: 'req_created_by'},
			{name: 'req_updated_date', type: 'date', dateFormat: 'Y-m-d'},
			{name: 'req_updated_by'}
        ]),
        writer: new Ext.data.JsonWriter({
            encode: true,
            writeAllFields: false
        }),
        autoSave: false
	});
	// call the superclass's constructor 
	Tracking.store.requirement.superclass.constructor.call(this, config);
};

Ext.extend(Tracking.store.requirement, Ext.data.Store);
Ext.reg('store_requirement', Tracking.store.requirement);
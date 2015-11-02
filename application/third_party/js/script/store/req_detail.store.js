/**
 * @class Tracking.store.req_detail
 * Store for table track_req_detail
 *
 * @author agung.hp
 * @since 29-10-2015 10:12:52
 */
Tracking.store.req_detail = function(config){
	var config = config || {};
	Ext.applyIf(config, {
        proxy: new Ext.data.HttpProxy({
            api: {
                read : WS_URL + 'req_detail_controller/read',
                create : WS_URL + 'req_detail_controller/create',
                update: WS_URL + 'req_detail_controller/update',
                destroy: WS_URL + 'req_detail_controller/destroy'
            }
        }),
        reader: new Ext.data.JsonReader({
            totalProperty: 'total',
            successProperty: 'success',
            idProperty: 'req_det_id',
            root: 'items',
            messageProperty: 'message'
        }, [
		    {name: 'req_det_id', type: 'int'},
			{name: 'req_id', type: 'int'},
			{name: 'req_det_pic'},
			{name: 'req_det_desc'},
			{name: 'req_det_start_date', type: 'date', dateFormat: 'Y-m-d'},
			{name: 'req_det_due_date', type: 'date', dateFormat: 'Y-m-d'},
			{name: 'req_det_status'},
			{name: 'req_det_created_date', type: 'date', dateFormat: 'Y-m-d'},
			{name: 'req_det_created_by'},
			{name: 'req_det_updated_date', type: 'date', dateFormat: 'Y-m-d'},
			{name: 'req_det_updated_by'}
        ]),
        writer: new Ext.data.JsonWriter({
            encode: true,
            writeAllFields: false
        }),
        autoSave: false
	});
	// call the superclass's constructor 
	Tracking.store.req_detail.superclass.constructor.call(this, config);
};

Ext.extend(Tracking.store.req_detail, Ext.data.Store);
Ext.reg('store_req_detail', Tracking.store.req_detail);
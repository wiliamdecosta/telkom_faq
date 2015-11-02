/**
 * @class Tracking.store.faq
 * Store for table track_faq
 *
 * @author agung.hp
 * @since 29-10-2015 10:12:52
 */
Tracking.store.faq = function(config){
	var config = config || {};
	Ext.applyIf(config, {
        proxy: new Ext.data.HttpProxy({
            api: {
                read : WS_URL + 'faq_controller/read',
                create : WS_URL + 'faq_controller/create',
                update: WS_URL + 'faq_controller/update',
                destroy: WS_URL + 'faq_controller/destroy'
            }
        }),
        reader: new Ext.data.JsonReader({
            totalProperty: 'total',
            successProperty: 'success',
            idProperty: 'faq_id',
            root: 'items',
            messageProperty: 'message'
        }, [
		    {name: 'faq_id', type: 'int'},
			{name: 'app_id', type: 'int'},
			{name: 'app_name'},
			{name: 'faq_case_name', allowBlank: false},
			{name: 'faq_case_by'},
			{name: 'faq_case_date', type: 'date', dateFormat: 'Y-m-d'},
			{name: 'faq_solution'},
			{name: 'faq_solution_by'},
			{name: 'faq_solution_finish_date', type: 'date', dateFormat: 'Y-m-d'},
			{name: 'faq_description'},
			{name: 'faq_created_date', type: 'date', dateFormat: 'Y-m-d'},
			{name: 'faq_created_by'},
			{name: 'faq_updated_date', type: 'date', dateFormat: 'Y-m-d'},
			{name: 'faq_updated_by'},
			{name: '_display_field_'}
        ]),
        writer: new Ext.data.JsonWriter({
            encode: true,
            writeAllFields: false
        }),
        autoSave: false
	});
	// call the superclass's constructor 
	Tracking.store.faq.superclass.constructor.call(this, config);
};

Ext.extend(Tracking.store.faq, Ext.data.Store);
Ext.reg('store_faq', Tracking.store.faq);
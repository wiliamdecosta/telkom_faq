/**
 * @class Tracking.store.faq_attachment
 * Store for table track_faq_attachment
 *
 * @author agung.hp
 * @since 29-10-2015 10:12:52
 */
Tracking.store.faq_attachment = function(config){
	var config = config || {};
	Ext.applyIf(config, {
        proxy: new Ext.data.HttpProxy({
            api: {
                read : WS_URL + 'faq_attachment_controller/read',
                create : WS_URL + 'faq_attachment_controller/create',
                update: WS_URL + 'faq_attachment_controller/update',
                destroy: WS_URL + 'faq_attachment_controller/destroy'
            }
        }),
        reader: new Ext.data.JsonReader({
            totalProperty: 'total',
            successProperty: 'success',
            idProperty: 'faq_attach_id',
            root: 'items',
            messageProperty: 'message'
        }, [
		    {name: 'faq_attach_id', type: 'int'},
			{name: 'faq_id', type: 'int'},
			{name: 'faq_case_name'},
			{name: 'faq_attach_file'},
			{name: 'faq_attach_desc'},
			{name: 'faq_attach_created_date', type: 'date', dateFormat: 'Y-m-d'},
			{name: 'faq_attach_created_by'},
			{name: 'faq_attach_updated_date', type: 'date', dateFormat: 'Y-m-d'},
			{name: 'faq_attach_updated_by'}
        ]),
        writer: new Ext.data.JsonWriter({
            encode: true,
            writeAllFields: false
        }),
        autoSave: false
	});
	// call the superclass's constructor 
	Tracking.store.faq_attachment.superclass.constructor.call(this, config);
};

Ext.extend(Tracking.store.faq_attachment, Ext.data.Store);
Ext.reg('store_faq_attachment', Tracking.store.faq_attachment);
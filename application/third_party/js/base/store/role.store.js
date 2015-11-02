/**
 * @class Base.store.role
 * Store for table core_role
 *
 * @author wiliamdecosta@gmail.com
 * @since 22-01-2010 13:23:17
 */
Base.store.role = function(config){
	var config = config || {};
	Ext.applyIf(config, {
        proxy: new Ext.data.HttpProxy({
            api: {
                read : WS_URL + 'base.role_controller/read',
                create : WS_URL + 'base.role_controller/create',
                update: WS_URL + 'base.role_controller/update',
                destroy: WS_URL + 'base.role_controller/destroy'
            }
        }),
        reader: new Ext.data.JsonReader({
                totalProperty: 'total',
                successProperty: 'success',
                idProperty: 'role_id',
                root: 'items',
                messageProperty: 'message'
            }, 
            [
				{name: 'role_id', type: 'int'}, 
				{name: 'role_name', allowBlank: false}, 
				{name: 'role_status'}, 
				{name: '_display_field_'}
			]
        ),
        writer: new Ext.data.JsonWriter({
            encode: true,
            writeAllFields: false
        }),
        autoSave: false
	});
	// call the superclass's constructor 
	Base.store.role.superclass.constructor.call(this, config);
};

Ext.extend(Base.store.role, Ext.data.Store);
Ext.reg('store_role', Base.store.role);
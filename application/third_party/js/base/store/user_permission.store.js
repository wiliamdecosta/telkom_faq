/**
 * @class Base.store.user_permission
 * Store for table core_user_permission
 *
 * @author wiliamdecosta@gmail.com
 * @since 22-01-2010 13:23:17
 */
Base.store.user_permission = function(config){
	var config = config || {};
	Ext.applyIf(config, {
        proxy: new Ext.data.HttpProxy({
            api: {
                read : WS_URL + 'base.user_permission_controller/read',
                create : WS_URL + 'base.user_permission_controller/create',
                update: WS_URL + 'base.user_permission_controller/update',
                destroy: WS_URL + 'base.user_permission_controller/destroy'
            }
        }),
        reader: new Ext.data.JsonReader({
                totalProperty: 'total',
                successProperty: 'success',
                idProperty: 'user_permission_id',
                root: 'items',
                messageProperty: 'message'
            }, 
            [
                {name: 'user_permission_id'}, 
				{name: 'user_id', type: 'int'}, 
				{name: 'user_name'}, 
				{name: 'permission_id', allowBlank: false, type: 'int'},
				{name: 'permission_level'}
			]
        ),
        writer: new Ext.data.JsonWriter({
            encode: true,
            writeAllFields: false
        }),
        autoSave: false
	});
	// call the superclass's constructor 
	Base.store.user_permission.superclass.constructor.call(this, config);
};

Ext.extend(Base.store.user_permission, Ext.data.Store);
Ext.reg('store_user_permission', Base.store.user_permission);
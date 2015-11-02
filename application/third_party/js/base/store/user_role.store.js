/**
 * @class Base.store.user_role
 * Store for table core_user_role
 *
 * @author wiliamdecosta@gmail.com
 * @since 22-01-2010 13:23:17
 */
Base.store.user_role = function(config){
	var config = config || {};
	Ext.applyIf(config, {
        proxy: new Ext.data.HttpProxy({
            api: {
                read : WS_URL + 'base.user_role_controller/read',
                create : WS_URL + 'base.user_role_controller/create',
                update: WS_URL + 'base.user_role_controller/update',
                destroy: WS_URL + 'base.user_role_controller/destroy'
            }
        }),
        reader: new Ext.data.JsonReader({
                totalProperty: 'total',
                successProperty: 'success',
                idProperty: 'user_role_id',
                root: 'items',
                messageProperty: 'message'
            }, 
            [
                {name: 'user_role_id'}, 
				{name: 'user_id', type: 'int'}, 
				{name: 'user_name'},
				{name: 'role_id', type: 'int'}, 
				{name: 'role_name'},
				{name: 'main_role'}
			]
        ),
        writer: new Ext.data.JsonWriter({
            encode: true,
            writeAllFields: false
        }),
        autoSave: false
	});
	// call the superclass's constructor 
	Base.store.user_role.superclass.constructor.call(this, config);
};

Ext.extend(Base.store.user_role, Ext.data.Store);
Ext.reg('store_user_role', Base.store.user_role);
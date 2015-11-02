/**
 * @class Base.store.user
 * Store for table core_user
 *
 * @author wiliamdecosta@gmail.com
 * @since 22-01-2010 13:23:17
 */
Base.store.user = function(config){
	var config = config || {};
	Ext.applyIf(config, {
        proxy: new Ext.data.HttpProxy({
            api: {
                read : WS_URL + 'base.user_controller/read',
                create : WS_URL + 'base.user_controller/create',
                update: WS_URL + 'base.user_controller/update',
                destroy: WS_URL + 'base.user_controller/destroy'
            }
        }),
        reader: new Ext.data.JsonReader({
                totalProperty: 'total',
                successProperty: 'success',
                idProperty: 'user_id',
                root: 'items',
                messageProperty: 'message'
            }, 
            [
				{name: 'user_id', type: 'int'}, 
				{name: 'user_name', allowBlank: false}, 
				{name: 'user_password'}, 
				{name: 'user_email'}, 
				{name: 'role_id'}, 
				{name: 'user_realname'}, 
				{name: 'user_status'}, 
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
	Base.store.user.superclass.constructor.call(this, config);
};

Ext.extend(Base.store.user, Ext.data.Store);
Ext.reg('store_user', Base.store.user);
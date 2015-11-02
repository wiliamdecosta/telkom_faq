/**
 * @class Bds.store.p_role_menu
 * Store for table bds_p_role_menu
 *
 * @author wiliamdecosta@gmail.com
 * @since 23-10-2012 12:07:20
 */
Base.store.role_menu = function(config){
	var config = config || {};
	Ext.applyIf(config, {
        proxy: new Ext.data.HttpProxy({
            api: {
                read : WS_URL + 'base.role_menu_controller/read',
                create : WS_URL + 'base.role_menu_controller/create',
                update: WS_URL + 'base.role_menu_controller/update',
                destroy: WS_URL + 'base.role_menu_controller/destroy'
            }
        }),
        reader: new Ext.data.JsonReader({
            totalProperty: 'total',
            successProperty: 'success',
            idProperty: 'rolemenu_id',
            root: 'items',
            messageProperty: 'message'
        }, [
		    {name: 'rolemenu_id', type: 'int'},
			{name: 'menu_id', type: 'int'},
			{name: 'role_id', type: 'int'},
			{name: 'rolemenu_status'},
			{name: 'menu_code'},
			{name: 'menu_path'},
			{name: 'menu_level', type: 'int'},
			{name: 'menu_listing_no', type: 'float'},
			{name: 'menu_is_active'},
			{name: 'menu_description'},
			{name: 'rolemenu_creation_date', type: 'date', dateFormat: 'Y-m-d'},
			{name: 'rolemenu_creation_by'},
			{name: 'rolemenu_updated_date', type: 'date', dateFormat: 'Y-m-d'},
			{name: 'rolemenu_updated_by'},
			{name: 'font_style'},
			{name: 'font_color'},
			{name: '_display_field_'}
        ]),
        writer: new Ext.data.JsonWriter({
            encode: true,
            writeAllFields: false
        }),
        autoSave: false
	});
	// call the superclass's constructor 
	Base.store.role_menu.superclass.constructor.call(this, config);
};

Ext.extend(Base.store.role_menu, Ext.data.Store);
Ext.reg('store_role_menu', Base.store.role_menu);
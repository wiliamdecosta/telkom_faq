/**
 * @class Tracking.store.logbook
 * Store for table track_application
 *
 * @author agung.hp
 * @since 29-10-2015 10:12:52
 */
Tracking.store.logbook = function(config){
    var config = config || {};
    Ext.applyIf(config, {
        proxy: new Ext.data.HttpProxy({
            api: {
                read : WS_URL + 'logbook_controller/read',
                create : WS_URL + 'logbook_controller/create',
                update: WS_URL + 'logbook_controller/update',
                destroy: WS_URL + 'logbook_controller/destroy'
            }
        }),
        reader: new Ext.data.JsonReader({
            totalProperty: 'total',
            successProperty: 'success',
            idProperty: 'lbook_id',
            root: 'items',
            messageProperty: 'message'
        }, [
            {name: 'lbook_id', type: 'int'},
            {name: 'user_id', type: 'int'},
            {name: 'app_id', type: 'int'},
            {name: 'lbook_date', type: 'date', dateFormat: 'Y-m-d', allowBlank: false},
            {name: 'app_name'},
            {name: 'lbook_type'},
            {name: 'lbook_description'},
            {name: 'lbook_created_date', type: 'date', dateFormat: 'Y-m-d'},
            {name: 'lbook_created_by'},
            {name: 'lbook_updated_date', type: 'date', dateFormat: 'Y-m-d'},
            {name: 'lbook_updated_by'},
            {name: '_display_field_'}
        ]),
        writer: new Ext.data.JsonWriter({
            encode: true,
            writeAllFields: false
        }),
        autoSave: false
    });
    // call the superclass's constructor
    Tracking.store.logbook.superclass.constructor.call(this, config);
};

Ext.extend(Tracking.store.logbook, Ext.data.Store);
Ext.reg('store_logbook', Tracking.store.logbook);
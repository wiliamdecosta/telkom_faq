/**
 * @class Tracking.combo.application
 * ComboBox for table track_application
 *
 * @since 29-10-2015 10:12:52
 * @author agung.hp
 */
Tracking.combo.application = Ext.extend(Ext.form.ComboBox, {
    fieldLabel: Tracking.properties.app_name,
    name: 'app_id',
    store: {xtype:'store_application'},
    displayField:'_display_field_',
    valueField: 'app_id',
    typeAhead: false,
    loadingText: 'Searching...',
    pageSize:50,
    minChars: 2,
    triggerAction: 'all',
    lazyRender: true,    
    initComponent : function() {
        // super
        Tracking.combo.application.superclass.initComponent.call(this);

        this.on('change', function(combo, newValue, oldValue){
            if(!parseInt(newValue)){
                combo.setValue('');
            }
        }, this);                

        this.store.on('load', function(store, records, options){
            var id = this.getValue();
            
            if (store.find('app_id', id) != -1){
                this.setValue(id);
            }
        }, this);
    }
});
Ext.reg('combo_application', Tracking.combo.application);
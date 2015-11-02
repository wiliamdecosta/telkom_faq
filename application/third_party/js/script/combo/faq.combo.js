/**
 * @class Tracking.combo.faq
 * ComboBox for table track_faq
 *
 * @since 29-10-2015 10:12:52
 * @author agung.hp
 */
Tracking.combo.faq = Ext.extend(Ext.form.ComboBox, {
    fieldLabel: Tracking.properties.faq_case_name,
    name: 'faq_id',
    store: {xtype:'store_faq'},
    displayField:'_display_field_',
    valueField: 'faq_id',
    typeAhead: false,
    loadingText: 'Searching...',
    pageSize:50,
    minChars: 2,
    triggerAction: 'all',
    lazyRender: true,    
    initComponent : function() {
        // super
        Tracking.combo.faq.superclass.initComponent.call(this);

        this.on('change', function(combo, newValue, oldValue){
            if(!parseInt(newValue)){
                combo.setValue('');
            }
        }, this);                

        this.store.on('load', function(store, records, options){
            var id = this.getValue();
            
            if (store.find('faq_id', id) != -1){
                this.setValue(id);
            }
        }, this);
    }
});
Ext.reg('combo_faq', Tracking.combo.faq);
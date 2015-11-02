/**
 * @class App.combo.agama
 * ComboBox for table task_agama
 *
 * @since 24-03-2010 10:50:05
 * @author agung.hp
 */
App.combo.agama = Ext.extend(Ext.form.ComboBox, {
    fieldLabel: App.properties.agama_id,
    name: 'agama_id',
    displayField:'_display_field_',
    valueField: 'agama_id',
    typeAhead: false,
    loadingText: 'Searching...',
    pageSize:50,
    minChars: 2,
    triggerAction: 'all',
    lazyRender: true,
    initComponent : function() {
        if (!this.store) this.store = new App.store.agama();
        // super
        App.combo.agama.superclass.initComponent.call(this);

        this.on('change', function(combo, newValue, oldValue){
            if(!parseInt(newValue)){
                combo.setValue('');
            }
        }, this);

        this.store.on('load', function(store, records, options){
            var id = this.getValue();

            if (store.find('agama_id', id) != -1){
                this.setValue(id);
            }
        }, this);
    }
});
Ext.reg('combo_agama', App.combo.agama);
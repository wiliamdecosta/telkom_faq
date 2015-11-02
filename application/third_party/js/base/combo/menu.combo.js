/**
 * @class Base.combo.menu
 * ComboBox for table core_menu
 *
 * @since 07/05/2015 16:49:36
 * @author wiliamdecosta@gmail.com
 */
Base.combo.menu = Ext.extend(Ext.form.ComboBox, {
    fieldLabel: 'Menu',
    name: 'menu_id',
    store: {xtype:'store_menu'},
    displayField: '_display_field_',
    valueField: 'menu_id',
    typeAhead: false,
    loadingText: 'Searching...',
    pageSize:50,
    minChars: 2,
    triggerAction: 'all',
    lazyRender: true, 
    tpl: '<tpl for="."><div class="x-combo-list-item" style="padding-left:{padding_level}px;font-weight:{font_style};color:{font_color};">{_display_field_}</div></tpl>',
    initComponent : function() {
        // super
        Base.combo.menu.superclass.initComponent.call(this);

        this.on('change', function(combo, newValue, oldValue){
            if(!parseInt(newValue)){
                combo.setValue('');
            }
        }, this);                

        this.store.on('load', function(store, records, options){
            var id = this.getValue();
            
            if (store.find('menu_id', id) != -1){
                this.setValue(id);
            }
        }, this);
    }
    
    
});
Ext.reg('combo_menu', Base.combo.menu);
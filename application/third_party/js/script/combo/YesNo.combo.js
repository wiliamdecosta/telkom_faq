/**
 * @class Tracking.combo.YesNo
 * Static ComboBox YesNo
 *
 * @since 29-10-2015 10:12:52
 * @author agung.hp
 */
Tracking.combo.YesNo = Ext.extend(Ext.form.ComboBox, {
    fieldLabel: 'YesNo',
    typeAhead: false,
    triggerAction: 'all',
    lazyRender: true,    
    mode: 'local',
    store: new Ext.data.ArrayStore({
        fields: ['id', 'name'],
        data: [['Y', 'Ya'],['T', 'Tidak']]
    }),
    valueField: 'id',
    displayField: 'name',
    editable: false,
    initComponent : function() {
        // super
        Tracking.combo.YesNo.superclass.initComponent.call(this);
    }
});
Ext.reg('combo_YesNo', Tracking.combo.YesNo);
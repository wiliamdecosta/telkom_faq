/**
 * @class Tracking.combo.ActiveStatus
 * Static ComboBox ActiveStatus
 *
 * @since 22-01-2010 15:42:16
 * @author wiliamdecosta@gmail.com
 */
Tracking.combo.ActiveStatus = Ext.extend(Ext.form.ComboBox, {
    fieldLabel: 'ActiveStatus',
    typeAhead: false,
    triggerAction: 'all',
    lazyRender: true,
    mode: 'local',
    store: new Ext.data.ArrayStore({
        fields: ['id', 'name'],
        data: [['a', 'Aktif'],['i', 'Tidak Aktif']]
    }),
    valueField: 'id',
    displayField: 'name',
    editable: false,
    initComponent : function() {
        // super
        Tracking.combo.ActiveStatus.superclass.initComponent.call(this);
    }
});
Ext.reg('combo_ActiveStatus', Tracking.combo.ActiveStatus);
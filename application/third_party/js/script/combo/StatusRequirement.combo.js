/**
 * @class Tracking.combo.StatusRequirement
 * Static ComboBox StatusRequirement
 *
 * @since 29-10-2015 10:12:52
 * @author agung.hp
 */
Tracking.combo.StatusRequirement = Ext.extend(Ext.form.ComboBox, {
    fieldLabel: 'StatusRequirement',
    typeAhead: false,
    triggerAction: 'all',
    lazyRender: true,    
    mode: 'local',
    store: new Ext.data.ArrayStore({
        fields: ['id', 'name'],
        data: [['B', 'Belum Dikerjakan'],['P', 'Pending'],['I', 'In Progress'],['C', 'Closed']]
    }),
    valueField: 'id',
    displayField: 'name',
    editable: false,
    initComponent : function() {
        // super
        Tracking.combo.StatusRequirement.superclass.initComponent.call(this);
    }
});
Ext.reg('combo_StatusRequirement', Tracking.combo.StatusRequirement);
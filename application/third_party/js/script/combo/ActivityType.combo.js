/**
 * @class Tracking.combo.StatusRequirement
 * Static ComboBox StatusRequirement
 *
 * @since 29-10-2015 10:12:52
 * @author agung.hp
 */
Tracking.combo.ActivityType = Ext.extend(Ext.form.ComboBox, {
    fieldLabel: 'ActivityType',
    typeAhead: false,
    triggerAction: 'all',
    lazyRender: true,
    mode: 'local',
    store: new Ext.data.ArrayStore({
        fields: ['id', 'name'],
        data: [['Development', 'Development'],['Maintenance', 'Maintenance']]
    }),
    valueField: 'id',
    displayField: 'name',
    editable: false,
    initComponent : function() {
        // super
        Tracking.combo.ActivityType.superclass.initComponent.call(this);
    }
});
Ext.reg('combo_ActivityType', Tracking.combo.ActivityType);
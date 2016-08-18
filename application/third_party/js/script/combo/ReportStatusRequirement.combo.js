/**
 * @class Tracking.combo.ReportStatusRequirement
 * Static ComboBox ReportStatusRequirement
 *
 * @since 29-10-2015 10:12:52
 * @author agung.hp
 */
Tracking.combo.ReportStatusRequirement = Ext.extend(Ext.form.ComboBox, {
    fieldLabel: 'ReportStatusRequirement',
    typeAhead: false,
    triggerAction: 'all',
    lazyRender: true,
    mode: 'local',
    store: new Ext.data.ArrayStore({
        fields: ['id', 'name'],
        data: [['','Semua'],['B', 'Belum Dikerjakan'],['P', 'Pending'],['I', 'In Progress'],['C', 'Closed']]
    }),
    valueField: 'id',
    displayField: 'name',
    editable: false,
    initComponent : function() {
        // super
        Tracking.combo.ReportStatusRequirement.superclass.initComponent.call(this);
    }
});
Ext.reg('combo_ReportStatusRequirement', Tracking.combo.ReportStatusRequirement);
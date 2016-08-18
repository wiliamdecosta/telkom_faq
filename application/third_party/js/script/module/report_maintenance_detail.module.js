/**
 * @class Tracking.module.report_maintenance_detail
 * Module panel for table track_maintenance_detail
 *
 * @since 29-10-2015 10:12:52
 * @author agung.hp
 */
Tracking.module.report_maintenance_detail = Ext.extend(Webi.module.Panel, {
    addTitle: Tracking.properties.maintenance_detail_addTitle,
    editTitle: Tracking.properties.maintenance_detail_editTitle,
    winWidth:400,
    winHeight:348,
    /**
     * initComponent
     * @protected
     */
    initComponent : function() {
        // super
        Tracking.module.report_maintenance_detail.superclass.initComponent.call(this);
    },
    buildPanel : function(){
        this.grid = new Tracking.grid.report_maintenance_detail({border: false});
        this.initGridEvents();

        return this.grid;
    },
    buildForm : function(){
        return null;
    }
});

Ext.reg('module_report_maintenance_detail', Tracking.module.report_maintenance_detail);
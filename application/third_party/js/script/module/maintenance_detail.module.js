/**
 * @class Tracking.module.maintenance_detail
 * Module panel for table track_maintenance_detail
 *
 * @since 29-10-2015 10:12:52
 * @author agung.hp
 */
Tracking.module.maintenance_detail = Ext.extend(Webi.module.Panel, {
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
        Tracking.module.maintenance_detail.superclass.initComponent.call(this);
    },
    buildPanel : function(){
        this.grid = new Tracking.grid.maintenance_detail({border: false});
        this.initGridEvents();

        return this.grid;
    },
    buildForm : function(){
        this.form = new Tracking.form.maintenance_detail();
		this.initFormEvents();
		
		
		return this.form;
    }
});

Ext.reg('module_maintenance_detail', Tracking.module.maintenance_detail);
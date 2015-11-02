/**
 * @class Tracking.module.application
 * Module panel for table track_application
 *
 * @since 29-10-2015 10:12:52
 * @author agung.hp
 */
Tracking.module.application = Ext.extend(Webi.module.Panel, {
    addTitle: Tracking.properties.application_addTitle,
    editTitle: Tracking.properties.application_editTitle,
    winWidth:400,
    winHeight:200,
    /**
     * initComponent
     * @protected
     */
    initComponent : function() {
        // super
        Tracking.module.application.superclass.initComponent.call(this);
    },
    buildPanel : function(){
        this.grid = new Tracking.grid.application({border: false});
        this.initGridEvents();

        return this.grid;
    },
    buildForm : function(){
        this.form = new Tracking.form.application();
		this.initFormEvents();
		
		
		return this.form;
    }
});

Ext.reg('module_application', Tracking.module.application);
/**
 * @class Tracking.module.logbook_view
 * Module panel for table track_logbook
 *
 * @since 29-10-2015 10:12:52
 * @author agung.hp
 */
Tracking.module.logbook_view = Ext.extend(Webi.module.Panel, {
    addTitle: Tracking.properties.logbook_addTitle,
    editTitle: Tracking.properties.logbook_editTitle,
    winWidth:600,
    winHeight:320,
    /**
     * initComponent
     * @protected
     */
    initComponent : function() {
        // super
        Tracking.module.logbook_view.superclass.initComponent.call(this);
    },
    buildPanel : function(){
        this.grid = new Tracking.grid.logbook_view({border: false});
        this.initGridEvents();

        return this.grid;
    },
    buildForm : function(){
        return null;
    }
});

Ext.reg('module_logbook_view', Tracking.module.logbook_view);
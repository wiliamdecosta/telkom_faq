/**
 * @class Tracking.module.logbook
 * Module panel for table track_logbook
 *
 * @since 29-10-2015 10:12:52
 * @author agung.hp
 */
Tracking.module.logbook = Ext.extend(Webi.module.Panel, {
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
        Tracking.module.logbook.superclass.initComponent.call(this);
    },
    buildPanel : function(){
        this.grid = new Tracking.grid.logbook({border: false});
        this.initGridEvents();

        return this.grid;
    },
    buildForm : function(){
        this.form = new Tracking.form.logbook();
        this.initFormEvents();


        return this.form;
    }
});

Ext.reg('module_logbook', Tracking.module.logbook);
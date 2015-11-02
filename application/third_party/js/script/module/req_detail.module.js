/**
 * @class Tracking.module.req_detail
 * Module panel for table track_req_detail
 *
 * @since 29-10-2015 10:12:52
 * @author agung.hp
 */
Tracking.module.req_detail = Ext.extend(Webi.module.Panel, {
    addTitle: Tracking.properties.req_detail_addTitle,
    editTitle: Tracking.properties.req_detail_editTitle,
    winWidth:400,
    winHeight:348,
    /**
     * initComponent
     * @protected
     */
    initComponent : function() {
        // super
        Tracking.module.req_detail.superclass.initComponent.call(this);
    },
    buildPanel : function(){
        this.grid = new Tracking.grid.req_detail({border: false});
        this.initGridEvents();

        return this.grid;
    },
    buildForm : function(){
        this.form = new Tracking.form.req_detail();
		this.initFormEvents();
		
		
		return this.form;
    }
});

Ext.reg('module_req_detail', Tracking.module.req_detail);
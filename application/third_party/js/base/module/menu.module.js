/**
 * @class Bds.module.p_app_menu
 * Module panel for table bds_p_app_menu
 *
 * @since 23-10-2012 12:07:20
 * @author wiliamdecosta@gmail.com
 */
Base.module.menu = Ext.extend(Webi.module.Panel, {
    addTitle: 'Tambah Menu',
    editTitle: 'Edit Menu',
    winWidth:400,
    winHeight:255,
    /**
     * initComponent
     * @protected
     */
    initComponent : function() {
        // super
        Base.module.menu.superclass.initComponent.call(this);
    },
    buildPanel : function(){
        this.grid = new Base.grid.menu({border: false});
        this.initGridEvents();

        return this.grid;
    },
    buildForm : function(){
        this.form = new Base.form.menu();
		this.initFormEvents();
		
		
		return this.form;
    }
});

Ext.reg('module_menu', Base.module.menu);
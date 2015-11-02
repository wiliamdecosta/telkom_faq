/**
 * @class Kmart.module.pegawai
 * Module panel for table km_pegawai
 *
 * @since 5/14/2010 1:53:26 PM
 * @author wiliamdecosta@gmail.com
 */
App.module.pegawai = Ext.extend(Webi.module.Panel, {
    addTitle: App.properties.cip_pegawai_addTitle,
    editTitle: App.properties.cip_pegawai_editTitle,
    winWidth:400,
    winHeight:300,
    /**
     * initComponent
     * @protected
     */
    initComponent : function() {
        // super
        App.module.pegawai.superclass.initComponent.call(this);
    },
    
    buildPanel : function(){
        this.grid = new App.grid.pegawai({border: false});
        this.initGridEvents();

        return this.grid;
    },
    
    buildForm : function(){
        this.form = new App.form.pegawai();
		this.initFormEvents();
		
		return this.form;
    }
});

Ext.reg('module_pegawai', App.module.pegawai);
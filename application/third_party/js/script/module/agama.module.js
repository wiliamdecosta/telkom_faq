/**
 * @class Kmart.module.agama
 * Module panel for table km_agama
 *
 * @since 5/14/2010 1:53:26 PM
 * @author wiliamdecosta@gmail.com
 */
App.module.agama = Ext.extend(Webi.module.Panel, {
    addTitle: App.properties.ci_agama_addTitle,
    editTitle: App.properties.ci_agama_editTitle,
    winWidth:400,
    winHeight:199,
    /**
     * initComponent
     * @protected
     */
    initComponent : function() {
        // super
        App.module.agama.superclass.initComponent.call(this);
    },
    
    buildPanel : function(){
        this.grid = new App.grid.agama({border: false});
        this.initGridEvents();

        return this.grid;
    },
    
    buildForm : function(){
        this.form = new App.form.agama();
		this.initFormEvents();
		
		return this.form;
    }
});

Ext.reg('module_agama', App.module.agama);
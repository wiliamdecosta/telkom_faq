/**
 * @class App.form.agama
 * Form panel for table km_agama
 *
 * @since 5/14/2010 2:27:41 PM
 * @author wiliamdecosta@gmail.com
 */
App.form.agama = Ext.extend(Webi.form.FormPanel, {
    /**
     * initComponent
     * @protected
     */
    initComponent : function() {
        // super
        App.form.agama.superclass.initComponent.call(this);
    },

    /**
     * buildform
     * @private
     */
    buildForm : function() {
        
        this.fields = {};
        this.fields.agama_id = new Ext.form.Hidden({fieldLabel: App.properties.agama_id, name: 'agama_id', allowBlank: true});
        this.fields.agama_nama = new Ext.form.TextField({fieldLabel: App.properties.agama_nama, name:'agama_nama', anchor:'95%', allowBlank: false});
        
        return [
        	this.fields.agama_id,
			this.fields.agama_nama
		];
    },
    
    focusField: function(){
    	return true;
    }
});

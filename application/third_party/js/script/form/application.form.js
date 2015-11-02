/**
 * @class Tracking.form.application
 * Form panel for table track_application
 *
 * @since 29-10-2015 10:12:52
 * @author agung.hp
 */
Tracking.form.application = Ext.extend(Webi.form.FormPanel, {
    /**
     * initComponent
     * @protected
     */
    initComponent : function() {
        // super
        Tracking.form.application.superclass.initComponent.call(this);
    },

    /**
     * buildform
     * @private
     */
    buildForm : function() {
        this.fields = {};
        
        
        this.fields.app_id = new Ext.form.Hidden({fieldLabel: Tracking.properties.app_id, name: 'app_id', allowBlank: true});

        this.fields.app_name = new Ext.form.TextField({fieldLabel: Tracking.properties.app_name, name: 'app_name', allowBlank: false, anchor: '95%'});

        /*this.fields.app_created_date = new Ext.form.DateField({fieldLabel: Tracking.properties.app_created_date, name: 'app_created_date', allowBlank: true, format: 'd-m-Y'});
        this.fields.app_created_by = new Ext.form.TextField({fieldLabel: Tracking.properties.app_created_by, name: 'app_created_by', allowBlank: true, anchor: '95%'});
        this.fields.app_updated_date = new Ext.form.DateField({fieldLabel: Tracking.properties.app_updated_date, name: 'app_updated_date', allowBlank: true, format: 'd-m-Y'});
        this.fields.app_updated_by = new Ext.form.TextField({fieldLabel: Tracking.properties.app_updated_by, name: 'app_updated_by', allowBlank: true, anchor: '95%'});
        */
        
        return [
            this.fields.app_id,
			this.fields.app_name
        ];
    },
    focusField: function(){
    	this.fields.app_name.focus();
    }
});

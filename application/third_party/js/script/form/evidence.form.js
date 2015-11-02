/**
 * @class Tracking.form.evidence
 * Form panel for table track_evidence
 *
 * @since 29-10-2015 10:12:52
 * @author agung.hp
 */
Tracking.form.evidence = Ext.extend(Webi.form.FormPanel, {
    /**
     * initComponent
     * @protected
     */
    fileUpload: true,
    initComponent : function() {
        // super
        Tracking.form.evidence.superclass.initComponent.call(this);
    },

    /**
     * buildform
     * @private
     */
    buildForm : function() {
        this.fields = {};
        
        
        this.fields.evd_id = new Ext.form.Hidden({fieldLabel: Tracking.properties.evd_id, name: 'evd_id', allowBlank: true});

        this.fields.req_id = new Ext.form.Hidden({fieldLabel: Tracking.properties.req_id, name: 'req_id', allowBlank: true});

        //this.fields.evd_file = new Ext.form.TextField({fieldLabel: Tracking.properties.evd_file, name: 'evd_file', allowBlank: true, anchor: '95%'});
        this.fields.evd_file = new Ext.ux.form.FileUploadField({
            emptyText: 'Pilih File',
            fieldLabel: 'File Attachment',
            name: 'evd_file',
            allowBlank: false,
            buttonText: '',
            buttonCfg: {
                iconCls: 'icon-upload'
            },
            anchor: '95%'
        });
        
        
        this.fields.evd_desc = new Ext.form.TextArea({fieldLabel: Tracking.properties.evd_desc, name: 'evd_desc', allowBlank: true, anchor: '95%'});

        /*this.fields.evd_created_date = new Ext.form.DateField({fieldLabel: Tracking.properties.evd_created_date, name: 'evd_created_date', allowBlank: true, format: 'd-m-Y'});
        this.fields.evd_created_by = new Ext.form.TextField({fieldLabel: Tracking.properties.evd_created_by, name: 'evd_created_by', allowBlank: true, anchor: '95%'});
        this.fields.evd_updated_date = new Ext.form.DateField({fieldLabel: Tracking.properties.evd_updated_date, name: 'evd_updated_date', allowBlank: true, format: 'd-m-Y'});
        this.fields.evd_updated_by = new Ext.form.TextField({fieldLabel: Tracking.properties.evd_updated_by, name: 'evd_updated_by', allowBlank: true, anchor: '95%'});
        */
        
        return [
            this.fields.evd_id,
			this.fields.req_id,
			this.fields.evd_file,
			this.fields.evd_desc
        ];
    },
    focusField: function(){
    	this.fields.req_id.focus();
    }
});

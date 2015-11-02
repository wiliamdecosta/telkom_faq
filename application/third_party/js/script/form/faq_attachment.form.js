/**
 * @class Tracking.form.faq_attachment
 * Form panel for table track_faq_attachment
 *
 * @since 29-10-2015 10:12:52
 * @author agung.hp
 */
Tracking.form.faq_attachment = Ext.extend(Webi.form.FormPanel, {
    /**
     * initComponent
     * @protected
     */
    fileUpload: true,
    initComponent : function() {
        // super
        Tracking.form.faq_attachment.superclass.initComponent.call(this);
    },

    /**
     * buildform
     * @private
     */
    buildForm : function() {
        this.fields = {};
        
        
        this.fields.faq_attach_id = new Ext.form.Hidden({fieldLabel: Tracking.properties.faq_attach_id, name: 'faq_attach_id', allowBlank: true});

        this.fields.faq_id = new Ext.form.Hidden({fieldLabel: Tracking.properties.faq_id, name: 'faq_id', allowBlank: true});

        //this.fields.faq_attach_file = new Ext.form.TextField({fieldLabel: Tracking.properties.faq_attach_file, name: 'faq_attach_file', allowBlank: true, anchor: '95%'});
        this.fields.faq_attach_file = new Ext.ux.form.FileUploadField({
            emptyText: 'Pilih File',
            fieldLabel: 'File Attachment',
            name: 'faq_attach_file',
            allowBlank: false,
            buttonText: '',
            buttonCfg: {
                iconCls: 'icon-upload'
            },
            anchor: '95%'
        });
        

        this.fields.faq_attach_desc = new Ext.form.TextArea({fieldLabel: Tracking.properties.faq_attach_desc, name: 'faq_attach_desc', allowBlank: true, anchor: '95%'});

        /*this.fields.faq_attach_created_date = new Ext.form.DateField({fieldLabel: Tracking.properties.faq_attach_created_date, name: 'faq_attach_created_date', allowBlank: true, format: 'd-m-Y'});
        this.fields.faq_attach_created_by = new Ext.form.TextField({fieldLabel: Tracking.properties.faq_attach_created_by, name: 'faq_attach_created_by', allowBlank: true, anchor: '95%'});
        this.fields.faq_attach_updated_date = new Ext.form.DateField({fieldLabel: Tracking.properties.faq_attach_updated_date, name: 'faq_attach_updated_date', allowBlank: true, format: 'd-m-Y'});
        this.fields.faq_attach_updated_by = new Ext.form.TextField({fieldLabel: Tracking.properties.faq_attach_updated_by, name: 'faq_attach_updated_by', allowBlank: true, anchor: '95%'});
        */
        
        return [
            this.fields.faq_attach_id,
			this.fields.faq_id,
			this.fields.faq_attach_file,
			this.fields.faq_attach_desc
        ];
    },
    focusField: function(){
    	this.fields.faq_id.focus();
    }
});

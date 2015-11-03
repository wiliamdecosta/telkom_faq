/**
 * @class Tracking.form.maintenance_evidence
 * Form panel for table track_maintenance_evidence
 *
 * @since 29-10-2015 10:12:52
 * @author agung.hp
 */
Tracking.form.maintenance_evidence = Ext.extend(Webi.form.FormPanel, {
    /**
     * initComponent
     * @protected
     */
    fileUpload: true,
    initComponent : function() {
        // super
        Tracking.form.maintenance_evidence.superclass.initComponent.call(this);
    },

    /**
     * buildform
     * @private
     */
    buildForm : function() {
        this.fields = {};
        
        
        this.fields.mnt_evd_id = new Ext.form.Hidden({fieldLabel: Tracking.properties.mnt_evd_id, name: 'mnt_evd_id', allowBlank: true});

        this.fields.mnt_id = new Ext.form.Hidden({fieldLabel: Tracking.properties.mnt_id, name: 'mnt_id', allowBlank: true});

        //this.fields.mnt_evd_file = new Ext.form.TextField({fieldLabel: Tracking.properties.mnt_evd_file, name: 'mnt_evd_file', allowBlank: true, anchor: '95%'});
        this.fields.mnt_evd_file = new Ext.ux.form.FileUploadField({
            emptyText: 'Pilih File',
            fieldLabel: 'File Attachment',
            name: 'mnt_evd_file',
            allowBlank: false,
            buttonText: '',
            buttonCfg: {
                iconCls: 'icon-upload'
            },
            anchor: '95%'
        });
        
        
        this.fields.mnt_evd_desc = new Ext.form.TextArea({fieldLabel: Tracking.properties.mnt_evd_desc, name: 'mnt_evd_desc', allowBlank: true, anchor: '95%'});

        /*this.fields.mnt_evd_created_date = new Ext.form.DateField({fieldLabel: Tracking.properties.mnt_evd_created_date, name: 'mnt_evd_created_date', allowBlank: true, format: 'd-m-Y'});
        this.fields.mnt_evd_created_by = new Ext.form.TextField({fieldLabel: Tracking.properties.mnt_evd_created_by, name: 'mnt_evd_created_by', allowBlank: true, anchor: '95%'});
        this.fields.mnt_evd_updated_date = new Ext.form.DateField({fieldLabel: Tracking.properties.mnt_evd_updated_date, name: 'mnt_evd_updated_date', allowBlank: true, format: 'd-m-Y'});
        this.fields.mnt_evd_updated_by = new Ext.form.TextField({fieldLabel: Tracking.properties.mnt_evd_updated_by, name: 'mnt_evd_updated_by', allowBlank: true, anchor: '95%'});
        */
        
        return [
            this.fields.mnt_evd_id,
			this.fields.mnt_id,
			this.fields.mnt_evd_file,
			this.fields.mnt_evd_desc
        ];
    },
    focusField: function(){
    	this.fields.mnt_id.focus();
    }
});

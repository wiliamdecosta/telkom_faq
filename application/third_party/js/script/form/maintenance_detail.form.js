/**
 * @class Tracking.form.maintenance_detail
 * Form panel for table track_maintenance_detail
 *
 * @since 29-10-2015 10:12:52
 * @author agung.hp
 */
Tracking.form.maintenance_detail = Ext.extend(Webi.form.FormPanel, {
    /**
     * initComponent
     * @protected
     */
    initComponent : function() {
        // super
        Tracking.form.maintenance_detail.superclass.initComponent.call(this);
    },

    /**
     * buildform
     * @private
     */
    buildForm : function() {
        this.fields = {};
        
        
        this.fields.mnt_det_id = new Ext.form.Hidden({fieldLabel: Tracking.properties.mnt_det_id, name: 'mnt_det_id', allowBlank: true});

        this.fields.mnt_id = new Ext.form.Hidden({fieldLabel: Tracking.properties.mnt_id, name: 'mnt_id', allowBlank: true});

        this.fields.mnt_det_pic = new Ext.form.TextField({fieldLabel: Tracking.properties.mnt_det_pic, name: 'mnt_det_pic', allowBlank: false, anchor: '95%'});

        this.fields.mnt_det_start_date = new Ext.form.DateField({fieldLabel: Tracking.properties.mnt_det_start_date, name: 'mnt_det_start_date', allowBlank: true, format: 'd-m-Y'});

        this.fields.mnt_det_due_date = new Ext.form.DateField({fieldLabel: Tracking.properties.mnt_det_due_date, name: 'mnt_det_due_date', allowBlank: true, format: 'd-m-Y'});

        this.fields.mnt_det_status = new Tracking.combo.StatusRequirement({fieldLabel: Tracking.properties.mnt_det_status, name: 'mnt_det_status', allowBlank: true});
        
        this.fields.mnt_det_desc = new Ext.form.TextArea({fieldLabel: 'Deskripsi', name: 'mnt_det_desc', allowBlank: true, anchor: '95%'});

        /*this.fields.mnt_det_created_date = new Ext.form.DateField({fieldLabel: Tracking.properties.mnt_det_created_date, name: 'mnt_det_created_date', allowBlank: true, format: 'd-m-Y'});
        this.fields.mnt_det_created_by = new Ext.form.TextField({fieldLabel: Tracking.properties.mnt_det_created_by, name: 'mnt_det_created_by', allowBlank: true, anchor: '95%'});
        this.fields.mnt_det_updated_date = new Ext.form.DateField({fieldLabel: Tracking.properties.mnt_det_updated_date, name: 'mnt_det_updated_date', allowBlank: true, format: 'd-m-Y'});
        this.fields.mnt_det_updated_by = new Ext.form.TextField({fieldLabel: Tracking.properties.mnt_det_updated_by, name: 'mnt_det_updated_by', allowBlank: true, anchor: '95%'});
        */
        
        return [
            this.fields.mnt_det_id,
			this.fields.mnt_id,
			this.fields.mnt_det_pic,
			this.fields.mnt_det_start_date,
			this.fields.mnt_det_due_date,
			this.fields.mnt_det_status,
			this.fields.mnt_det_desc
        ];
    },
    focusField: function(){
    	this.fields.mnt_id.focus();
    }
});

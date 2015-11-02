/**
 * @class Tracking.form.req_detail
 * Form panel for table track_req_detail
 *
 * @since 29-10-2015 10:12:52
 * @author agung.hp
 */
Tracking.form.req_detail = Ext.extend(Webi.form.FormPanel, {
    /**
     * initComponent
     * @protected
     */
    initComponent : function() {
        // super
        Tracking.form.req_detail.superclass.initComponent.call(this);
    },

    /**
     * buildform
     * @private
     */
    buildForm : function() {
        this.fields = {};
        
        
        this.fields.req_det_id = new Ext.form.Hidden({fieldLabel: Tracking.properties.req_det_id, name: 'req_det_id', allowBlank: true});

        this.fields.req_id = new Ext.form.Hidden({fieldLabel: Tracking.properties.req_id, name: 'req_id', allowBlank: true});

        this.fields.req_det_pic = new Ext.form.TextField({fieldLabel: Tracking.properties.req_det_pic, name: 'req_det_pic', allowBlank: false, anchor: '95%'});

        this.fields.req_det_start_date = new Ext.form.DateField({fieldLabel: Tracking.properties.req_det_start_date, name: 'req_det_start_date', allowBlank: true, format: 'd-m-Y'});

        this.fields.req_det_due_date = new Ext.form.DateField({fieldLabel: Tracking.properties.req_det_due_date, name: 'req_det_due_date', allowBlank: true, format: 'd-m-Y'});

        this.fields.req_det_status = new Tracking.combo.StatusRequirement({fieldLabel: Tracking.properties.req_det_status, name: 'req_det_status', allowBlank: true});
        
        this.fields.req_det_desc = new Ext.form.TextArea({fieldLabel: 'Deskripsi', name: 'req_det_desc', allowBlank: true, anchor: '95%'});

        /*this.fields.req_det_created_date = new Ext.form.DateField({fieldLabel: Tracking.properties.req_det_created_date, name: 'req_det_created_date', allowBlank: true, format: 'd-m-Y'});
        this.fields.req_det_created_by = new Ext.form.TextField({fieldLabel: Tracking.properties.req_det_created_by, name: 'req_det_created_by', allowBlank: true, anchor: '95%'});
        this.fields.req_det_updated_date = new Ext.form.DateField({fieldLabel: Tracking.properties.req_det_updated_date, name: 'req_det_updated_date', allowBlank: true, format: 'd-m-Y'});
        this.fields.req_det_updated_by = new Ext.form.TextField({fieldLabel: Tracking.properties.req_det_updated_by, name: 'req_det_updated_by', allowBlank: true, anchor: '95%'});
        */
        
        return [
            this.fields.req_det_id,
			this.fields.req_id,
			this.fields.req_det_pic,
			this.fields.req_det_start_date,
			this.fields.req_det_due_date,
			this.fields.req_det_status,
			this.fields.req_det_desc
        ];
    },
    focusField: function(){
    	this.fields.req_id.focus();
    }
});

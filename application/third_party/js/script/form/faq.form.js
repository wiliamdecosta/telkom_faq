/**
 * @class Tracking.form.faq
 * Form panel for table track_faq
 *
 * @since 29-10-2015 10:12:52
 * @author agung.hp
 */
Tracking.form.faq = Ext.extend(Webi.form.FormPanel, {
    /**
     * initComponent
     * @protected
     */
    initComponent : function() {
        // super
        Tracking.form.faq.superclass.initComponent.call(this);
    },

    /**
     * buildform
     * @private
     */
    buildForm : function() {
        this.fields = {};
        
        
        this.fields.faq_id = new Ext.form.Hidden({fieldLabel: Tracking.properties.faq_id, name: 'faq_id', allowBlank: true});

        this.fields.app_id = new Tracking.combo.application({name: 'app_id', allowBlank: false, width: 245});
        /* load record event */
        this.on('loadrecord', function(form, record, actionType){
            if (actionType == 'update'){
                this.fields.app_id.getStore().load({params: {app_id:record.get('app_id')}});
            }else{
                delete this.fields.app_id.lastQuery;
                this.fields.app_id.doQuery('', true);
            }            
        }, this);

        this.fields.faq_case_name = new Ext.form.TextField({fieldLabel: Tracking.properties.faq_case_name, name: 'faq_case_name', allowBlank: false, width: 245});

        this.fields.faq_case_by = new Ext.form.TextField({fieldLabel: Tracking.properties.faq_case_by, name: 'faq_case_by', allowBlank: true, width: 245});

        this.fields.faq_case_date = new Ext.form.DateField({fieldLabel: Tracking.properties.faq_case_date, name: 'faq_case_date', allowBlank: true, format: 'd-m-Y'});

        this.fields.faq_solution = new Ext.form.TextArea({fieldLabel: Tracking.properties.faq_solution, name: 'faq_solution', allowBlank: true, anchor: '95%'});

        this.fields.faq_solution_by = new Ext.form.TextField({fieldLabel: Tracking.properties.faq_solution_by, name: 'faq_solution_by', allowBlank: true, width: 245});

        this.fields.faq_solution_finish_date = new Ext.form.DateField({fieldLabel: Tracking.properties.faq_solution_finish_date, name: 'faq_solution_finish_date', allowBlank: true, format: 'd-m-Y'});

        this.fields.faq_description = new Ext.form.TextArea({fieldLabel: Tracking.properties.faq_description, name: 'faq_description', allowBlank: true, anchor: '95%'});

        /*this.fields.faq_created_date = new Ext.form.DateField({fieldLabel: Tracking.properties.faq_created_date, name: 'faq_created_date', allowBlank: true, format: 'd-m-Y'});

        this.fields.faq_created_by = new Ext.form.TextField({fieldLabel: Tracking.properties.faq_created_by, name: 'faq_created_by', allowBlank: true, width: 245});

        this.fields.faq_updated_date = new Ext.form.DateField({fieldLabel: Tracking.properties.faq_updated_date, name: 'faq_updated_date', allowBlank: true, format: 'd-m-Y'});

        this.fields.faq_updated_by = new Ext.form.TextField({fieldLabel: Tracking.properties.faq_updated_by, name: 'faq_updated_by', allowBlank: true, width: 245});
        */
        
        /*this.details_faq_attachment = new Tracking.module.faq_attachment({batchWrite: true, height:215});
        this.on('loadrecord', function(form, record, actionType){
            if (actionType == 'create'){
                this.details_faq_attachment.setBatchWriteMode(true);
                this.details_faq_attachment.grid.store.baseParams.faq_id = '';
                this.details_faq_attachment.grid.store.loadData({items:[], total: 0}, false);
                this.details_faq_attachment.grid.pagingTb.updateInfo();
            }else{
                this.details_faq_attachment.setBatchWriteMode(false);
                this.details_faq_attachment.grid.store.baseParams.faq_id = record.get('faq_id');
                this.details_faq_attachment.grid.store.load();
            }
        }, this);*/
        return [
            this.fields.faq_id,
			this.fields.app_id,
			{xtype: 'displayfield', value: 'Masukan min. 2 karakter untuk pencarian', cls: 'status-text'},
			this.fields.faq_case_name,
			this.fields.faq_case_by,
			this.fields.faq_case_date,
			this.fields.faq_solution,
			this.fields.faq_solution_by,
			this.fields.faq_solution_finish_date,
			this.fields.faq_description
        ];
    },
    focusField: function(){
    	this.fields.faq_case_name.focus();
    }
});

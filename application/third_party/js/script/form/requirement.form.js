/**
 * @class Tracking.form.requirement
 * Form panel for table track_requirement
 *
 * @since 29-10-2015 10:12:52
 * @author agung.hp
 */
Tracking.form.requirement = Ext.extend(Webi.form.FormPanel, {
    /**
     * initComponent
     * @protected
     */
    initComponent : function() {
        // super
        Tracking.form.requirement.superclass.initComponent.call(this);
    },

    /**
     * buildform
     * @private
     */
    buildForm : function() {
        this.fields = {};
        
        
        this.fields.req_id = new Ext.form.Hidden({fieldLabel: Tracking.properties.req_id, name: 'req_id', allowBlank: true});

        this.fields.app_id = new Tracking.combo.application({name: 'app_id', allowBlank: true, width: 245});
        /* load record event */
        this.on('loadrecord', function(form, record, actionType){
            if (actionType == 'update'){
                this.fields.app_id.getStore().load({params: {app_id:record.get('app_id')}});
            }else{
                delete this.fields.app_id.lastQuery;
                this.fields.app_id.doQuery('', true);
            }            
        }, this);

        this.fields.req_desc = new Ext.form.TextArea({fieldLabel: Tracking.properties.req_desc, name: 'req_desc', allowBlank: false, anchor: '95%'});

        this.fields.req_by = new Ext.form.TextField({fieldLabel: Tracking.properties.req_by, name: 'req_by', allowBlank: true, width: 245});

        this.fields.req_date = new Ext.form.DateField({fieldLabel: Tracking.properties.req_date, name: 'req_date', allowBlank: true, format: 'd-m-Y'});

        this.fields.req_evidence_desc = new Ext.form.TextArea({fieldLabel: Tracking.properties.req_evidence_desc, name: 'req_evidence_desc', allowBlank: true, anchor: '95%'});

        /*this.fields.req_created_date = new Ext.form.DateField({fieldLabel: Tracking.properties.req_created_date, name: 'req_created_date', allowBlank: true, format: 'd-m-Y'});
        this.fields.req_created_by = new Ext.form.TextField({fieldLabel: Tracking.properties.req_created_by, name: 'req_created_by', allowBlank: true, width: 245});
        this.fields.req_updated_date = new Ext.form.DateField({fieldLabel: Tracking.properties.req_updated_date, name: 'req_updated_date', allowBlank: true, format: 'd-m-Y'});
        this.fields.req_updated_by = new Ext.form.TextField({fieldLabel: Tracking.properties.req_updated_by, name: 'req_updated_by', allowBlank: true, width: 245});
        */
        
        /*this.details_evidence = new Tracking.module.evidence({batchWrite: true, height:215});
        this.on('loadrecord', function(form, record, actionType){
            if (actionType == 'create'){
                this.details_evidence.setBatchWriteMode(true);
                this.details_evidence.grid.store.baseParams.req_id = '';
                this.details_evidence.grid.store.loadData({items:[], total: 0}, false);
                this.details_evidence.grid.pagingTb.updateInfo();
            }else{
                this.details_evidence.setBatchWriteMode(false);
                this.details_evidence.grid.store.baseParams.req_id = record.get('req_id');
                this.details_evidence.grid.store.load();
            }
        }, this);
		
        this.details_req_detail = new Tracking.module.req_detail({batchWrite: true, height:215});
        this.on('loadrecord', function(form, record, actionType){
            if (actionType == 'create'){
                this.details_req_detail.setBatchWriteMode(true);
                this.details_req_detail.grid.store.baseParams.req_id = '';
                this.details_req_detail.grid.store.loadData({items:[], total: 0}, false);
                this.details_req_detail.grid.pagingTb.updateInfo();
            }else{
                this.details_req_detail.setBatchWriteMode(false);
                this.details_req_detail.grid.store.baseParams.req_id = record.get('req_id');
                this.details_req_detail.grid.store.load();
            }
        }, this);*/
        
        return [
            this.fields.req_id,
			this.fields.app_id,
			{xtype: 'displayfield', value: 'Masukan min. 2 karakter untuk pencarian', cls: 'status-text'},
			this.fields.req_desc,
			this.fields.req_by,
			this.fields.req_date,
			this.fields.req_evidence_desc
        ];
    },
    focusField: function(){
    	this.fields.req_desc.focus();
    }
});

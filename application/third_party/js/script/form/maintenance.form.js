/**
 * @class Tracking.form.maintenance
 * Form panel for table track_maintenance
 *
 * @since 29-10-2015 10:12:52
 * @author agung.hp
 */
Tracking.form.maintenance = Ext.extend(Webi.form.FormPanel, {
    /**
     * initComponent
     * @protected
     */
    initComponent : function() {
        // super
        Tracking.form.maintenance.superclass.initComponent.call(this);
    },

    /**
     * buildform
     * @private
     */
    buildForm : function() {
        this.fields = {};
        
        
        this.fields.mnt_id = new Ext.form.Hidden({fieldLabel: Tracking.properties.mnt_id, name: 'mnt_id', allowBlank: true});

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

        this.fields.mnt_desc = new Ext.form.TextArea({fieldLabel: Tracking.properties.mnt_desc, name: 'mnt_desc', allowBlank: false, anchor: '95%'});

        this.fields.mnt_by = new Ext.form.TextField({fieldLabel: Tracking.properties.mnt_by, name: 'mnt_by', allowBlank: true, width: 245});

        this.fields.mnt_date = new Ext.form.DateField({fieldLabel: Tracking.properties.mnt_date, name: 'mnt_date', allowBlank: true, format: 'd-m-Y'});

        this.fields.mnt_evidence_desc = new Ext.form.TextArea({fieldLabel: Tracking.properties.mnt_evidence_desc, name: 'mnt_evidence_desc', allowBlank: true, anchor: '95%'});

        /*this.fields.mnt_created_date = new Ext.form.DateField({fieldLabel: Tracking.properties.mnt_created_date, name: 'mnt_created_date', allowBlank: true, format: 'd-m-Y'});
        this.fields.mnt_created_by = new Ext.form.TextField({fieldLabel: Tracking.properties.mnt_created_by, name: 'mnt_created_by', allowBlank: true, width: 245});
        this.fields.mnt_updated_date = new Ext.form.DateField({fieldLabel: Tracking.properties.mnt_updated_date, name: 'mnt_updated_date', allowBlank: true, format: 'd-m-Y'});
        this.fields.mnt_updated_by = new Ext.form.TextField({fieldLabel: Tracking.properties.mnt_updated_by, name: 'mnt_updated_by', allowBlank: true, width: 245});
        */
        
        /*this.details_evidence = new Tracking.module.evidence({batchWrite: true, height:215});
        this.on('loadrecord', function(form, record, actionType){
            if (actionType == 'create'){
                this.details_evidence.setBatchWriteMode(true);
                this.details_evidence.grid.store.baseParams.mnt_id = '';
                this.details_evidence.grid.store.loadData({items:[], total: 0}, false);
                this.details_evidence.grid.pagingTb.updateInfo();
            }else{
                this.details_evidence.setBatchWriteMode(false);
                this.details_evidence.grid.store.baseParams.mnt_id = record.get('mnt_id');
                this.details_evidence.grid.store.load();
            }
        }, this);
		
        this.details_mnt_detail = new Tracking.module.mnt_detail({batchWrite: true, height:215});
        this.on('loadrecord', function(form, record, actionType){
            if (actionType == 'create'){
                this.details_mnt_detail.setBatchWriteMode(true);
                this.details_mnt_detail.grid.store.baseParams.mnt_id = '';
                this.details_mnt_detail.grid.store.loadData({items:[], total: 0}, false);
                this.details_mnt_detail.grid.pagingTb.updateInfo();
            }else{
                this.details_mnt_detail.setBatchWriteMode(false);
                this.details_mnt_detail.grid.store.baseParams.mnt_id = record.get('mnt_id');
                this.details_mnt_detail.grid.store.load();
            }
        }, this);*/
        
        return [
            this.fields.mnt_id,
			this.fields.app_id,
			{xtype: 'displayfield', value: 'Masukan min. 2 karakter untuk pencarian', cls: 'status-text'},
			this.fields.mnt_desc,
			this.fields.mnt_by,
			this.fields.mnt_date,
			this.fields.mnt_evidence_desc
        ];
    },
    focusField: function(){
    	this.fields.mnt_desc.focus();
    }
});

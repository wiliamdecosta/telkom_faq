/**
 * @class Tracking.grid.requirement
 * Grid for table track_requirement
 *
 * @author agung.hp
 * @since 29-10-2015 10:12:52
 */
Tracking.grid.requirement = Ext.extend(Webi.grid.GridPanel, {
    viewConfig:{forceFit:false},
    initComponent : function() {
        this.store = new Tracking.store.requirement();
        
        this.columns = [
            {header: Tracking.properties.req_id, hidden: true, sortable: true, dataIndex: 'req_id'},
			{header: Tracking.properties.app_name, hidden: false, sortable: true, dataIndex: 'app_name', width:266},
			{header: Tracking.properties.req_desc, hidden: false, sortable: true, dataIndex: 'req_desc', width:248},
			{header: Tracking.properties.req_by, hidden: false, sortable: true, dataIndex: 'req_by', width:182},
			{header: Tracking.properties.req_date, hidden: false, sortable: true, dataIndex: 'req_date', width: 120, renderer: Webi.format.dateRenderer},
			{header: Tracking.properties.req_evidence_desc, hidden: false, sortable: true, dataIndex: 'req_evidence_desc', width:244},
			{header: Tracking.properties.req_created_date, hidden: false, sortable: true, dataIndex: 'req_created_date', width: 120, renderer: Webi.format.dateRenderer},
			{header: Tracking.properties.req_created_by, hidden: false, sortable: true, dataIndex: 'req_created_by', width: 120},
			{header: Tracking.properties.req_updated_date, hidden: false, sortable: true, dataIndex: 'req_updated_date', width: 120, renderer: Webi.format.dateRenderer},
			{header: Tracking.properties.req_updated_by, hidden: false, sortable: true, dataIndex: 'req_updated_by', width: 120}
        ];

        // super
        Tracking.grid.requirement.superclass.initComponent.call(this);
    },
    getDefaultData: function(){
        var defaultData = {
			'req_id': '',
			'app_id': '',
			'req_desc': '',
			'req_by': '',
			'req_date': '',
			'req_evidence_desc': '',
			'req_created_date': '',
			'req_created_by': '',
			'req_updated_date': '',
			'req_updated_by': ''
        };
        return defaultData;
    },
    
    buildTopToolbar : function() {
        var buttons = [];
        
        this.labelFilter = new Ext.form.Label({text:'Filter FAQ :'});
                
        this.cmbApp = new Tracking.combo.application({emptyText:'Application', width:254});
        this.cmbApp.on('select', this.onSearch, this);
                
        if (this.enableAdd === true){
            buttons.push({
                itemId: 'btnNew',
                text: 'Tambah',
                iconCls: 'icon-add',
                handler: this.onNew,
                scope: this
            });
        }

        if (this.enableEdit === true){
            if (buttons.length > 1) buttons.push('-');
            buttons.push({
                itemId: 'btnEdit',
                text: 'Edit',
                iconCls: 'icon-edit',
                handler: this.onModify,
                disabled: true,
                scope: this
            });
        }
        
        if (this.enableDelete === true){
            if (buttons.length > 1) buttons.push('-');
            buttons.push({
                itemId: 'btnDelete',
                text: 'Hapus',
                iconCls: 'icon-delete',
                handler: this.onDelete,
                disabled: true,
                scope: this
            });
        }        

        if (this.usePaging === false){
            if (buttons.length > 1) buttons.push('-');
            buttons.push({
                itemId: 'btnReload',
                text: 'Reload',
                iconCls: 'x-tbar-loading',
                handler: function(){
                    this.store.reload();
                },
                scope: this
            });
        }
        
        buttons.push('->');
        buttons.push(this.labelFilter);
        buttons.push(' ');
        buttons.push(this.cmbApp);
        
        buttons.push({
            itemId: 'btnReset',
            text: 'Reset',
            handler: this.onReset,
            scope: this
        });        
        
        return buttons;
    },
    
    onReset: function() {
    	this.store.baseParams = {};
    	this.store.load();
    	
    	this.cmbApp.reset();		
    },
    
    getSearchParams: function() {
    	var app_id = this.cmbApp.getValue();
				
		var p = {};
		if(!Ext.isEmpty(app_id)) {
			p['app_id'] = app_id;
		}

		return p;
    },
    
    onSearch: function() {
    	var params = this.getSearchParams();
    	this.store.baseParams = params;
    	this.store.load();
    }
});
Ext.reg('grid_requirement', Tracking.grid.requirement);
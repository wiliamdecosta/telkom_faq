/**
 * @class Tracking.grid.report_maintenance
 * Grid for table track_maintenance
 *
 * @author agung.hp
 * @since 29-10-2015 10:12:52
 */
Tracking.grid.report_maintenance = Ext.extend(Webi.grid.GridPanel, {
    viewConfig:{forceFit:false},
    enableAdd:false,
    enableEdit:false,
    enableDelete:false,
    initComponent : function() {
        this.store = new Tracking.store.maintenance();

        this.columns = [
            {header: Tracking.properties.mnt_id, hidden: true, sortable: true, dataIndex: 'mnt_id'},
			{header: Tracking.properties.app_name, hidden: false, sortable: true, dataIndex: 'app_name', width:266},
			{header: Tracking.properties.mnt_desc, hidden: false, sortable: true, dataIndex: 'mnt_desc', width:248},
			{header: Tracking.properties.mnt_by, hidden: false, sortable: true, dataIndex: 'mnt_by', width:182},
			{header: Tracking.properties.mnt_date, hidden: false, sortable: true, dataIndex: 'mnt_date', width: 120, renderer: Webi.format.dateRenderer},
			{header: Tracking.properties.mnt_evidence_desc, hidden: false, sortable: true, dataIndex: 'mnt_evidence_desc', width:244},
			{header: Tracking.properties.mnt_created_date, hidden: false, sortable: true, dataIndex: 'mnt_created_date', width: 120, renderer: Webi.format.dateRenderer},
			{header: Tracking.properties.mnt_created_by, hidden: false, sortable: true, dataIndex: 'mnt_created_by', width: 120},
			{header: Tracking.properties.mnt_updated_date, hidden: false, sortable: true, dataIndex: 'mnt_updated_date', width: 120, renderer: Webi.format.dateRenderer},
			{header: Tracking.properties.mnt_updated_by, hidden: false, sortable: true, dataIndex: 'mnt_updated_by', width: 120}
        ];

        // super
        Tracking.grid.report_maintenance.superclass.initComponent.call(this);
    },
    getDefaultData: function(){
        var defaultData = {
			'mnt_id': '',
			'app_id': '',
			'mnt_desc': '',
			'mnt_by': '',
			'mnt_date': '',
			'mnt_evidence_desc': '',
			'mnt_created_date': '',
			'mnt_created_by': '',
			'mnt_updated_date': '',
			'mnt_updated_by': ''
        };
        return defaultData;
    },

    buildTopToolbar : function() {
        var buttons = [];

        this.labelFilter = new Ext.form.Label({text:'Filter Maintenance :'});

        this.labelDate = new Ext.form.Label({text:'Date :'});
        this.startDate = new Ext.form.DateField({emptyText:'From'});
        this.toDate = new Ext.form.DateField({emptyText:'To'});

        this.cmbApp = new Tracking.combo.application({emptyText:'Application', width:254});
        this.cmbApp.on('select', this.onSearch, this);

        this.cmbStatusRequirement = new Tracking.combo.ReportStatusRequirement({emptyText:'Status Pengerjaan', width:150});
        this.cmbStatusRequirement.on('select', this.onSearch, this);

        this.startDate.on('select',this.onSearch,this);
        this.toDate.on('select',this.onSearch,this);

        this.txtSearch = new Ext.form.TextField({emptyText:'Search...', width: 200});
        this.txtSearch.on('specialkey',this.onSearchText,this);

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

        buttons.push({
            itemId: 'btnExcel',
            text: 'Print Excel',
            handler: this.onPrintExcel,
            scope: this
        });
        buttons.push('-');
        buttons.push(this.labelFilter);
        buttons.push(' ');
        buttons.push(this.cmbApp);
        buttons.push(' ');
        buttons.push(this.cmbStatusRequirement);
        buttons.push(' ');
        buttons.push(this.startDate);
        buttons.push(this.toDate);

        buttons.push({
            itemId: 'btnReset',
            text: 'Reset',
            handler: this.onReset,
            scope: this
        });

        return buttons;
    },

    onPrintExcel: function() {

        var start_date = Ext.util.Format.date(this.startDate.getValue(), 'Y-m-d');
        var end_date = Ext.util.Format.date(this.toDate.getValue(), 'Y-m-d');

        var excel_url = BASE_URL+'print_excel/report_maintenance?';
        excel_url += 'application_id='+this.cmbApp.getValue();
        excel_url += '&status_pengerjaan='+this.cmbStatusRequirement.getValue();

        if(!Ext.isEmpty(this.startDate.getValue())) {
            excel_url += '&start_date='+ start_date;
        }
        if(!Ext.isEmpty(this.toDate.getValue())) {
            excel_url += '&end_date' + end_date;
        }

        location.href = excel_url;
    },

    onReset: function() {
    	this.store.baseParams = {};
    	this.store.load();

    	this.cmbApp.reset();
        this.cmbStatusRequirement.reset();
        this.startDate.reset();
        this.toDate.reset();
    	this.txtSearch.reset();
    },

    getSearchParams: function() {
    	var app_id = this.cmbApp.getValue();
    	var search_text = this.txtSearch.getValue();

        var start_date = Ext.util.Format.date(this.startDate.getValue(), 'Y-m-d');
        var end_date = Ext.util.Format.date(this.toDate.getValue(), 'Y-m-d');

        var status_pengerjaan = this.cmbStatusRequirement.getValue();

		var p = {};
		if(!Ext.isEmpty(app_id)) {
			p['app_id'] = app_id;
		}

        if(!Ext.isEmpty(status_pengerjaan)) {
            p['status_pengerjaan'] = status_pengerjaan;
        }

        if(!Ext.isEmpty(search_text)) {
			p['search_text'] = search_text;
		}

        if(!Ext.isEmpty(start_date)) {
            p['start_date'] = start_date;
        }

        if(!Ext.isEmpty(end_date)) {
            p['end_date'] = end_date;
        }

		return p;
    },

    onSearch: function() {
    	var params = this.getSearchParams();
    	this.store.baseParams = params;
    	this.store.load();
    },

    onSearchText: function(field, e) {
    	if(e.getKey() == e.ENTER) {
    		this.onSearch();
    	}
    }
});
Ext.reg('grid_report_maintenance', Tracking.grid.report_maintenance);
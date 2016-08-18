/**
 * @class Tracking.module.report_maintenance
 * Module panel for table track_maintenance
 *
 * @since 29-10-2015 10:12:52
 * @author agung.hp
 */
Tracking.module.report_maintenance = Ext.extend(Webi.module.Panel, {
    addTitle: 'Add Report Maintenance',
    editTitle: 'Edit Report Maintenance',
    winWidth:650,
    winHeight:373,
    /**
     * initComponent
     * @protected
     */
    initComponent : function() {
        // super
        Tracking.module.report_maintenance.superclass.initComponent.call(this);
    },
    buildPanel : function(){
        this.grid = new Tracking.grid.report_maintenance({border: false});
        this.initGridEvents();

        /* set masterId name for master-detail grid handling */
		this.masterId = 'mnt_id';
		this.displayId = 'mnt_by';

		this.details = {
			maintenance_evidence: new Tracking.module.report_maintenance_evidence({disabled: true}),
			maintenance_detail: new Tracking.module.report_maintenance_detail({disabled: true})
		};

		this.details.maintenance_evidence.grid.store.on('beforeload', this.onBeforeLoadDetail, this);
		this.details.maintenance_detail.grid.store.on('beforeload', this.onBeforeLoadDetail, this);

		this.tabPanel = new Ext.TabPanel({
		    enableTabScroll:true,
		    defaults: {autoScroll:true},
		    activeTab: 'maintenance_detail',
		    border: false,
		    items: [
		        {itemId: 'maintenance_detail', title: 'Detail Maintenance', layout: 'fit', items: this.details.maintenance_detail},
				{itemId: 'maintenance_evidence', title: 'Evidences', layout: 'fit', items: this.details.maintenance_evidence}
			]
		});
		this.tabPanel.on('tabchange', function(tabpanel, tab){
		    var sm = this.grid.getSelectionModel();
		    var rec = sm.getSelected();

		    if (rec) this.onRowSelectMasterGrid(sm, null, rec);
		}, this);

		this.grid.getSelectionModel().on('rowselect', this.onRowSelectMasterGrid, this);

        /* return configured layout */
		return {
		    xtype: 'panel',
		    layout: 'border',
		    border: false,
		    items : [
		        {
		            region: 'center',
		            margins: '1 1 0 1',
		            layout: 'fit',
		            minHeight: 110,
		            items: this.grid
		        },
		        {
		            region: 'south',
		            margins: '0 1 1 1',
		            cmargins: '1 1 1 1',
		            height: 200,
		            minHeight: 110,
		            split: true,
		            collapsible: true,
		            collapseMode: 'mini',
		            hideCollapseTool: true,
		            layout: 'fit',
		            items: this.tabPanel
		        }
		    ]
		};
    },
    buildForm : function(){
        return null;
    }
});

Ext.reg('module_report_maintenance', Tracking.module.report_maintenance);
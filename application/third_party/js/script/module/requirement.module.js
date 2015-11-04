/**
 * @class Tracking.module.requirement
 * Module panel for table track_requirement
 *
 * @since 29-10-2015 10:12:52
 * @author agung.hp
 */
Tracking.module.requirement = Ext.extend(Webi.module.Panel, {
    addTitle: Tracking.properties.requirement_addTitle,
    editTitle: Tracking.properties.requirement_editTitle,
    winWidth:650,
    winHeight:373,
    /**
     * initComponent
     * @protected
     */
    initComponent : function() {
        // super
        Tracking.module.requirement.superclass.initComponent.call(this);
    },
    buildPanel : function(){
        this.grid = new Tracking.grid.requirement({border: false});
        this.initGridEvents();

        /* set masterId name for master-detail grid handling */
		this.masterId = 'req_id';
		this.displayId = 'req_by';
		
		this.details = {
			evidence: new Tracking.module.evidence({disabled: true}),
			req_detail: new Tracking.module.req_detail({disabled: true})
		};
		
		this.details.evidence.grid.store.on('beforeload', this.onBeforeLoadDetail, this);
		this.details.req_detail.grid.store.on('beforeload', this.onBeforeLoadDetail, this);
		
		this.tabPanel = new Ext.TabPanel({
		    enableTabScroll:true,
		    defaults: {autoScroll:true},
		    activeTab: 'req_detail',
		    border: false,
		    items: [
		        {itemId: 'req_detail', title: 'Detail Requirement', layout: 'fit', items: this.details.req_detail},
				{itemId: 'evidence', title: 'Evidences', layout: 'fit', items: this.details.evidence}				
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
        this.form = new Tracking.form.requirement();
		this.initFormEvents();
		
        
		return this.form;
    }
});

Ext.reg('module_requirement', Tracking.module.requirement);
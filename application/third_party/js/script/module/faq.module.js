/**
 * @class Tracking.module.faq
 * Module panel for table track_faq
 *
 * @since 29-10-2015 10:12:52
 * @author agung.hp
 */
Tracking.module.faq = Ext.extend(Webi.module.Panel, {
    addTitle: Tracking.properties.faq_addTitle,
    editTitle: Tracking.properties.faq_editTitle,
    winWidth:650,
    winHeight:450,
    /**
     * initComponent
     * @protected
     */
    initComponent : function() {
        // super
        Tracking.module.faq.superclass.initComponent.call(this);
    },
    buildPanel : function(){
        this.grid = new Tracking.grid.faq({border: false});
        this.initGridEvents();

        /* set masterId name for master-detail grid handling */
		this.masterId = 'faq_id';
		this.displayId = 'faq_case_name';
		
		this.details = {
			faq_attachment: new Tracking.module.faq_attachment({disabled: true})
		};
		
		this.details.faq_attachment.grid.store.on('beforeload', this.onBeforeLoadDetail, this);
		
		this.tabPanel = new Ext.TabPanel({
		    enableTabScroll:true,
		    defaults: {autoScroll:true},
		    activeTab: 'faq_attachment',
		    border: false,
		    items: [
				{itemId: 'faq_attachment', title: 'Attachments', layout: 'fit', items: this.details.faq_attachment}
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
        this.form = new Tracking.form.faq();
		this.initFormEvents();
		
		return this.form;
    }
});

Ext.reg('module_faq', Tracking.module.faq);
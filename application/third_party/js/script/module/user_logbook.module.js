/**
 * @class Tracking.module.user_logbook
 * Module panel for table core_user
 *
 * @since 22-01-2010 13:23:18
 * @author wiliamdecosta@gmail.com
 */
Tracking.module.user_logbook = Ext.extend(Webi.module.Panel, {
    addTitle: 'Add User',
    editTitle: 'Edit User',
    winWidth:400,
    winHeight:300,
    /**
     * initComponent
     * @protected
     * TODO : permission per user
     */
    initComponent : function() {
        // super
        Tracking.module.user_logbook.superclass.initComponent.call(this);
    },
    buildPanel : function(){
        this.grid = new Tracking.grid.user_logbook({border: false});
        this.initGridEvents();

        /* set masterId name for master-detail grid handling */
        this.masterId = 'user_id';

        this.details = {
            logbook_view: new Tracking.module.logbook_view({disabled: true})
        };

        this.details.logbook_view.grid.store.on('beforeload', this.onBeforeLoadDetail, this);

        this.tabPanel = new Ext.TabPanel({
            resizeTabs:true,
            enableTabScroll:true,
            defaults: {autoScroll:true},
            activeTab: 'logbook_view',
            border: false,
            items: [
                {itemId: 'logbook_view', title: 'Logbook View', layout: 'fit', items: this.details.logbook_view}
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
                    height: 250,
                    minHeight: 250,
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

Ext.reg('module_user_logbook', Tracking.module.user_logbook);
/**
 * @class Tracking.module.faq_attachment
 * Module panel for table track_faq_attachment
 *
 * @since 29-10-2015 10:12:52
 * @author agung.hp
 */
Tracking.module.faq_attachment = Ext.extend(Webi.module.Panel, {
    addTitle: Tracking.properties.faq_attachment_addTitle,
    editTitle: Tracking.properties.faq_attachment_editTitle,
    winWidth:400,
    winHeight:217,
    /**
     * initComponent
     * @protected
     */
    initComponent : function() {
        // super
        Tracking.module.faq_attachment.superclass.initComponent.call(this);
    },
    buildPanel : function(){
        this.grid = new Tracking.grid.faq_attachment({border: false});
        this.initGridEvents();

        return this.grid;
    },
    buildForm : function(){
        this.form = new Tracking.form.faq_attachment();
		this.initFormEvents();
		
		
		return this.form;
    },
    
    onCreate: function(form, rec, type){
        this.uploadFile(form, rec, 'create');
	},
	
	onUpdate: function(form, rec, type){
        this.uploadFile(form, rec, 'update');
	},
	
	uploadFile: function(form, rec, type) {
	   
	    form.getForm().submit({
	        url: WS_URL + 'faq_attachment_controller/' + type,
	        waitMsg: 'Mengupload data...',
	        params: {
    			items: Ext.encode(rec.data)
	        },
            success: function(form, action) {
                this.hideActionProgress(action.result.type, true);
                
                if (action.result.type == 'create'){
                    var r = new this.grid.store.recordType(action.result.items);
                    this.grid.store.insert(0, r);
                    this.grid.store.commitChanges();
                    this.grid.pagingTb.updateInfo();
                    this.form.loadRecord(new this.grid.store.recordType(this.grid.getDefaultData()), 'create');
                    this.win.hide();
                }else{
                    this.win.hide();
                    this.grid.store.reload();
                }
            },
            failure: function(form, action) {
                this.hideActionProgress(action.result.type, false);
                switch (action.failureType) {
                     case Ext.form.Action.CLIENT_INVALID:
                         Ext.Msg.alert('Failure', 'Isian form masih belum benar');
                         break;
                     case Ext.form.Action.CONNECT_FAILURE:
                         Ext.Msg.alert('Failure', 'Komunikasi Ajax gagal. Mohon periksa koneksi jaringan anda');
                         break;
                     case Ext.form.Action.SERVER_INVALID:
                        Ext.Msg.alert('Failure', action.result.message);
                }
            },
            scope: this
	     });
	}
    
});

Ext.reg('module_faq_attachment', Tracking.module.faq_attachment);
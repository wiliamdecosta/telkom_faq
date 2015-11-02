Ext.ns('Webi.grid');
/**
 * TableEditor Grid
 */
Webi.grid.EditorGridPanel = Ext.extend(Ext.grid.EditorGridPanel, {
    width: 600,
    height: 400,
    pageSize: 50,
    viewConfig: {
        forceFit: true
    },
    batchWrite: false,
    initComponent : function() {

        // relay the Store's CRUD events into this grid so these events can be conveniently listened-to in our application-code.
        this.relayEvents(this.store, ['destroy', 'save', 'update']);

        // build toolbars and buttons.
        this.tbar = this.buildTopToolbar();
        this.bbar = this.buildBottomToolbar();

         // add a create event for convenience in our application-code.
        this.addEvents({
            /**
             * @event newitem
             * Fires when user clicks [add] button
             * @param {FormPanel} this
             * @param {Object} values, the Form's values object
             */
            newitem : true,
            /**
             * @event modifyitem
             * Fires when user clicks [edit] button
             * @param {FormPanel} this
             */
            modifyitem : true,
            beforenewitem : true
        });

        // super
        Webi.grid.EditorGridPanel.superclass.initComponent.call(this);
    
        this.getSelectionModel().on('selectionchange', function(sm, sel){
            //if (sel == null) return;
            
            if(this.enableEdit) {
            	if (!this.buttonModifyItem){
            	    this.buttonModifyItem = this.getTopToolbar().getComponent('buttonModifyItem');
            	}
            	if (this.buttonModifyItem.disabled){
            	    this.buttonModifyItem.enable();
            	}
        	}
            
            if(this.enableDelete) {
            	if (!this.buttonDelete){
            	    this.buttonDelete = this.getTopToolbar().getComponent('buttonDelete');
            	}
            	
            	if (this.buttonDelete.disabled){
            	    this.buttonDelete.enable();
            	}
        	}
        }, this);

        this.on('afteredit', function(e){
            if (this.batchWrite == false){
                if (this.getSaveButton().disabled) this.getSaveButton().enable();
            }else{
                if (!this.getSaveButton().disabled) this.getSaveButton().disable();
            }
        }, this);
        
    },
    getSaveButton: function(){
        if (!this.buttonSave){
            this.buttonSave = this.getTopToolbar().getComponent('buttonSave');
        }        
        return this.buttonSave;
    },
    
    /**
     * getDefaultData
     */
    getDefaultData: function(){
        var defaultData = {};
        return defaultData;
    }, 
    /**
     * buildTopToolbar
     */
    buildTopToolbar : function() {
        
        return [{
            itemId: 'buttonNewItem',
            text: 'Tambah',
            iconCls: 'icon-add',
            handler: this.onNewItem,
            scope: this
        }, '-',{
            itemId: 'buttonModifyItem',
            text: 'Edit',
            iconCls: 'icon-edit',
            handler: this.onModifyItem,
            disabled: true,
            scope: this
        }, '-', {
            itemId: 'buttonDelete',
            text: 'Hapus',
            iconCls: 'icon-delete',
            handler: this.onDelete,
            disabled: true,
            scope: this
        }, '->', {
            itemId: 'buttonSave',
            text: 'Simpan',
            iconCls: 'icon-save',
            handler: this.onSave,
            disabled: true,
            scope: this
        }];
    },

    /**
     * buildBottomToolbar
     */
    buildBottomToolbar : function() {
        return new Ext.PagingToolbar({
                pageSize: this.pageSize,
                store: this.store,
                displayInfo: true
            });
    },

    /**
     * onSave
     */
    onSave : function(btn, ev) {
        this.store.save();
    },    
    /**
     * onNewItem
     */
    onNewItem : function(btn, ev) {
        
        var doreq = this.fireEvent('beforenewitem', this, btn, ev);
        
        if (doreq !== false){
            var rec = new this.store.recordType(this.getDefaultData());
            
            this.stopEditing();
            this.store.insert(0, rec);
            
            var index = 1;
            if (!Ext.isEmpty(this.firstIndex)){
                index = this.getColumnModel().findColumnIndex(this.firstIndex);
                if (index == -1) index = 1;
            }

            this.startEditing(0, index);
        }
    },
    /**
     * onNewItem
     */
    onModifyItem : function(btn, ev) {
        var cell = this.getSelectionModel().getSelectedCell();
        if (cell == null) return
        
        this.stopEditing();
        this.startEditing(cell[0], cell[1]);
    },    
    /**
     * onDelete
     */
    onDelete : function(btn, ev) {
        /*var cell = this.getSelectionModel().getSelections();
        if (cell == null) return;

        var r = this.store.getAt(cell[0]);

        if (r.phantom){
            this.store.remove(r);
            return;
        }else{
            if (this.store.getModifiedRecords().length > 0){
                Ext.Msg.alert('Perhatian', 'Mohon simpan terlebih dahulu penambahan/perubahan data anda sebelum melakukan operasi hapus');
                return;
            }
        }

        var records = new Array();
        records.push(r);

        Ext.MessageBox.confirm('Konfirmasi', 'Apakah anda yakin akan menghapus data tersebut? ', function(btn){
            if (btn != 'yes') return;
            this.deleteRecords(records);
        }, this);*/
        
        var records = this.getSelectionModel().getSelections();
        if (records.length < 1) {
            return false;
        }
        
        Ext.MessageBox.confirm('Konfirmasi', 'Apakah anda yakin akan menghapus data tersebut?', function(btn){
            if (btn != 'yes') return;
            this.deleteRecords(records);
        }, this);
    },
    /**
     * deleteRecords
     */    
    deleteRecords : function(records){
        for (var i in records){
            this.store.remove(records[i]);
        }
        this.store.save();
        this.fireEvent('delete', this, this.store, records);
    },
    setBatchWriteMode: function(mode){
        this.batchWrite = mode;
    }
});
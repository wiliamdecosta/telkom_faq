/**
 * @class Humas.grid.Editor
 * Common Grid for Rid
 *
 * @author agung.hp
 * @since 25-May-10 4:26:16 PM
 */
Humas.grid.Editor = Ext.extend(Webi.grid.EditorGridPanel, {
    firstIndex: '',
    enableAdd: true,
    enableEdit: true,
    enableDelete: true,
	enableSave : true,
		
    initComponent : function() {
        // super
        Humas.grid.Editor.superclass.initComponent.call(this);
    },
    /**
     * buildTopToolbar
     */
    buildTopToolbar : function() {
        
        var tools = [];
        
        if (this.enableAdd === true){
            tools.push({
                itemId: 'buttonNewItem',
                text: 'Tambah',
                iconCls: 'icon-add',
                handler: this.onNewItem,
                scope: this
            });
        }

        if (this.enableEdit === true){
            if (tools.length > 1) tools.push('-');
            tools.push({
                itemId: 'buttonModifyItem',
                text: 'Edit',
                iconCls: 'icon-edit',
                handler: this.onModifyItem,
                disabled: true,
                scope: this
            });
        }
        
        if (this.enableDelete === true){
            if (tools.length > 1) tools.push('-');
            tools.push({
                itemId: 'buttonDelete',
                text: 'Hapus',
                iconCls: 'icon-delete',
                handler: this.onDelete,
                disabled: true,
                scope: this
            });
        }        

        if (tools.length > 1) tools.push('-');
        
        tools.push({
            itemId: 'btnReload',
            text: 'Reload',
            iconCls: 'x-tbar-loading',
            handler: function(){
                this.store.reload();
            },
            scope: this
        });
        
       if(this.enableSave === true) {
       		tools.push('->');
       		tools.push({
       		     itemId: 'buttonSave',
       		     text: 'Simpan',
       		     iconCls: 'icon-save',
       		     handler: this.onSave,
       		     disabled: true,
       		     scope: this
       		 });
    	}
        return tools;
    }
    
});
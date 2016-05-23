/**
 * @class Tracking.grid.user_logbook
 * Grid for table core_user
 *
 * @author wiliamdecosta@gmail.com
 * @since 22-01-2010 13:23:17
 */
Tracking.grid.user_logbook = Ext.extend(Webi.grid.GridPanel, {
    enableAdd:false,
    enableEdit:false,
    enableDelete:false,
    store: new Tracking.store.user(),
    initComponent : function() {
        var cbActiveStatus = new Tracking.combo.ActiveStatus();
        this.columns = [
            {
                header: Tracking.properties.user_id,
                dataIndex: 'user_id', sortable: true, hidden: true
            },
            {
                header: Tracking.properties.user_name,
                dataIndex: 'user_name', sortable: true, hidden: false
            },
            {
                header: Tracking.properties.user_email,
                dataIndex: 'user_email', sortable: true, hidden: false
            },
            {
                header: Tracking.properties.user_realname,
                dataIndex: 'user_realname', sortable: true, hidden: false
            },
            {
                header: Tracking.properties.user_status,
                dataIndex: 'user_status', sortable: true, hidden: false,
                renderer: Webi.format.comboRenderer(cbActiveStatus), width: 50
            }
        ];

        // super
        Tracking.grid.user_logbook.superclass.initComponent.call(this);
    },
    getDefaultData: function(){
        var defaultData = {
            'user_id': '',
            'user_name': '',
            'user_password': '',
            'user_email': '',
            'role_id': '',
            'user_realname': '',
            'user_status': ''
        };
        return defaultData;
    },

    buildTopToolbar : function() {
        var buttons = [];

        this.searchUser = new Ext.form.TextField({emptyText:'User/Nama User', width:150});
        this.searchUser.on('specialkey',this.onSearchText,this);

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
        buttons.push({xtype: 'tbtext', text: 'Cari :'});
        buttons.push(this.searchUser);
        buttons.push(' ');

        buttons.push({
            itemId: 'btnReset',
            text: 'Reset',
            handler: this.onReset,
            scope: this
        });

        return buttons;
    },

    getSearchParams:function() {
        var p = {};

        var searchUser = this.searchUser.getValue();

        if(!Ext.isEmpty(searchUser)) {
            p['searchUser'] = searchUser;
        }

        return p;
    },

    onSearchText: function(field, e) {
        if(e.getKey() == e.ENTER) {
            this.onSearch();
        }
    },

    onSearch: function() {
        this.store.baseParams = this.getSearchParams();
        this.store.load();
    },

    onReset: function() {
        this.resetFields();
        this.store.baseParams = {};
        this.store.load();
    },

    resetFields: function() {
        this.searchUser.reset();
    }
});
Ext.reg('grid_user_logbook', Tracking.grid.user_logbook);
/**
 * @class Bds.form.p_app_menu
 * Form panel for table bds_p_app_menu
 *
 * @since 23-10-2012 12:07:20
 * @author wiliamdecosta@gmail.com
 */
Base.form.menu = Ext.extend(Webi.form.FormPanel, {
    /**
     * initComponent
     * @protected
     */
    initComponent : function() {
        // super
        Base.form.menu.superclass.initComponent.call(this);
    },

    /**
     * buildform
     * @private
     */
    buildForm : function() {
        this.fields = {};
        
        
        this.fields.menu_id = new Ext.form.Hidden({fieldLabel: 'ID Menu', name: 'menu_id', allowBlank: true});

        this.fields.menu_pid = new Base.combo.menu({fieldLabel:'Parent Menu', name: 'menu_pid', allowBlank: true, width: 245, forceSelection: true});
        /* load record event */
        this.on('loadrecord', function(form, record, actionType){
            this.fields.menu_pid.store.baseParams.comboRequest = 'Y';
            if (actionType == 'update'){
                this.fields.menu_pid.getStore().load({params: {menu_pid:record.get('menu_pid')}});
                this.fields.menu_pid.disable();
            }else{
                delete this.fields.menu_pid.lastQuery;
                this.fields.menu_pid.doQuery('', true);
                
                this.fields.menu_pid.enable();
            }            
        }, this);
        
        
        this.fields.menu_code = new Ext.form.TextField({fieldLabel: 'Nama Menu', name: 'menu_code', allowBlank: false, anchor: '95%'});

        this.fields.menu_file_name = new Ext.form.TextField({fieldLabel: 'Nama File', name: 'menu_file_name', allowBlank: true, anchor: '95%'});

        this.fields.menu_listing_no = new Ext.form.NumberField({fieldLabel: 'No. Urut', name: 'menu_listing_no', allowBlank: false, allowDecimals: true, allowNegative: false, width:150});

        this.fields.menu_is_active = new Base.combo.YesNo({fieldLabel: 'Status Aktif', name: 'menu_is_active', allowBlank: true, width:100});

        this.fields.menu_description = new Ext.form.TextField({fieldLabel: 'Keterangan', name: 'menu_description', allowBlank: true, anchor: '95%'});

        
        return [
            this.fields.menu_id,
			this.fields.menu_pid,
			this.fields.menu_code,
			this.fields.menu_file_name,
			this.fields.menu_listing_no,
			this.fields.menu_is_active,
			this.fields.menu_description
        ];
    },
    focusField: function(){
    	this.fields.menu_code.focus();
    }
});

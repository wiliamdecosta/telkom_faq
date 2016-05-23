/**
 * @class Tracking.form.logbook
 * Form panel for table track_logbook
 *
 * @since 29-10-2015 10:12:52
 * @author agung.hp
 */
Tracking.form.logbook = Ext.extend(Webi.form.FormPanel, {
    /**
     * initComponent
     * @protected
     */
    initComponent : function() {
        // super
        Tracking.form.logbook.superclass.initComponent.call(this);
    },

    /**
     * buildform
     * @private
     */
    buildForm : function() {
        this.fields = {};


        this.fields.lbook_id = new Ext.form.Hidden({fieldLabel: Tracking.properties.lbook_id, name: 'mnt_det_id', allowBlank: true});

        this.fields.lbook_date = new Ext.form.DateField({fieldLabel: Tracking.properties.lbook_date, name: 'lbook_date', allowBlank: true, format: 'd-m-Y'});

        this.fields.lbook_type = new Tracking.combo.ActivityType({fieldLabel: Tracking.properties.lbook_type, name: 'lbook_type', allowBlank: true});

        this.fields.app_id = new Tracking.combo.application({name: 'app_id', allowBlank: true, width: 245});
        /* load record event */
        this.on('loadrecord', function(form, record, actionType){
            if (actionType == 'update'){
                this.fields.app_id.getStore().load({params: {app_id:record.get('app_id')}});
            }else{
                delete this.fields.app_id.lastQuery;
                this.fields.app_id.doQuery('', true);
            }
        }, this);

        this.fields.lbook_description = new Ext.form.TextArea({fieldLabel: 'Deskripsi', name: 'lbook_description', height: 140, allowBlank: true, anchor: '95%'});


        return [
            this.fields.lbook_id,
            this.fields.lbook_type,
            this.fields.app_id,
            this.fields.lbook_date,
            this.fields.lbook_description
        ];
    },
    focusField: function(){
        this.fields.lbook_id.focus();
    }
});

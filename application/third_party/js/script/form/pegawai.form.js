/**
 * @class App.form.pegawai
 * Form panel for table km_agama
 *
 * @since 5/14/2010 2:27:41 PM
 * @author wiliamdecosta@gmail.com
 */
App.form.pegawai = Ext.extend(Webi.form.FormPanel, {
    /**
     * initComponent
     * @protected
     */
    initComponent : function() {
        // super
        App.form.pegawai.superclass.initComponent.call(this);
    },

    /**
     * buildform
     * @private
     */
    buildForm : function() {
        
        this.fields = {};
        this.fields.peg_id = new Ext.form.Hidden({fieldLabel: App.properties.peg_id, name: 'peg_id', allowBlank: true});
        this.fields.peg_nik = new Ext.form.TextField({fieldLabel: App.properties.peg_nik, name:'peg_nik', anchor:'95%', allowBlank: false, maxLength:15});
        this.fields.peg_nama = new Ext.form.TextField({fieldLabel: App.properties.peg_nama, name:'peg_nama', anchor:'95%', allowBlank: false, maxLength:50});
        
        this.fields.agama_id = new App.combo.agama({fieldLabel: App.properties.agama_nama, name:'agama_id', anchor:'95%'});
        this.fields.agama_id.on('select', function(cb, rec, idx){
		    this.record.data['agama_id_blank'] = rec.get('_combo_display');
		}, this);

		/* load record event */
		this.on('loadrecord', function(form, record, actionType){
		    if (actionType == 'update'){
		        this.fields.agama_id.store.load({params: {agama_id:record.get('agama_id')}});
		    }else{
		        delete this.fields.agama_id.lastQuery;
		        this.fields.agama_id.doQuery('', true);
		    }
		}, this);
		
		this.fields.peg_tgl_lahir = new Ext.form.DateField({fieldLabel: App.properties.peg_tgl_lahir, name: 'peg_tgl_lahir', format: 'd-m-Y'});
		this.fields.peg_alamat = new Ext.form.TextArea({fieldLabel: App.properties.peg_alamat, name:'peg_alamat', anchor:'95%'});
        
        return [
        	this.fields.peg_id,
        	this.fields.peg_nik,
        	this.fields.peg_nama,
        	this.fields.agama_id,
        	this.fields.peg_tgl_lahir,
        	this.fields.peg_alamat
		];
    },
    
    focusField: function(){
    	this.fields.peg_id.focus();
    }
});

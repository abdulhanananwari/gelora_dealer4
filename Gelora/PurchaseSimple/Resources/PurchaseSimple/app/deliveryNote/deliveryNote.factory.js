geloraPurchaseSimple
	.factory('DeliveryNoteFactory', function() {

		var deliveryNoteFactory = {}

		deliveryNoteFactory.validateLoadSuratJalan = function(unit){
			
			if (_.isEmpty(unit.type_code)) {
				return unit.status = 'kode type kosong'
			}
			if (_.isEmpty(unit.type_name)) {
				return unit.status = 'Nama type kosong'
			}
			if (_.isEmpty(unit.color_code)) {
				return unit.status = 'kode warna kosong'
			}
			if (_.isEmpty(unit.color_name)) {
				return unit.status = 'Nama warna kosong'
			}
			if (_.isEmpty(unit.engine_number)) {
				return unit.status = 'Nomer mesin kosong'
			}
			if (_.isEmpty(unit.chasis_number)) {
				return unit.status = 'Nomer rangka kosong'
			}
			if (_.isEmpty(unit.nd_number)) {
				return unit.status = 'Nomer Nota Debet kosong'
			}
			if (_.isEmpty(unit.sj_number)) {
				return unit.status = 'Nomer Surat Jalan kosong'
			}
			else {

				return unit.status = 'Ready'
			}	
		}
		
		return deliveryNoteFactory

	})
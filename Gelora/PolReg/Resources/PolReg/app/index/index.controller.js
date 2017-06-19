geloraPolReg
	.controller('IndexController', function() {

		var vm = this

		vm.links = {
			sj_pending_faktur : JSON.stringify({
				used_faktur_detail_id: 'null',
				with: 'fakturDetails'
			})
		}
	})
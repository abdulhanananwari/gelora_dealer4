geloraPolReg
	.controller('MdSubmissionBatchIndexController', function(
		$state,
		MdSubmissionBatchModel) {

		var vm = this

		vm.statuses = {
			'active': 'Masih Aktif',
			'closed': 'Sudah Ditutup',
			'all': 'Semua'
		}

		vm.filter = {
			paginate: 20		
		}

		vm.load = function(page) {

			if (page) {
				vm.filter.page
			}

			MdSubmissionBatchModel.index(vm.filter)
			.then(function(res) {

				vm.registrationBatches = res.data.data
				vm.meta = res.data.meta
			})
		}
		vm.load()
})
geloraHumanResource
	.controller('PersonnelIndexController', function(
		$state,
		PersonnelModel) {

		var vm = this

		PersonnelModel.index()
		.then(function(res) {
			vm.personnels = res.data.data
		})
		
	})
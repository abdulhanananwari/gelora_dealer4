geloraHumanResource
	.controller('TeamIndexController', function(
		TeamModel) {

		var vm = this

		TeamModel.index()
		.then(function(res) {
			vm.teams = res.data.data
		})
	})
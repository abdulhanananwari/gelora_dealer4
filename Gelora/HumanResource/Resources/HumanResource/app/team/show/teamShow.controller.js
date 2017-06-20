geloraHumanResource
	.controller('TeamShowController', function(
		$state,
		TeamModel, PersonnelModel,
		ConfigModel) {

		var vm = this
		
		vm.store = function(team) {

			if (team.id) {

				TeamModel.update(team.id, team)
				.then(function(res) {
					vm.team = res.data.data
				})

			} else {

				TeamModel.store(team)
				.then(function(res) {
					$state.go('teamShow', {id: res.data.data.id})
					vm.team = res.data.data
				})
			}
		}
		
		ConfigModel.get('gelora.humanResource.availablePositions')
		.then(function(res) {
			vm.availablePositions = res.data.data
		})

		if ($state.params.id) {

			TeamModel.get($state.params.id)
			.then(function(res) {
				vm.team = res.data.data
			})

			PersonnelModel.index({team_id: $state.params.id})
			.then(function(res) {
				vm.personnels = res.data.data
			})
		}
	})
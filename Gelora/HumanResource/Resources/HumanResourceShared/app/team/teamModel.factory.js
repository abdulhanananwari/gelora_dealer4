geloraHumanResourceShared
	.factory('TeamModel', function(
		$http,
		LinkFactory) {

		var teamModel = {}

		teamModel.index = function(params) {
			return $http.get(LinkFactory.dealer.humanResource.team.base, {params: params})
		}

		teamModel.get = function(id, params) {
			return $http.get(LinkFactory.dealer.humanResource.team.base + id, {params: params})
		}

		teamModel.store = function(team) {
			return $http.post(LinkFactory.dealer.humanResource.team.base, team)
		}

		teamModel.update = function(id, team) {
			return $http.post(LinkFactory.dealer.humanResource.team.base + id, team)
		}

		return teamModel
		
	})
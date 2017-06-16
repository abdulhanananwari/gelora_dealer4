geloraBase
	.controller('LocationIndexController', function(
	LocationModel) {

		var vm = this

		LocationModel.index()
		.then(function(res) {

			vm.locations = res.data.data
		})

	})
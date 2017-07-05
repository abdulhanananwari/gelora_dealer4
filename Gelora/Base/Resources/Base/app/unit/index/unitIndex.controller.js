// geloraBase
// 	.controller('UnitIndexController', function(
// 		UnitModel) {

// 		var vm = this;

// 		vm.filter ={
// 			paginate:20,
// 		}
		
// 		vm.get = function (unit) {
// 			UnitModel.index(vm.filter)
// 			.then(function(res) {

// 				vm.units = res.data.data;
// 				vm.meta = res.data.meta;
// 			})
// 		}
// 		vm.get();

// 	})
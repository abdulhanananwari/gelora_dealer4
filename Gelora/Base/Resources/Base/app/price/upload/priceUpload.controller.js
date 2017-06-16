geloraBase
	.controller('PriceUploadController', function(
		CsvUploader,
		PriceModel, ModelModel) {

		var vm = this

		ModelModel.index({current: true})
		.then(function(res) {
			vm.models = res.data.data
		})

        vm.loadFile = function() {

        	CsvUploader.parse(document.getElementById('csv-file').files[0], {delimiter: ','})
        	.then(function(data) {
        		processData(data.data)
        	})
        }

        vm.uploadAll = function() {

        	CsvUploader.upload(vm.prices, {upload: upload})
        }

        vm.remove = function(price) {
        	_.remove(vm.prices, price)
        }

        function processData(data) {

    		PriceModel.index({model_ids: _.uniq(_.flatMap(data, 'model_id')).join(',') })
    		.then(function(res) {
    			

    			var existingPrices = res.data.data

    			_.each(data, function(newPrice) {

    				_.forOwn(newPrice, function(value, key) {
    					if (value == 'UNCHANGED') {
    						_.unset(newPrice, key)
    					}
    				})

    				newPrice.existingPrice = _.find(existingPrices, function(existingPrice) {
    					return existingPrice.model_id == newPrice.model_id
    				})

    				newPrice.model = _.find(vm.models, function(model) {
    					return model.id == newPrice.model_id
    				})

    				if (typeof newPrice.model != 'undefined') {
    					newPrice.model_name = newPrice.model.name
    					newPrice.model_code = newPrice.model.code
    				}

                    // Cari extras dan simopan
                    _.each(_.keys(newPrice), function(key) {
                        if (key.indexOf('.') !== -1 && key.split('.')[0] == 'extra') {

                            if (typeof newPrice.extras == 'undefined') {
                                newPrice.extras = []
                            }

                            newPrice.extras.push({
                                note: key.split('.')[1],
                                amount: parseInt(newPrice[key])
                            })

                            _.unset(newPrice, key)
                        }
                    })

    				newPrice.status = 'Ready'
                    console.log(newPrice)
    			})

    			vm.prices = data

    		})

        }

        var upload = function(price) {

        	if (typeof price.existingPrice == 'undefined') {
        		
				return PriceModel.store(price)
				.then(function(res) {
					price.status = 'Berhasil Disimpan'
				})

			} else {

				return PriceModel.update(price.model_id, price)
				.then(function(res) {

					price.status = 'Berhasil Diupdate'
				})
				
        	}
        }

	})
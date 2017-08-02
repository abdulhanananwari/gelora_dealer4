geloraSalesShared
    .factory('SalesOrderModel', function(
        $http, JwtValidator,
        LinkFactory) {

        var salesOrder = []

        salesOrder.index = function(params) {
            return $http.get(LinkFactory.dealer.sales.salesOrder.base, { params: params })
        }

        salesOrder.get = function(id, params) {
            return $http.get(LinkFactory.dealer.sales.salesOrder.base + id, { params: params })
        }

        salesOrder.store = function(salesOrder, params) {
            return $http.post(LinkFactory.dealer.sales.salesOrder.base, salesOrder, { params: params })
        }

        salesOrder.update = function(id, salesOrder, params) {
            return $http.post(LinkFactory.dealer.sales.salesOrder.base + id, salesOrder, { params: params })
        }

        salesOrder.calculate = function(id) {
            return $http.post(LinkFactory.dealer.sales.salesOrder.base + id + '/calculate')
        }

        salesOrder.specificUpdate = {
            deliveryRequest: function(id, salesOrder, params) {
                return $http.post(LinkFactory.dealer.sales.salesOrder.base + id + '/specific-update/delivery-request/', salesOrder, { params: params })
            },
            registration: function(id, salesOrder, params) {
                return $http.post(LinkFactory.dealer.sales.salesOrder.base + id + '/specific-update/registration/', salesOrder, { params: params })
            },
            price: function(id, salesOrder, params) {
                return $http.post(LinkFactory.dealer.sales.salesOrder.base + id + '/specific-update/price/', salesOrder, { params: params })
            },
            plafond: function(id, salesOrder, params) {
                return $http.post(LinkFactory.dealer.sales.salesOrder.base + id + '/specific-update/plafond/', salesOrder, { params: params })
            },
            polReg: function(id, polReg, params) {
                return $http.post(LinkFactory.dealer.sales.salesOrder.base + id + '/specific-update/pol-reg/', polReg, { params: params })
            },
            insertNote: function(id, note, params) {
                return $http.post(LinkFactory.dealer.sales.salesOrder.base + id + '/specific-update/note/', note, { params: params })
            },
            deleteCustomerInvoice: function(id, params) {
                return $http.delete(LinkFactory.dealer.sales.salesOrder.base + id + '/specific-update/customer-invoice/', {}, { params: params })
            },
            mediatorFeePayment: function(id, body) {
                return $http.post(LinkFactory.dealer.sales.salesOrder.base + id + '/specific-update/mediator-fee-payment/', body)
            },
        }

        salesOrder.leasingOrder = {
            update: function(id, leasingOrder, params) {
                return $http.post(LinkFactory.dealer.sales.salesOrder.base + id + '/leasing-order/', leasingOrder , { params: params })
            },
            updateAfterValidation: function(id, leasingOrder) {
                return $http.post(LinkFactory.dealer.sales.salesOrder.base + id + '/leasing-order/after-validation', leasingOrder)
            },

            mainReceivablePayment: function(id, leasingOrder) {
                return $http.post(LinkFactory.dealer.sales.salesOrder.base + id + '/leasing-order/main-receivable-payment', leasingOrder)
            },
            joinPromoPayment: function(id, joinPromos, transaction) {
                return $http.post(LinkFactory.dealer.sales.salesOrder.base + id + '/leasing-order/join-promo-payment', {joinPromos: joinPromos, transaction: transaction})
            },
            assignFromLeasingOrder: function(id, leasingOrderId, params) {
                return $http.post(LinkFactory.dealer.sales.salesOrder.base + id + '/leasing-order/assign-from-leasing-order/', { leasing_order_id: leasingOrderId }, { params: params })
            },
            orderConfirmation: function(id, body) {
                return $http.post(LinkFactory.dealer.sales.salesOrder.base + id + '/leasing-order/order-confirmation/', body)
            },
            poComplete: function(id, body) {
                return $http.post(LinkFactory.dealer.sales.salesOrder.base + id + '/leasing-order/po-complete/', body)
            }
        }

        salesOrder.cddb = {
            update: function(id, cddb, params) {
                return $http.post(LinkFactory.dealer.sales.salesOrder.base + id + '/cddb/', { cddb: cddb }, { params: params })
            },
        }

        salesOrder.delivery = {
            generate: function(id, unit) {
                return $http.post(LinkFactory.dealer.sales.salesOrder.base + id + '/delivery/generate/', { unit_id: unit.id })
            },
            update: function(id, delivery) {
                return $http.post(LinkFactory.dealer.sales.salesOrder.base + id + '/delivery/', delivery)
            },
            updateAfterHandoverCreated: function(id, delivery) {
                return $http.post(LinkFactory.dealer.sales.salesOrder.base + id + '/delivery/after-handover-created/', delivery)
            },
            scan: function(id, unit) {
                return $http.post(LinkFactory.dealer.sales.salesOrder.base + id + '/delivery/scan/', { unit_id: unit.id })
            },
            travelStart: function(id) {
                return $http.post(LinkFactory.dealer.sales.salesOrder.base + id + '/delivery/travel-start/')
            },
            handover: function(id, handover, params) {
                return $http.post(LinkFactory.dealer.sales.salesOrder.base + id + '/delivery/handover/', { handover: handover }, { params: params })
            },
            handoverConfirmation: function(id, handoverConfirmation, params) {
                return $http.post(LinkFactory.dealer.sales.salesOrder.base + id + '/delivery/handover-confirmation/', { handoverConfirmation: handoverConfirmation }, { params: params })
            },
            cancel: function(id, salesOrder, params) {
                return $http.post(LinkFactory.dealer.sales.salesOrder.base + id + '/delivery/cancel/', salesOrder, { params: params })
            }
        }

        salesOrder.polReg = {
            update: function(id, polReg, params) {
                return $http.post(LinkFactory.dealer.sales.salesOrder.base + id + '/pol-reg/', polReg, { params: params })
            },
            item: {
                incoming: function(id, item, params) {
                    return $http.post(LinkFactory.dealer.sales.salesOrder.base + id + '/pol-reg/item/incoming/', item, { params: params })
                },
                outgoing: function(id, item, params) {
                    return $http.post(LinkFactory.dealer.sales.salesOrder.base + id + '/pol-reg/item/outgoing/', item, { params: params })
                }
            },
            cost: {
                store: function(id, cost, params) {
                    return $http.post(LinkFactory.dealer.sales.salesOrder.base + id + '/pol-reg/cost/', cost, { params: params })
                }
            },
            generateStrings: function(id, salesOrder, params) {
                return $http.post(LinkFactory.dealer.sales.salesOrder.base + id + '/pol-reg/generate-strings/', salesOrder, { params: params })
            },
            batch: {
                store: function(id, batch, params) {
                    return $http.post(LinkFactory.dealer.sales.salesOrder.base + id + '/pol-reg/add-batch/', { batch: batch }, { params: params })
                },
                remove: function(id, batch, params) {
                    return $http.post(LinkFactory.dealer.sales.salesOrder.base + id + '/pol-reg/remove-batch/', { batch: batch }, { params: params })
                }
            }
        }
        salesOrder.document = {
            spk: {
                generate: function(id) {
                    return $http.post(LinkFactory.dealer.sales.salesOrder.base + id + '/document/spk/generate')
                },
                email: function(id) {
                    return $http.post(LinkFactory.dealer.sales.salesOrder.base + id + '/document/spk/email')
                }
            }
        }

        salesOrder.unit = {
            deselect: function(id, params) {
                return $http.post(LinkFactory.dealer.sales.salesOrder.base + id + '/unit/deselect/', {}, { params: params })
            }
        }

        salesOrder.action = {
            lock: {
                request: function(id) {
                    return $http.post(LinkFactory.dealer.sales.salesOrder.base + id + '/action/lock/request/')
                },
                lock: function(id) {
                    return $http.post(LinkFactory.dealer.sales.salesOrder.base + id + '/action/lock/lock/')
                },
                unlock: function(id) {
                    return $http.post(LinkFactory.dealer.sales.salesOrder.base + id + '/action/lock/unlock/')
                },
            },
            validation: {
                validate: function(id, body) {
                    return $http.post(LinkFactory.dealer.sales.salesOrder.base + id + '/action/validation/validate/', body)
                },
                unvalidate: function(id) {
                    return $http.post(LinkFactory.dealer.sales.salesOrder.base + id + '/action/validation/unvalidate/')
                }
            },
            indent: {
                indent: function(id, note) {
                    return $http.post(LinkFactory.dealer.sales.salesOrder.base + id + '/action/indent/indent', { note: note })
                },
            },
            financial: {
                close: function(id, salesOrder) {
                    return $http.post(LinkFactory.dealer.sales.salesOrder.base + id + '/action/financial/close', salesOrder)
                }
            }
        }

        return salesOrder
    })

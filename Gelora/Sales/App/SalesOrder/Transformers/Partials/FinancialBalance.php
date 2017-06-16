<?php

namespace Gelora\Sales\App\SalesOrder\Transformers\Partials;

use League\Fractal;
use Gelora\Sales\App\SalesOrder\SalesOrderModel;

class FinancialBalance extends Fractal\TransformerAbstract {
    
    /*
     * Data returned:
     * grand_total
     * otr_difference_with_selected_leasing_order
     * price_difference_with_master
     * receivable
     * total_sales_order
     * total_sales_order_extras
     */
    
    public static function transform (SalesOrderModel $salesOrder) {
        
        $x = $salesOrder->calculate()->subBalance()->salesOrderAndExtras();
        
        /*
         * Kalau selectedLeasingOrder di load, sekalian hitung sisa piutang
         */
        if (strpos(request()->get('with'), 'selectedLeasingOrder') !== false || strpos(request()->get('include'), 'selectedLeasingOrder') !== false) {
            $x = (array) $x + (array) $salesOrder->calculate()->subBalance()->leasingOrder();
        }
        
        /*
         * Kalau price di load, sekalian hitung selisih OTR
         */
        if (strpos(request()->get('with'), 'price') !== false || strpos(request()->get('include'), 'price') !== false) {
            $x = array_merge($x, $salesOrder->calculate()->subBalance()->priceDifferences());
        }
        
        return $x;
    }
}

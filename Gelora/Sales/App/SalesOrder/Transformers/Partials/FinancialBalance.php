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
        
        $data = $salesOrder->calculate()->subBalance()->salesOrderAndExtras();
        
        if ($salesOrder->payment_type == 'credit') {
            $data = array_merge($data, $salesOrder->calculate()->subBalance()->leasingOrder());
        }
        
        
        /*
         * Kalau price di load, sekalian hitung selisih OTR
         */
        if (strpos(request()->get('with'), 'price') !== false || strpos(request()->get('include'), 'price') !== false) {
            $data = array_merge($data, $salesOrder->calculate()->subBalance()->priceDifferences());
        }
        
        return $data;
    }
}

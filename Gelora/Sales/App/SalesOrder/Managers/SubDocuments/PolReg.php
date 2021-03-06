<?php

namespace Gelora\Sales\App\SalesOrder\Managers\SubDocuments;

use Solumax\PhpHelper\App\Mongo\SubDocument;
use Gelora\Sales\App\SalesOrder\SalesOrderModel;

class PolReg {

    protected $salesOrder;

    public function __construct(SalesOrderModel $salesOrder) {
        $this->salesOrder = $salesOrder;
    }

    public function retrieve() {
        $subdoc = new SubDocument($this->salesOrder->polReg);
        $subdoc = $this->formatItems($subdoc);
        $subdoc = $this->formatCosts($subdoc);
        return $subdoc;
    }

    protected function formatItems($subdoc) {

        $defaultItems = config('gelora.polReg.defaultItems');
        $items = [];

        foreach ($defaultItems as $item) {
            if (isset($subdoc->items[$item])) {
                $items[$item] = $subdoc->items[$item];
                unset($subdoc->items[$item]);
            } else {
                $items[$item] = [
                    'name' => $item
                ];
            }
        }

        if (is_array($subdoc->items)) {
            foreach ($subdoc->items as $additionalItem) {
                $items[$additionalItem['name']] = $additionalItem;
            }
        }

        $subdoc->items = $items;

        return $subdoc;
    }


    protected function formatCosts($subdoc) {

        $defaultCosts = config('gelora.polReg.defaultCosts');
        $costs = [];

        foreach ($defaultCosts as $cost) {
            if (isset($subdoc->costs[$cost])) {
                $costs[$cost] = $subdoc->costs[$cost];
                unset($subdoc->costs[$cost]);
            } else {
                $costs[$cost] = [
                    'name' => $cost
                ];
            }
        }

        if (is_array($subdoc->costs)) {
            foreach ($subdoc->costs as $additionalItem) {
                $costs[$additionalItem['name']] = $additionalItem;
            }
        }

        $subdoc->costs = $costs;

        return $subdoc;
    }

}

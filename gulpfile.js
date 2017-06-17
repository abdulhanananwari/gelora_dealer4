process.env.DISABLE_NOTIFIER = true;
const elixir = require('laravel-elixir');

/*
 |--------------------------------------------------------------------------
 | Elixir Asset Management
 |--------------------------------------------------------------------------
 |
 | Elixir provides a clean, fluent API for defining some basic Gulp tasks
 | for your Laravel application. By default, we are compiling the Sass
 | file for your application as well as publishing vendor resources.
 |
 */

elixir((mix) => {
    
    mix.scriptsIn('Gelora/Base/Resources/Base', 'public/gelora/base/app/all.js');
    mix.copy('Gelora/Base/Resources/Base', 'public/gelora/base');
    
    mix.scriptsIn('Gelora/Base/Resources/BaseShared', 'public/gelora/base-shared/app/all.js');
    mix.copy('Gelora/Base/Resources/BaseShared', 'public/gelora/base-shared');
    
    mix.scriptsIn('Gelora/InventoryManagement/Resources/InventoryManagement', 'public/gelora/inventory-management/app/all.js');
    mix.copy('Gelora/InventoryManagement/Resources/InventoryManagement', 'public/gelora/inventory-management');

    mix.scriptsIn('Gelora/Purchase/Resources/Purchase', 'public/gelora/purchase/app/all.js');
    mix.copy('Gelora/Purchase/Resources/Purchase', 'public/gelora/purchase');
    
    mix.scriptsIn('Gelora/PurchaseSimple/Resources/PurchaseSimple', 'public/gelora/purchase-simple/app/all.js');
    mix.copy('Gelora/PurchaseSimple/Resources/PurchaseSimple', 'public/gelora/purchase-simple');
    
    mix.scriptsIn('Gelora/Sales/Resources/SalesAdmin', 'public/gelora/sales/admin/app/all.js');
    mix.copy('Gelora/Sales/Resources/SalesAdmin', 'public/gelora/sales/admin');

    mix.scriptsIn('Gelora/Sales/Resources/SalesPersonnel', 'public/gelora/sales/personnel/app/all.js');
    mix.copy('Gelora/Sales/Resources/SalesPersonnel', 'public/gelora/sales/personnel');

    mix.scriptsIn('Gelora/Sales/Resources/Delivery', 'public/gelora/sales/delivery/app/all.js');
    mix.copy('Gelora/Sales/Resources/Delivery', 'public/gelora/sales/delivery');
    
    mix.scriptsIn('Gelora/Sales/Resources/SalesShared', 'public/gelora/sales-shared/app/all.js');
    mix.copy('Gelora/Sales/Resources/SalesShared', 'public/gelora/sales-shared');

    mix.scriptsIn('Gelora/HumanResource/Resources/HumanResource', 'public/gelora/human-resource/app/all.js');
    mix.copy('Gelora/HumanResource/Resources/HumanResource', 'public/gelora/human-resource');

    mix.scriptsIn('Gelora/HumanResource/Resources/HumanResourceShared', 'public/gelora/human-resource-shared/app/all.js');
    mix.copy('Gelora/HumanResource/Resources/HumanResourceShared', 'public/gelora/human-resource-shared');

    mix.scriptsIn('Gelora/CreditSales/Resources/CreditSales', 'public/gelora/credit-sales/app/all.js');
    mix.copy('Gelora/CreditSales/Resources/CreditSales', 'public/gelora/credit-sales');

    mix.scriptsIn('Gelora/CreditSales/Resources/LeasingApp', 'public/gelora/credit-sales-leasing-app/app/all.js');
    mix.copy('Gelora/CreditSales/Resources/LeasingApp', 'public/gelora/credit-sales-leasing-app');

    mix.scriptsIn('Gelora/CreditSales/Resources/CreditSalesShared', 'public/gelora/credit-sales-shared/app/all.js');
    mix.copy('Gelora/CreditSales/Resources/CreditSalesShared', 'public/gelora/credit-sales-shared');
    
    mix.scriptsIn('Gelora/Delivery/Resources/Delivery', 'public/gelora/delivery/app/all.js');
    mix.copy('Gelora/Delivery/Resources/Delivery', 'public/gelora/delivery');

    mix.scriptsIn('Gelora/Delivery/Resources/DeliveryShared', 'public/gelora/delivery-shared/app/all.js');
    mix.copy('Gelora/Delivery/Resources/DeliveryShared', 'public/gelora/delivery-shared'););    

    mix.scriptsIn('Gelora/PolReg/Resources/PolReg', 'public/gelora/pol-reg/app/all.js');
    mix.copy('Gelora/PolReg/Resources/PolReg', 'public/gelora/pol-reg');

    mix.scriptsIn('Gelora/PolReg/Resources/PolRegShared', 'public/gelora/pol-reg-shared/app/all.js');
    mix.copy('Gelora/PolReg/Resources/PolRegShared', 'public/gelora/pol-reg-shared');

    
    mix.scriptsIn('resources/angular', 'public/solumax/dependencies/all.js');

});

<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    return view('homepage');
});

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');

Route::prefix('pm')->group(function(){
	Route::get('/login','Auth\PMLoginController@showPMLogin')->name('pm.login');
	Route::post('/login','Auth\PMLoginController@PMlogin')->name('pm.login.submit');
	Route::get('/','PM\PMController@index')->name('pm.home');
		//////////////////////////////////////////////
	//UTILITIES
	Route::resource('/pmutilities','PM\UtilitiesController');
	//companyinfo
	Route::get('/companyinfo','PM\UtilitiesController@companyinfo')->name('pm.utilities.companyinfo');
	//smartcounter
	// Route::post('/addEmpID','PM\UtilitiesController@storeEmpID');
	Route::post('/addClientID','PM\UtilitiesController@storeClientID');
	Route::post('/addContractID','PM\UtilitiesController@storeContractID');
	Route::post('/addInvoiceID','PM\UtilitiesController@storeInvoiceID');
	Route::post('/addOrID','PM\UtilitiesController@storeOrID');
	Route::get('/smartcounter','PM\UtilitiesController@smartcounter')->name('pm.utilities.smartcounter');
	//rate
	Route::resource('/pmrate','PM\RateUtilController');
	Route::put('/pmrate/checkbox/{id}', 'PM\RateUtilController@checkbox');
	Route::put('/pmrate/{id}/delete ','PM\RateUtilController@delete')->name('pm.utilities.rate.del');
	//miscellaneous
	Route::resource('/pmmisc','PM\MiscUtilController');
	Route::put('/pmmisc/checkbox/{id}', 'PM\MiscUtilController@checkbox');
	Route::put('/pmmisc/{id}/delete ','PM\MiscUtilController@delete')->name('pm.utilities.misc.del');
	//additional fee
	Route::resource('/pmfee','PM\FeeUtilController');
	Route::put('/pmfee/checkbox/{id}', 'PM\FeeUtilController@checkbox');
	Route::put('/pmfee/{id}/delete ','PM\FeeUtilController@delete')->name('pm.utilities.fee.del');
	
	//tax
	Route::resource('/pmtax','PM\TaxUtilController');
	Route::put('/pmtax/checkbox/{id}', 'PM\TaxUtilController@checkbox');
	Route::put('/pmtax/{id}/delete ','PM\TaxUtilController@delete')->name('pm.utilities.tax.del');
	//retention
	Route::resource('/pmretention','PM\RetentionUtilController');
	Route::put('/pmretention/checkbox/{id}', 'PM\RetentionUtilController@checkbox');
	Route::put('/pmretention/{id}/delete ','PM\RetentionUtilController@delete')->name('pm.utilities.retention.del');
	//recoupment
	Route::resource('/pmrecoupment','PM\RecoupmentUtilController');
	Route::put('/pmrecoupment/checkbox/{id}', 'PM\RecoupmentUtilController@checkbox');
	Route::put('/pmrecoupment/{id}/delete ','PM\RecoupmentUtilController@delete')->name('pm.utilities.recoupment.del');
	//mode of payment
	Route::resource('/pmpaymentmode','PM\PaymentModeUtilController');
	Route::put('/pmpaymentmode/checkbox/{id}', 'PM\PaymentModeUtilController@checkbox');
	Route::put('/pmpaymentmode/{id}/delete ','PM\PaymentModeUtilController@delete')->name('pm.utilities.mode.del');
	////////////////////////////////////////////////////////
	//Client
	Route::resource('/client','PM\ClientController');
	//Setup Contract
	Route::resource('/setup','PM\SetupContractController');
	Route::get('/setup/findTaskbyService/{id}','PM\SetupContractController@findTaskbyService');
	Route::get('/setup/findTaskbyNone','PM\SetupContractController@findTaskbyNone');
	Route::get('/setup/getTaskPrice/{id}','PM\SetupContractController@getTaskPrice');
	Route::get('/setup/getTask/{id}','PM\SetupContractController@getTask');
	Route::get('/setup/getExpPrice/{id}','PM\SetupContractController@getExpPrice');
	Route::get('/setup/getMisc/{id}','PM\SetupContractController@getMisc');
	Route::get('/setup/getRateValue/{id}','PM\SetupContractController@getRateValue');
	Route::get('/setup/getRate/{id}','PM\SetupContractController@getRate');

	Route::resource('/contract','PM\ContractController');
	Route::get('/readByAjax30','PM\ContractController@readByAjax');
	Route::get('/contract/findTaskbyService/{id}','PM\ContractController@findTaskbyService');
	Route::get('/contract/findTaskbyNone','PM\ContractController@findTaskbyNone');
	Route::get('/contract/getTaskPrice/{id}','PM\ContractController@getTaskPrice');
	Route::post('/contract/storeTask/{id}','PM\ContractController@storeTask')->name('pm.storeTask');
	Route::get('/contract/getNewTaskJob/{id}','PM\ContractController@getNewTaskJob')->name('pm.getNewTaskJob');
	Route::post('/contract/newJob/{id}','PM\ContractController@newJob');
	Route::get('/contract/getNewTaskMat/{id}','PM\ContractController@getNewTaskMat')->name('pm.getNewTaskMat');
	Route::get('/contract/getTaskMatPrice/{id}','PM\ContractController@getTaskMatPrice')->name('pm.getTaskMatPrice');
	Route::post('/contract/newMat/{id}','PM\ContractController@newMat');
	Route::get('/contract/getTaskEPrice/{id}','PM\ContractController@getTaskEPrice')->name('pm.getTaskEPrice');
	Route::post('/contract/newEquip/{id}','PM\ContractController@newEquip');
	Route::post('/contract/newMisc/{id}','PM\ContractController@newMisc');
	Route::post('/contract/newExp/{id}','PM\ContractController@newExp');
	Route::get('/contract/findFee/{id}','PM\ContractController@findFee')->name('pm.findFee');
	Route::get('/contract/findRPD/{id}','PM\ContractController@findRPD')->name('pm.findRPD');
	Route::post('/contract/turnover/{id}','PM\ContractController@turnover');
	Route::post('/contract/closing/{id}','PM\ContractController@closing');
	Route::get('/contract/updateHistory/{id}','PM\ContractController@updateHistory');
	Route::get('/contract/printTurnover/{id}','PM\ContractController@printTurnoverReport')->name('pm.printTurnover');

	Route::resource('/progressreport','PM\ProgressReportController');
	Route::post('/progressreport/printProgress','PM\ProgressReportController@printProgress');
	Route::resource('/stockusagereport','PM\StockReportController');
	Route::post('/stockusagereport/printStockUsage','PM\StockReportController@printStockUsage');



});

Route::prefix('bd')->group(function(){
	Route::get('/login','Auth\BDLoginController@showBDLogin')->name('bd.login');
	Route::post('/login','Auth\BDLoginController@BDlogin')->name('bd.login.submit');
	Route::get('/','BD\BDController@index')->name('bd.home');
	//////////////////////////////////////////////
	//UTILITIES
	Route::resource('/bdutilities','BD\UtilitiesController');

	//companyinfo
	Route::get('/companyinfo','BD\UtilitiesController@companyinfo')->name('bd.utilities.companyinfo');
	//smartcounter
	// Route::post('/addEmpID','BD\UtilitiesController@storeEmpID');
	Route::post('/addClientID','BD\UtilitiesController@storeClientID');
	Route::post('/addContractID','BD\UtilitiesController@storeContractID');
	Route::post('/addInvoiceID','BD\UtilitiesController@storeInvoiceID');
	Route::post('/addOrID','BD\UtilitiesController@storeOrID');
	Route::get('/smartcounter','BD\UtilitiesController@smartcounter')->name('bd.utilities.smartcounter');
	//rate
	Route::resource('/bdrate','BD\RateUtilController');
	Route::put('/bdrate/checkbox/{id}', 'BD\RateUtilController@checkbox');
	Route::put('/bdrate/{id}/delete ','BD\RateUtilController@delete')->name('bd.utilities.rate.del');
	//miscellaneous
	Route::resource('/bdmisc','BD\MiscUtilController');
	Route::put('/bdmisc/checkbox/{id}', 'BD\MiscUtilController@checkbox');
	Route::put('/bdmisc/{id}/delete ','BD\MiscUtilController@delete')->name('bd.utilities.misc.del');
	//additional fee
	Route::resource('/bdfee','BD\FeeUtilController');
	Route::put('/bdfee/checkbox/{id}', 'BD\FeeUtilController@checkbox');
	Route::put('/bdfee/{id}/delete ','BD\FeeUtilController@delete')->name('bd.utilities.fee.del');
	//tax
	Route::resource('/bdtax','BD\TaxUtilController');
	Route::put('/bdtax/checkbox/{id}', 'BD\TaxUtilController@checkbox');
	Route::put('/bdtax/{id}/delete ','BD\TaxUtilController@delete')->name('bd.utilities.tax.del');
	//retention
	Route::resource('/bdretention','BD\RetentionUtilController');
	Route::put('/bdretention/checkbox/{id}', 'BD\RetentionUtilController@checkbox');
	Route::put('/bdretention/{id}/delete ','BD\RetentionUtilController@delete')->name('bd.utilities.retention.del');
	//recoupment
	Route::resource('/bdrecoupment','BD\RecoupmentUtilController');
	Route::put('/bdrecoupment/checkbox/{id}', 'BD\RecoupmentUtilController@checkbox');
	Route::put('/bdrecoupment/{id}/delete ','BD\RecoupmentUtilController@delete')->name('bd.utilities.recoupment.del');
	//mode of payment
	Route::resource('/bdpaymentmode','BD\PaymentModeUtilController');
	Route::put('/bdpaymentmode/checkbox/{id}', 'BD\PaymentModeUtilController@checkbox');
	Route::put('/bdpaymentmode/{id}/delete ','BD\PaymentModeUtilController@delete')->name('bd.utilities.mode.del');
	////////////////////////////////////////////////////////

	//billing and Collection
	Route::resource('/billingcollection','BD\BillingCollectionController');
	Route::get('/readByAjax1','BD\BillingCollectionController@readByAjax');

	Route::resource('/billing','BD\BillingController');
	Route::get('/readByAjax2/{id}','BD\BillingController@readByAjax')->name('bd.bill');
	Route::get('/printInvoice/{id}','BD\BillingController@printInvoice')->name('bd.printInvoice');
	Route::get('/printInvoiceInc/{id}','BD\BillingController@printInvoiceInc')->name('bd.printInvoiceInc');
	Route::post('/progressbilling','BD\BillingController@storeProgBill')->name('bd.bill.progress');
	Route::post('/turnover/{id}','BD\BillingController@Turnover')->name('bd.turnover');

	Route::resource('/stock','BD\StockController');
	Route::post('/stock/storeThis/{id}','BD\StockController@storeThis');
	Route::post('/stock/{id}/storeThat',['as'=>'stock.storeThat','uses'=>'BD\StockController@storeThat']);
	Route::get('/stock/getSupp/{id}','BD\StockController@getSupp');
	Route::get('/stock/getSuppPrice/{id}','BD\StockController@getSuppPrice');
	Route::get('/stock/task/{id}','BD\StockController@task')->name('stock.task');
	Route::get('/stock/openStock/{id}','BD\StockController@openStock')->name('stock.openStock');


	Route::resource('/collection','BD\CollectionController');
	Route::get('/readByAjax3/{id}','BD\CollectionController@readByAjax')->name('bd.collect');
	Route::post('/collectcash','BD\CollectionController@collectcash')->name('bd.collect.cash');
	Route::get('/printOR/{id}','BD\CollectionController@printOR')->name('bd.printOR');
	Route::get('/printAckReceipt/{id}','BD\CollectionController@printAckReceipt')->name('bd.printAckReceipt');
	Route::post('/bouncePost','BD\CollectionController@bouncePost')->name('bd.bouncepost');

	Route::prefix('collection')->group(function(){
		Route::get('/bouncePayment/{id}','BD\CollectionController@bouncePayment')->name('bd.bouncePayment');

		Route::get('/process/{id}','BD\CollectionController@process')->name('bd.process');
		Route::get('/process/byCash/{id}','BD\CollectionController@byCash')->name('bd.cash');
		Route::get('/process/byCheque/{id}','BD\CollectionController@byCheque')->name('bd.cheque');

	});
	Route::resource('/references','BD\ReferencesReportController');
	Route::post('/references/printReferencesofBilling','BD\ReferencesReportController@printReferencesofBilling')->name('bd.printReferencesofBilling');
	Route::resource('/collectionreports','BD\CollectionReportController');
	Route::post('/collectionreports/printCollection','BD\CollectionReportController@printCollection');
	Route::resource('/soareports','BD\SOAReportController');
	Route::post('/soareports/printSOA','BD\SOAReportController@printSOA');

});

Route::prefix('o')->group(function(){
	Route::get('/logout','Auth\OLoginController@getLogout')->name('o.logout');
	Route::get('/login','Auth\OLoginController@showOLogin')->name('o.login');
	Route::post('/login','Auth\OLoginController@Ologin')->name('o.login.submit');
	Route::get('/','O\OController@index')->name('o.home');
	Route::get('/register','Auth\OLoginController@showRegister')->name('o.register');
	Route::post('/register','Auth\OLoginController@register')->name('o.register.submit');

	//////////////////////////////////////////////
	//UTILITIES
	Route::resource('/utilities','O\UtilitiesController');
	//companyinfo
	Route::get('/companyinfo','O\UtilitiesController@companyinfo')->name('o.utilities.companyinfo');
	//smartcounter
	// Route::post('/addEmpID','O\UtilitiesController@storeEmpID');
	Route::post('/addClientID','O\UtilitiesController@storeClientID');
	Route::post('/addContractID','O\UtilitiesController@storeContractID');
	Route::post('/addInvoiceID','O\UtilitiesController@storeInvoiceID');
	Route::post('/addOrID','O\UtilitiesController@storeOrID');
	Route::get('/smartcounter','O\UtilitiesController@smartcounter')->name('o.utilities.smartcounter');
	//rate
	Route::resource('/rate','O\RateUtilController');
	Route::put('/rate/checkbox/{id}', 'O\RateUtilController@checkbox');
	Route::put('/rate/{id}/delete ','O\RateUtilController@delete')->name('o.utilities.rate.del');
	//miscellaneous
	Route::resource('/misc','O\MiscUtilController');
	Route::put('/misc/checkbox/{id}', 'O\MiscUtilController@checkbox');
	Route::put('/misc/{id}/delete ','O\MiscUtilController@delete')->name('o.utilities.misc.del');
	//additional fee
	Route::resource('/fee','O\FeeUtilController');
	Route::put('/fee/checkbox/{id}', 'O\FeeUtilController@checkbox');
	Route::put('/fee/{id}/delete ','O\FeeUtilController@delete')->name('o.utilities.fee.del');
	//tax
	Route::resource('/tax','O\TaxUtilController');
	Route::put('/tax/checkbox/{id}', 'O\TaxUtilController@checkbox');
	Route::put('/tax/{id}/delete ','O\TaxUtilController@delete')->name('o.utilities.tax.del');
	//retention
	Route::resource('/retention','O\RetentionUtilController');
	Route::put('/retention/checkbox/{id}', 'O\RetentionUtilController@checkbox');
	Route::put('/retention/{id}/delete ','O\RetentionUtilController@delete')->name('o.utilities.retention.del');
	//recoupment
	Route::resource('/recoupment','O\RecoupmentUtilController');
	Route::put('/recoupment/checkbox/{id}', 'O\RecoupmentUtilController@checkbox');
	Route::put('/recoupment/{id}/delete ','O\RecoupmentUtilController@delete')->name('o.utilities.recoupment.del');
	//mode of payment
	Route::resource('/paymentmode','O\PaymentModeUtilController');
	Route::put('/paymentmode/checkbox/{id}', 'O\PaymentModeUtilController@checkbox');
	Route::put('/paymentmode/{id}/delete ','O\PaymentModeUtilController@delete')->name('o.utilities.mode.del');
	////////////////////////////////////////////////////////
	//MAINTENANCE
	//Specialize
	Route::resource('/skill','O\SpecializationController');
	Route::get('/readByAjax7','O\SpecializationController@readByAjax');
	Route::put('/skill/checkbox/{id}', 'O\SpecializationController@checkbox');
	Route::put('/skill/{id}/delete ','O\SpecializationController@delete');
	//Worker
	Route::resource('/worker','O\EmployeeController');
	Route::get('/worker/{id}/editSpec','O\EmployeeController@editSpec');
	Route::resource('/empspec','O\EmpSpecController');
	Route::get('/readByAjax8','O\EmployeeController@readByAjax');
	Route::put('/worker/checkbox/{id}', 'O\EmployeeController@checkbox');
	Route::put('/worker/{id}/delete ','O\EmployeeController@delete');
	//Add Worker
	Route::resource('/addworker','O\AddEmployeeController');
	Route::resource('/workerspec','O\EmpSpecController');
	//Group UOM
	Route::resource('/dimension','O\GroupUOMController');
	Route::get('/readByAjax10','O\GroupUOMController@readByAjax');
	Route::put('/dimension/checkbox/{id}', 'O\GroupUOMController@checkbox');
	Route::put('/dimension/{id}/delete ','O\GroupUOMController@delete');
	//Detail UOM
	Route::resource('/detailuomeasure','O\DetailUOMController');
	Route::get('/readByAjax11','O\DetailUOMController@readByAjax');
	Route::put('/detailuomeasure/checkbox/{id}', 'O\DetailUOMController@checkbox');
	Route::put('/detailuomeasure/{id}/delete ','O\DetailUOMController@delete');
	//Material Type
	Route::resource('/materialtype','O\MaterialTypeController');
	Route::get('/readByAjax9','O\MaterialTypeController@readByAjax');
	Route::put('/materialtype/checkbox/{id}', 'O\MaterialTypeController@checkbox');
	Route::put('/materialtype/{id}/delete ','O\MaterialTypeController@delete');
	//Material Class
	Route::resource('/materialclass','O\MaterialClassController');
	Route::get('/readByAjax','O\MaterialClassController@readByAjax');
	Route::put('/materialclass/checkbox/{id}', 'O\MaterialClassController@checkbox');
	Route::put('/materialclass/{id}/delete ','O\MaterialClassController@delete');
	//Material
	Route::resource('/material','O\MaterialController');
	Route::get('/readByAjax2','O\MaterialController@readByAjax');
	Route::put('/material/checkbox//{id}', 'O\MaterialController@checkbox');
	Route::put('/material/{id}/delete ','O\MaterialController@delete');
	Route::get('/getMatClass/{id}','O\MaterialController@getMatClass');
	Route::get('/getMatUOM/{id}','O\MaterialController@getMatUOM');
	Route::get('/getMatSymbol/{id}','O\MaterialController@getMatSymbol');
	// Route::get('/findClass','O\MaterialController@findClass');

	//EquipmentType
	Route::resource('/equiptype','O\EquipTypeController');
	Route::get('/readByAjax3','O\EquipTypeController@readByAjax');
	Route::put('/equiptype/checkbox/{id}', 'O\EquipTypeController@checkbox');
	Route::put('/equiptype/{id}/delete ','O\EquipTypeController@delete');
	//Equipment
	Route::resource('/equipment','O\EquipmentController');
	Route::get('/readByAjax4','O\EquipmentController@readByAjax');
	Route::put('/equipment/checkbox/{id}', 'O\EquipmentController@checkbox');
	Route::put('/equipment/{id}/delete ','O\EquipmentController@delete');
	//Price Adjustment
	// Route::resource('/price','O\PriceController');
	// Route::get('/readByAjax16','O\PriceController@readByAjax');
	// // Route::get('/readByAjax17','O\PriceController@readByAjax1');
	// Route::get('/readByAjax18','O\PriceController@readByAjax2');
	// // Route::put('/price/spec/{id}','O\PriceController@spec_update');
	// Route::put('/price/equip/{id}','O\PriceController@equip_update');

	//Services Offered
	Route::resource('/serviceOff','O\ServicesOfferedController');
	Route::get('/readByAjax20','O\ServicesOfferedController@readByAjax');
	Route::put('/serviceOff/{id}/delete ','O\ServicesOfferedController@delete');
	Route::put('/serviceOff/checkbox/{id}', 'O\ServicesOfferedController@checkbox');

	//Tasks
	Route::resource('/task','O\TasksController');
	Route::get('/readByAjax5','O\TasksController@readByAjax');
	Route::put('/task/checkbox/{id}', 'O\TasksController@checkbox');
	Route::put('/task/{id}/delete ','O\TasksController@delete');
	Route::get('/readMaterial','O\TasksController@readMaterial')->name('o.readMat');
	Route::get('/readEquipment','O\TasksController@readEquipment')->name('o.readEquip');
	Route::get('/readWorker','O\TasksController@readWorker')->name('o.readWorker');
	Route::get('/task/findMatbyClass/{id}','O\TasksController@findMatbyClass');
	Route::get('/task/findMatbyNone','O\TasksController@findMatbyNone');
	Route::get('/task/findMatbyUOM/{id}','O\TasksController@findMatbyUOM');

	Route::get('/task/findRPD/{id}','O\TasksController@findRPD');

	Route::get('/task/getMatPrice/{id}','O\TasksController@getMatPrice');
	Route::get('/task/getEPrice/{id}','O\TasksController@getEPrice');
	Route::get('/task/findFee/{id}','O\TasksController@findFee');
	Route::get('/task/fetch/{id}','O\TasksController@findFee');

	Route::get('/task/getSpec/{id}','O\TasksController@getSpec');
	Route::get('/task/getMat/{id}','O\TasksController@getMat');
	Route::get('/task/getEqui/{id}','O\TasksController@getEqui');


	// Route::get('/serviceOff/findWorkerRate/{id}','O\ServicesOfferedController@findWorkerRate');
	//Bank
	Route::resource('/bank','O\BankController');
	Route::get('/readByAjax12','O\BankController@readByAjax');
	Route::put('/bank/checkbox/{id}', 'O\BankController@checkbox');
	Route::put('/bank/{id}/delete ','O\BankController@delete');
	//Supplier
	Route::resource('/supplier','O\SupplierController');
	Route::get('/readByAjax6','O\SupplierController@readByAjax');
	Route::put('/supplier/{id}/delete ','O\SupplierController@delete');


	//Delivery Trucks
	Route::resource('/expenses','O\ExpensesController');
	Route::get('/readByAjax18','O\ExpensesController@readByAjax');
	Route::put('/expenses/checkbox/{id}', 'O\ExpensesController@checkbox');
	Route::put('/expenses/{id}/delete ','O\ExpensesController@delete');
	////////////////////////////////////////////////////////

	Route::resource('/stockadjustment','O\StockController');
	Route::get('/readByAjax15','O\StockController@readByAjax');
	Route::get('/stockadjustment/findPrice/{id}','O\StockController@findPrice')->name('o.stockadjustment.findPrice');
	Route::post('/stockadjustment/{id}/storeThis',['as'=>'stockadjustment.storeThis','uses'=>'O\StockController@storeThis']);
	Route::post('/stockadjustment/{id}/storeThat',['as'=>'stockadjustment.storeThat','uses'=>'O\StockController@storeThat']);
	Route::post('/stockadjustment/printStockCard','O\StockController@printStockCard')->name('o.stockadjustment.printStockCard');
	Route::get('/stockqueries','O\StockController@queries')->name('o.stockadjustment.queries');
	Route::get('/readQueries','O\StockController@readQueries');
	Route::get('/findMate/{id}','O\StockController@findMate');
	Route::get('/findSupp/{id}','O\StockController@findSupp');



});
Route::prefix('queries')->group(function(){
	Route::resource('/contractqueries', 'QUERIES\ContractController');
	Route::resource('/orqueries', 'QUERIES\ORController');
	Route::resource('/invoicequeries', 'QUERIES\InvoiceController');
});

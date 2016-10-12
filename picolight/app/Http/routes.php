<?php

/*
|--------------------------------------------------------------------------
| Application Routes
|--------------------------------------------------------------------------
|
| Here is where you can register all of the routes for an application.
| It's a breeze. Simply tell Laravel the URIs it should respond to
| and give it the controller to call when that URI is requested.
|
*/

// Route::get('/', function () {
//     return view('welcome');
// });

// Route::auth();

// Route::get('/home', 'HomeController@index');
// Route::resource("/tweets","TweetController");
// Route::resource("/kayes","KayeController"); 

/* ================== Creditvouchers temp================== */
Route::resource(config('laraadmin.adminRoute') . '/creditvouchers', 'LA\CreditvouchersController');
Route::get(config('laraadmin.adminRoute') . '/creditvoucher_dt_ajax', 'LA\CreditvouchersController@dtajax');

/* ================== Homepage ================== */

Route::get('/', 'LA\DashboardController@index');
// Route::get('/', 'HomeController@index');
Route::get('/home', 'HomeController@index');

Route::auth();

/* ================== Dashboard ================== */

Route::get(config('laraadmin.adminRoute'), 'LA\DashboardController@index');
Route::get(config('laraadmin.adminRoute'). '/dashboard', 'LA\DashboardController@index');
// Route::get('/dashboard', 'LA\DashboardController@index');

/* ================== Users ================== */
Route::resource(config('laraadmin.adminRoute') . '/users', 'LA\UsersController');
Route::get(config('laraadmin.adminRoute') . '/user_dt_ajax', 'LA\UsersController@dtajax');

/* ================== Uploads ================== */
Route::resource(config('laraadmin.adminRoute') . '/uploads', 'LA\UploadsController');
Route::post(config('laraadmin.adminRoute') . '/upload_files', 'LA\UploadsController@upload_files');
Route::get(config('laraadmin.adminRoute') . '/uploaded_files', 'LA\UploadsController@uploaded_files');
Route::get('files/{hash}/{name}', 'LA\UploadsController@get_file');
Route::post(config('laraadmin.adminRoute') . '/uploads_update_caption', 'LA\UploadsController@update_caption');
Route::post(config('laraadmin.adminRoute') . '/uploads_update_filename', 'LA\UploadsController@update_filename');
Route::post(config('laraadmin.adminRoute') . '/uploads_update_public', 'LA\UploadsController@update_public');
Route::post(config('laraadmin.adminRoute') . '/uploads_delete_file', 'LA\UploadsController@delete_file');

/* ================== Roles ================== */
Route::resource(config('laraadmin.adminRoute') . '/roles', 'LA\RolesController');
Route::get(config('laraadmin.adminRoute') . '/role_dt_ajax', 'LA\RolesController@dtajax');

/* ================== Departments ================== */
Route::resource(config('laraadmin.adminRoute') . '/departments', 'LA\DepartmentsController');
Route::get(config('laraadmin.adminRoute') . '/department_dt_ajax', 'LA\DepartmentsController@dtajax');

/* ================== Employees ================== */
Route::resource(config('laraadmin.adminRoute') . '/employees', 'LA\EmployeesController');
Route::get(config('laraadmin.adminRoute') . '/employee_dt_ajax', 'LA\EmployeesController@dtajax');

/* ================== Organizations ================== */
Route::resource(config('laraadmin.adminRoute') . '/organizations', 'LA\OrganizationsController');
Route::get(config('laraadmin.adminRoute') . '/organization_dt_ajax', 'LA\OrganizationsController@dtajax');

/* ================== Companies ================== */
Route::resource(config('laraadmin.adminRoute') . '/companies', 'LA\CompaniesController');
Route::get(config('laraadmin.adminRoute') . '/company_dt_ajax', 'LA\CompaniesController@dtajax');

/* ================== Debitvouchers ================== */
Route::resource(config('laraadmin.adminRoute') . '/debitvouchers', 'LA\DebitvouchersController');
Route::get(config('laraadmin.adminRoute') . '/debitvoucher_dt_ajax', 'LA\DebitvouchersController@dtajax');

 

/* ================== JutemillUnitTypes ================== */
Route::resource(config('laraadmin.adminRoute') . '/jutemillunittypes', 'LA\JutemillUnitTypesController');
Route::get(config('laraadmin.adminRoute') . '/jutemillunittype_dt_ajax', 'LA\JutemillUnitTypesController@dtajax');

/* ================== JutemillSubUnitTypes ================== */
Route::resource(config('laraadmin.adminRoute') . '/jutemillsubunittypes', 'LA\JutemillSubUnitTypesController');
Route::get(config('laraadmin.adminRoute') . '/jutemillsubunittype_dt_ajax', 'LA\JutemillSubUnitTypesController@dtajax');

 
/* ================== JuteMillItemCategories ================== */
Route::resource(config('laraadmin.adminRoute') . '/jutemillitemcategories', 'LA\JuteMillItemCategoriesController');
Route::get(config('laraadmin.adminRoute') . '/jutemillitemcategory_dt_ajax', 'LA\JuteMillItemCategoriesController@dtajax');
Route::get(config('laraadmin.adminRoute') . '/jute_sub_item/{itemid?}', 'LA\JuteMillItemCategoriesController@jute_sub_item');



/* ================== Jutemillitems ================== */
Route::resource(config('laraadmin.adminRoute') . '/jutemillitems', 'LA\JutemillitemsController');
Route::get(config('laraadmin.adminRoute') . '/jutemillitem_dt_ajax', 'LA\JutemillitemsController@dtajax');

/* ================== JuteReceives ================== */
Route::resource(config('laraadmin.adminRoute') . '/jutereceives', 'LA\JuteReceivesController');
Route::get(config('laraadmin.adminRoute') . '/jutereceife_dt_ajax', 'LA\JuteReceivesController@dtajax');
Route::get(config('laraadmin.adminRoute') . '/pdf/{sl}', 'LA\JuteReceivesController@pdf');


/* ================== Jutemillsuppliers ================== */
Route::resource(config('laraadmin.adminRoute') . '/jutemillsuppliers', 'LA\JutemillsuppliersController');
Route::get(config('laraadmin.adminRoute') . '/jutemillsupplier_dt_ajax', 'LA\JutemillsuppliersController@dtajax');
 
 
/* ================== BankPledges ================== */
Route::resource(config('laraadmin.adminRoute') . '/bankpledges', 'LA\BankPledgesController');
Route::get(config('laraadmin.adminRoute') . '/bankpledge_dt_ajax', 'LA\BankPledgesController@dtajax');
Route::get(config('laraadmin.adminRoute') . '/bankpledge_store/{subitem_itemid?}', 'LA\BankPledgesController@bankpedge_items');


 

/* ================== BankDiposits ================== */
Route::resource(config('laraadmin.adminRoute') . '/bankdiposits', 'LA\BankDipositsController');
Route::get(config('laraadmin.adminRoute') . '/bankdiposit_dt_ajax', 'LA\BankDipositsController@dtajax');

 
/* ================== Acc_accounts ================== */
Route::resource(config('laraadmin.adminRoute') . '/acc_accounts', 'LA\Acc_accountsController');
Route::get(config('laraadmin.adminRoute') . '/acc_account_dt_ajax', 'LA\Acc_accountsController@dtajax');
Route::get(config('laraadmin.adminRoute') . '/sub_acc_title/{itemid?}', 'LA\Acc_accountsController@acc_sub_item');
Route::get(config('laraadmin.adminRoute') . '/sub_acc_code/{itemid?}', 'LA\Acc_accountsController@sub_acc_code');
Route::get(config('laraadmin.adminRoute') . '/count_acc_code/{itemid?}', 'LA\Acc_accountsController@count_acc_code');
 

/* ================== BankPledgeReturns ================== */
Route::resource(config('laraadmin.adminRoute') . '/bankpledgereturns', 'LA\BankPledgeReturnsController');
Route::get(config('laraadmin.adminRoute') . '/bankpledgereturn_dt_ajax', 'LA\BankPledgeReturnsController@dtajax');

 
/* ================== Acc_voucher_types ================== */
Route::resource(config('laraadmin.adminRoute') . '/acc_voucher_types', 'LA\Acc_voucher_typesController');
Route::get(config('laraadmin.adminRoute') . '/acc_voucher_type_dt_ajax', 'LA\Acc_voucher_typesController@dtajax');

/* ================== Acc_ledger_types ================== */
Route::resource(config('laraadmin.adminRoute') . '/acc_ledger_types', 'LA\Acc_ledger_typesController');
Route::get(config('laraadmin.adminRoute') . '/acc_ledger_type_dt_ajax', 'LA\Acc_ledger_typesController@dtajax');

/* ================== Acc_ledgers ================== */
Route::resource(config('laraadmin.adminRoute') . '/acc_ledgers', 'LA\Acc_ledgersController');
Route::get(config('laraadmin.adminRoute') . '/acc_ledger_dt_ajax', 'LA\Acc_ledgersController@dtajax');
Route::get('jquery-tree-view',array('as'=>'jquery.treeview','uses'=>'LA\Acc_ledgersController@treeView'));

/* ================== Jutemillinventorys ================== */
Route::resource(config('laraadmin.adminRoute') . '/jutemillinventorys', 'LA\JutemillinventorysController');
Route::get(config('laraadmin.adminRoute') . '/jutemillinventory_dt_ajax', 'LA\JutemillinventorysController@dtajax');
Route::get(config('laraadmin.adminRoute') . '/jutemillinventory/{subitem_itemid?}', 'LA\JutemillinventorysController@inventory_items');


/* ================== MillIssues ================== */
Route::resource(config('laraadmin.adminRoute') . '/millissues', 'LA\MillIssuesController');
Route::get(config('laraadmin.adminRoute') . '/millissue_dt_ajax', 'LA\MillIssuesController@dtajax');    


/* ================== Jutemillproductionlines ================== */
Route::resource(config('laraadmin.adminRoute') . '/jutemillproductionlines', 'LA\JutemillproductionlinesController');
Route::get(config('laraadmin.adminRoute') . '/jutemillproductionline_dt_ajax', 'LA\JutemillproductionlinesController@dtajax');

// dompdf 

Route::get('/getPDF','JutemillreportController@getPDF');
Route::get('/getreportPDF','JutercvreportController@getreportPDF');
Route::get('/getinventoryREPORT','LA\JutemillinventorysController@getinventoryREPORT');




// /* ================== Jutemillproductionlineinventories ==================p */
// Route::resource(config('laraadmin.adminRoute') . '/jutemillproductionlineinventories', 'LA\JutemillproductionlineinventoriesController');
// Route::get(config('laraadmin.adminRoute') . '/jutemillproductionlineinventory_dt_ajax', 'LA\JutemillproductionlineinventoriesController@dtajax');


/* ================== JuteCuttings ================== */
Route::resource(config('laraadmin.adminRoute') . '/jutecuttings', 'LA\JuteCuttingsController');
Route::get(config('laraadmin.adminRoute') . '/jutecutting_dt_ajax', 'LA\JuteCuttingsController@dtajax');

/* ================== JMProductionLineIssues ================== */
Route::resource(config('laraadmin.adminRoute') . '/jmproductionlineissues', 'LA\JMProductionLineIssuesController');
Route::get(config('laraadmin.adminRoute') . '/jmproductionlineissue_dt_ajax', 'LA\JMProductionLineIssuesController@dtajax');

/* ================== JMProductionItems ================== */
Route::resource(config('laraadmin.adminRoute') . '/jmproductionitems', 'LA\JMProductionItemsController');
Route::get(config('laraadmin.adminRoute') . '/jmproductionitem_dt_ajax', 'LA\JMProductionItemsController@dtajax');
 

/* ================== JMProductionShifts ================== */
Route::resource(config('laraadmin.adminRoute') . '/jmproductionshifts', 'LA\JMProductionShiftsController');
Route::get(config('laraadmin.adminRoute') . '/jmproductionshift_dt_ajax', 'LA\JMProductionShiftsController@dtajax');

/* ================== JMProductionInventorys ================== */
Route::resource(config('laraadmin.adminRoute') . '/jmproductioninventorys', 'LA\JMProductionInventorysController');
Route::get(config('laraadmin.adminRoute') . '/jmproductioninventory_dt_ajax', 'LA\JMProductionInventorysController@dtajax');

/* ================== JMSpiningProductions ================== */
Route::resource(config('laraadmin.adminRoute') . '/jmspiningproductions', 'LA\JMSpiningProductionsController');
Route::get(config('laraadmin.adminRoute') . '/jmspiningproduction_dt_ajax', 'LA\JMSpiningProductionsController@dtajax');

/* ================== JMLoomProductions ================== */
Route::resource(config('laraadmin.adminRoute') . '/jmloomproductions', 'LA\JMLoomProductionsController');
Route::get(config('laraadmin.adminRoute') . '/jmloomproduction_dt_ajax', 'LA\JMLoomProductionsController@dtajax'); 
 
/* ================== Journalvouchers ================== */
Route::resource(config('laraadmin.adminRoute') . '/journalvouchers', 'LA\JournalvouchersController');
Route::get(config('laraadmin.adminRoute') . '/journalvoucher_dt_ajax', 'LA\JournalvouchersController@dtajax');
 
/* ================== CsSRManagements ================== */
Route::resource(config('laraadmin.adminRoute') . '/cssrmanagements', 'LA\CsSRManagementsController');
Route::get(config('laraadmin.adminRoute') . '/cssrmanagement_dt_ajax', 'LA\CsSRManagementsController@dtajax');


/* ================== CsPartys ================== */
Route::resource(config('laraadmin.adminRoute') . '/cspartys', 'LA\CsPartysController');
Route::get(config('laraadmin.adminRoute') . '/csparty_dt_ajax', 'LA\CsPartysController@dtajax');

/* ================== CsAgents ================== */
Route::resource(config('laraadmin.adminRoute') . '/csagents', 'LA\CsAgentsController');
Route::get(config('laraadmin.adminRoute') . '/csagent_dt_ajax', 'LA\CsAgentsController@dtajax');

/* ================== CsUnitTypes ================== */
Route::resource(config('laraadmin.adminRoute') . '/csunittypes', 'LA\CsUnitTypesController');
Route::get(config('laraadmin.adminRoute') . '/csunittype_dt_ajax', 'LA\CsUnitTypesController@dtajax');

/* ================== CsSubUnitTypes ================== */
Route::resource(config('laraadmin.adminRoute') . '/cssubunittypes', 'LA\CsSubUnitTypesController');
Route::get(config('laraadmin.adminRoute') . '/cssubunittype_dt_ajax', 'LA\CsSubUnitTypesController@dtajax');

/* ================== CsItems ================== */
Route::resource(config('laraadmin.adminRoute') . '/csitems', 'LA\CsItemsController');
Route::get(config('laraadmin.adminRoute') . '/csitem_dt_ajax', 'LA\CsItemsController@dtajax');

/* ================== CsItemCategories ================== */
Route::resource(config('laraadmin.adminRoute') . '/csitemcategories', 'LA\CsItemCategoriesController');
Route::get(config('laraadmin.adminRoute') . '/csitemcategory_dt_ajax', 'LA\CsItemCategoriesController@dtajax');

/* ================== CsPrices ================== */
Route::resource(config('laraadmin.adminRoute') . '/csprices', 'LA\CsPricesController');
Route::get(config('laraadmin.adminRoute') . '/csprice_dt_ajax', 'LA\CsPricesController@dtajax');

/* ================== CsSuppliers ================== */
Route::resource(config('laraadmin.adminRoute') . '/cssuppliers', 'LA\CsSuppliersController');
Route::get(config('laraadmin.adminRoute') . '/cssupplier_dt_ajax', 'LA\CsSuppliersController@dtajax');

/* ================== CsInventories ================== */
Route::resource(config('laraadmin.adminRoute') . '/csinventories', 'LA\CsInventoriesController');
Route::get(config('laraadmin.adminRoute') . '/csinventory_dt_ajax', 'LA\CsInventoriesController@dtajax');

/* ================== CsPurchaseInvoices ================== */
Route::resource(config('laraadmin.adminRoute') . '/cspurchaseinvoices', 'LA\CsPurchaseInvoicesController');
Route::get(config('laraadmin.adminRoute') . '/cspurchaseinvoice_dt_ajax', 'LA\CsPurchaseInvoicesController@dtajax');

/* ================== CsBillPayments ================== */
Route::resource(config('laraadmin.adminRoute') . '/csbillpayments', 'LA\CsBillPaymentsController');
Route::get(config('laraadmin.adminRoute') . '/csbillpayment_dt_ajax', 'LA\CsBillPaymentsController@dtajax');

/* ================== CsSackManagements ================== */
Route::resource(config('laraadmin.adminRoute') . '/cssackmanagements', 'LA\CsSackManagementsController');
Route::get(config('laraadmin.adminRoute') . '/cssackmanagement_dt_ajax', 'LA\CsSackManagementsController@dtajax');

/* ================== CsDumyOrders ================== */
Route::resource(config('laraadmin.adminRoute') . '/csdumyorders', 'LA\CsDumyOrdersController');
Route::get(config('laraadmin.adminRoute') . '/csdumyorder_dt_ajax', 'LA\CsDumyOrdersController@dtajax');

/* ================== CsGatePasses ================== */
Route::resource(config('laraadmin.adminRoute') . '/csgatepasses', 'LA\CsGatePassesController');
Route::get(config('laraadmin.adminRoute') . '/csgatepass_dt_ajax', 'LA\CsGatePassesController@dtajax');

/* ================== CsSalesInvoices ================== */
Route::resource(config('laraadmin.adminRoute') . '/cssalesinvoices', 'LA\CsSalesInvoicesController');
Route::get(config('laraadmin.adminRoute') . '/cssalesinvoice_dt_ajax', 'LA\CsSalesInvoicesController@dtajax');

/* ================== CsSRs ================== */
Route::resource(config('laraadmin.adminRoute') . '/cssrs', 'LA\CsSRsController');
Route::get(config('laraadmin.adminRoute') . '/cssr_dt_ajax', 'LA\CsSRsController@dtajax');

/* ================== CsDeeds ================== */
Route::resource(config('laraadmin.adminRoute') . '/csdeeds', 'LA\CsDeedsController');
Route::get(config('laraadmin.adminRoute') . '/csdeed_dt_ajax', 'LA\CsDeedsController@dtajax');

/* ================== CsLoans ================== */
Route::resource(config('laraadmin.adminRoute') . '/csloans', 'LA\CsLoansController');
Route::get(config('laraadmin.adminRoute') . '/csloan_dt_ajax', 'LA\CsLoansController@dtajax');

/* ================== CsDistributions ================== */
Route::resource(config('laraadmin.adminRoute') . '/csdistributions', 'LA\CsDistributionsController');
Route::get(config('laraadmin.adminRoute') . '/csdistribution_dt_ajax', 'LA\CsDistributionsController@dtajax');

/* ================== CsBillReceiveds ================== */
Route::resource(config('laraadmin.adminRoute') . '/csbillreceiveds', 'LA\CsBillReceivedsController');
Route::get(config('laraadmin.adminRoute') . '/csbillreceived_dt_ajax', 'LA\CsBillReceivedsController@dtajax');

/* ================== JMPurchaseInvoices ================== */
Route::resource(config('laraadmin.adminRoute') . '/jmpurchaseinvoices', 'LA\JMPurchaseInvoicesController');
Route::get(config('laraadmin.adminRoute') . '/jmpurchaseinvoice_dt_ajax', 'LA\JMPurchaseInvoicesController@dtajax');

/* ================== JMBankAccountInfos ================== */
Route::resource(config('laraadmin.adminRoute') . '/jmbankaccountinfos', 'LA\JMBankAccountInfosController');
Route::get(config('laraadmin.adminRoute') . '/jmbankaccountinfo_dt_ajax', 'LA\JMBankAccountInfosController@dtajax');

/* ================== AccTransactionMethods ================== */
Route::resource(config('laraadmin.adminRoute') . '/acctransactionmethods', 'LA\AccTransactionMethodsController');
Route::get(config('laraadmin.adminRoute') . '/acctransactionmethod_dt_ajax', 'LA\AccTransactionMethodsController@dtajax');

/* ================== AccTransactionDetails ================== */
Route::resource(config('laraadmin.adminRoute') . '/acctransactiondetails', 'LA\AccTransactionDetailsController');
Route::get(config('laraadmin.adminRoute') . '/acctransactiondetail_dt_ajax', 'LA\AccTransactionDetailsController@dtajax');

/* ================== AccTransactionMasters ================== */
Route::resource(config('laraadmin.adminRoute') . '/acctransactionmasters', 'LA\AccTransactionMastersController');
Route::get(config('laraadmin.adminRoute') . '/acctransactionmaster_dt_ajax', 'LA\AccTransactionMastersController@dtajax');

/* ================== JMProductionlines ================== */
Route::resource(config('laraadmin.adminRoute') . '/jmproductionlines', 'LA\JMProductionlinesController');
Route::get(config('laraadmin.adminRoute') . '/jmproductionline_dt_ajax', 'LA\JMProductionlinesController@dtajax');

/* ================== JMProduceItemCategorys ================== */
Route::resource(config('laraadmin.adminRoute') . '/jmproduceitemcategorys', 'LA\JMProduceItemCategorysController');
Route::get(config('laraadmin.adminRoute') . '/jmproduceitemcategory_dt_ajax', 'LA\JMProduceItemCategorysController@dtajax');
Route::get(config('laraadmin.adminRoute') . '/jm_production_item_chat/{itemid?}', 'LA\JMProduceItemCategorysController@jm_production_item_chat');


/* ================== JMProduceDistributions ================== */
Route::resource(config('laraadmin.adminRoute') . '/jmproducedistributions', 'LA\JMProduceDistributionsController');
Route::get(config('laraadmin.adminRoute') . '/jmproducedistribution_dt_ajax', 'LA\JMProduceDistributionsController@dtajax');
// 

/* ================== Ledgerreports ================== */
Route::resource(config('laraadmin.adminRoute') . '/ledgerreports', 'LA\LedgerreportsController');
Route::get(config('laraadmin.adminRoute') . '/ledgerreport_dt_ajax', 'LA\LedgerreportsController@dtajax');

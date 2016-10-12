<?php
/**
 * Migration genrated using LaraAdmin
 * Help: http://laraadmin.com
 */

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;
use Dwij\Laraadmin\Models\Module;
use Dwij\Laraadmin\Models\ModuleFields;
use App\Acc_account;

class CreateAccAccountsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Module::generate("Acc_accounts", 'acc_accounts', 'account_id', 'ALL',[
            ["account_id",          "Account Id",        "Integer",  false, 0,           0,  5000,   false],
            ["account_no",          "Account No",        "String",  false, "",           0,  5000,   false],
            ["account_title",       "Account Title",     "String",  false, "",          0, 256,   true],
            ["acc_or_group",       "Account Or Group",     "String",   false, "",          0, 256,   true],
            ["acc_depth",          "Account Depth",        "Integer",  false, 0,           0,  5000,   false],
            ["nature",              "Nature",             "String",  false, "",           0,  5000,   false],
            ["account_status",       "Account Status",     "String",   false, "",          0, 256,   true],
            ["parent_id",           "Parent Id",            "Integer",  false, "",           0,  5000,   false],
            ["opening_balance",     "Opening Balance",       "String",  false, "",         0,  20,     true],
            ["current_balance",     "Current Balance",          "String",  false, "",         0,  20,     true],
            ["is_inventory_related", "Is Inventory Related",   "Checkbox", false, false,       0,  0,      false],
            ["ledger_type_id",        "Ledger Type Id",        "Integer",  false, 0,           0,  5000,   false],
            ["ledger_id",            "Ledger Id",                "Integer",  false, 0,           0,  5000,   false],
            ["company_id",          "Company Id",               "Dropdown", false, 3,           0,  0,      false, "@companies"],
            ["user_id",             "User Id",                  "Integer",  false, 0,           0,  5000,   false, "@users"],
            ["modified_date",       "Modifie Date",             "Datetime", false, "date('Y-m-d H:i:s')", 0, 0, false],
            ["final_parent_id",      "Final Parent Id",        "Integer",  false, 0,           0,  5000,   false],

            
        ]);
		
        $a_no = ['1', '2', '3', '4', '5', '6', '7'];
        $a_t = ['Current Assets', 'Fixed Assets', 'Current Liabilities', 'Long Term Liabilities', 'Capital', 'Income', 'Expense'];
        // $parent_id=NULL;
        
        for ($i=0; $i <7 ; $i++) { 

            $row = new Acc_account;
            $row->account_no = $a_no[$i];
            $row->account_title = $a_t[$i];
            $row->parent_id;
            $row->save();
        }
      

        $CurrentAssets = Acc_account::where('account_title', 'Current Assets')->first();
        $FixedAssets = Acc_account::where('account_title', 'Fixed Assets')->first();
        $CurrentLiabilities = Acc_account::where('account_title', 'Current Liabilities')->first();
        $LongTermLiabilities = Acc_account::where('account_title', 'Long Term Liabilities')->first();
        $Capital = Acc_account::where('account_title', 'Capital')->first();
        $Income = Acc_account::where('account_title', 'Income')->first();
        $Expense = Acc_account::where('account_title', 'Expense')->first();

        $suppliers = Array
        (
            Array
            (
                'account_title' => 'Cash',
                'account_no' => '1-1',
                'acc_or_group' => 'Group',
                'acc_depth' => '1',
                'nature' => '1',
                'parent_id'=> $CurrentAssets->id,
                'account_status' => 'Active'
                
            ),
            Array
            (
                'account_title' => 'Sundry Debtors',
                'account_no' => '1-2',
                'acc_or_group' => 'Group',
                'acc_depth' => '1',
                'nature' => '1',
                'parent_id'=> $CurrentAssets->id,
                'account_status' => 'Active'
                
            ),
            Array
            (
                'account_title' => 'Bills Receivable',
                'account_no' => '1-3',
                'acc_or_group' => 'Group',
                'acc_depth' => '1',
                'nature' => '1',
                'parent_id'=> $CurrentAssets->id,
                'account_status' => 'Active'
                
            ),
            Array
            (
                'account_title' => 'Bank Account',
                'account_no' => '1-4',
                'acc_or_group' => 'Group',
                'acc_depth' => '1',
                'nature' => '1',
                'parent_id'=> $CurrentAssets->id,
                'account_status' => 'Active'
                
            ),
            Array
            (
                'account_title' => 'Advance Payment',
                'account_no' => '1-5',
                'acc_or_group' => 'Group',
                'acc_depth' => '1',
                'nature' => '1',
                'parent_id'=> $CurrentAssets->id,
                'account_status' => 'Active'
                
            ),
            Array
            (
                'account_title' => 'Stock & Store',
                'account_no' => '1-6',
                'acc_or_group' => 'Group',
                'acc_depth' => '1',
                'nature' => '1',
                'parent_id'=> $CurrentAssets->id,
                'account_status' => 'Active'
                
            ),
            Array
            (
                'account_title' => 'Accrued Receivable',
                'account_no' => '1-7',
                'acc_or_group' => 'Group',
                'acc_depth' => '1',
                'nature' => '1',
                'parent_id'=> $CurrentAssets->id,
                'account_status' => 'Active'
                
            ),
            Array
            (
                'account_title' => 'Security Deposit',
                'account_no' => '1-8',
                'acc_or_group' => 'Account',
                'acc_depth' => '1',
                'nature' => '1',
                'parent_id'=> $CurrentAssets->id,
                'account_status' => 'Active'
                
            ),
            Array
            (
                'account_title' => 'Monery Transfer Service',
                'account_no' => '1-9',
                'acc_or_group' => 'Group',
                'acc_depth' => '1',
                'nature' => '1',
                'parent_id'=> $CurrentAssets->id,
                'account_status' => 'Active'
                
            ),

            // 2 //
            Array
            (
                'account_title' => 'Electrical Machinery',
                'account_no' => '2-1',
                'acc_or_group' => 'Group',
                'acc_depth' => '1',
                'nature' => '1',
                'parent_id'=> $FixedAssets->id,
                'account_status' => 'Active'
                
            ),
            Array
            (
                'account_title' => 'Mechanical Machnery',
                'account_no' => '2-2',
                'acc_or_group' => 'Group',
                'acc_depth' => '1',
                'nature' => '1',
                'parent_id'=> $FixedAssets->id,
                'account_status' => 'Active'
                
            ),
            Array
            (
                'account_title' => 'Furniture & Fixture',
                'account_no' => '2-3',
                'acc_or_group' => 'Account',
                'acc_depth' => '1',
                'nature' => '1',
                'parent_id'=> $FixedAssets->id,
                'account_status' => 'Active'
                
            ),
            // 3 //


            Array
            (
                'account_title' => 'Sundry Creditors',
                'account_no' => '3-1',
                'acc_or_group' => 'Group',
                'acc_depth' => '1',
                'nature' => '-1',
                'parent_id'=> $CurrentLiabilities->id,
                'account_status' => 'Active'
                
            ),
            Array
            (
                'account_title' => 'Advanced Received',
                'account_no' => '3-2',
                'acc_or_group' => 'Group',
                'acc_depth' => '1',
                'nature' => '-1',
                'parent_id'=> $CurrentLiabilities->id,
                'account_status' => 'Active'
                
            ),
            Array
            (
                'account_title' => 'Bank Loan',
                'account_no' => '3-3',
                'acc_or_group' => 'Group',
                'acc_depth' => '1',
                'nature' => '-1',
                'parent_id'=> $CurrentLiabilities->id,
                'account_status' => 'Active'
                
            ),
            Array
            (
                'account_title' => 'Bills Payable',
                'account_no' => '3-4',
                'acc_or_group' => 'Group',
                'acc_depth' => '1',
                'nature' => '-1',
                'parent_id'=> $CurrentLiabilities->id,
                'account_status' => 'Active'
                
            ),
            Array
            (
                'account_title' => 'Accrued Payable',
                'account_no' => '3-5',
                'acc_or_group' => 'Group',
                'acc_depth' => '1',
                'nature' => '-1',
                'parent_id'=> $CurrentLiabilities->id,
                'account_status' => 'Active'
                
            ),
            Array
            (
                'account_title' => 'Shah Ismail Gazi (Rah) Cold Storage Ltd',
                'account_no' => '3-6',
                'acc_or_group' => 'Account',
                'acc_depth' => '1',
                'nature' => '-1',
                'parent_id'=> $CurrentLiabilities->id,
                'account_status' => 'Active'
                
            ),
            Array
            (
                'account_title' => 'Shah Ismail Gazi (Rah) Foods Ltd',
                'account_no' => '3-7',
                'acc_or_group' => 'Account',
                'acc_depth' => '1',
                'nature' => '-1',
                'parent_id'=> $CurrentLiabilities->id,
                'account_status' => 'Active'
                
            ),
            Array
            (
                'account_title' => 'Vertex Engineering & Construction Ltd',
                'account_no' => '3-8',
                'acc_or_group' => 'Account',
                'acc_depth' => '1',
                'nature' => '-1',
                'parent_id'=> $CurrentLiabilities->id,
                'account_status' => 'Active'
                
            ),
            Array
            (
                'account_title' => 'Vertex Software (BD) Ltd',
                'account_no' => '3-9',
                'acc_or_group' => 'Account',
                'acc_depth' => '1',
                'nature' => '-1',
                'parent_id'=> $CurrentLiabilities->id,
                'account_status' => 'Active'
                
            ),



            // 5 //

            Array
            (
                'account_title' => 'Managing Director',
                'account_no' => '5-4',
                'acc_or_group' => 'Account',
                'acc_depth' => '1',
                'nature' => '-1',
                'parent_id'=> $Capital->id,
                'account_status' => 'Active'
                
            ),

            // 6 //

            Array
            (
                'account_title' => 'Sales Account',
                'account_no' => '6-1',
                'acc_or_group' => 'Group',
                'acc_depth' => '1',
                'nature' => '-1',
                'parent_id'=> $Income->id,
                'account_status' => 'Active'
                
            ),
            Array
            (
                'account_title' => 'Other Income Account',
                'account_no' => '6-2',
                'acc_or_group' => 'Group',
                'acc_depth' => '1',
                'nature' => '-1',
                'parent_id'=> $Income->id,
                'account_status' => 'Active'
                
            ),
            Array
            (
                'account_title' => 'Profit and Loss Appropriation',
                'account_no' => '6-3',
                'acc_or_group' => 'Account',
                'acc_depth' => '1',
                'nature' => '-1',
                'parent_id'=> $Income->id,
                'account_status' => 'Active'
                
            ),

            // 7 //
            Array
            (
                'account_title' => 'Production Overhead',
                'account_no' => '7-1',
                'acc_or_group' => 'Group',
                'acc_depth' => '1',
                'nature' => '1',
                'parent_id'=> $Expense->id,
                'account_status' => 'Active'
                
            ),
            Array
            (
                'account_title' => 'Administrative Overhead',
                'account_no' => '7-2',
                'acc_or_group' => 'Group',
                'acc_depth' => '1',
                'nature' => '1',
                'parent_id'=> $Expense->id,
                'account_status' => 'Active'
                
            ),
            Array
            (
                'account_title' => 'Financial Expense',
                'account_no' => '7-3',
                'acc_or_group' => 'Group',
                'acc_depth' => '1',
                'nature' => '1',
                'parent_id'=> $Expense->id,
                'account_status' => 'Active'
                
            ),
            Array
            (
                'account_title' => 'Selling Expense',
                'account_no' => '7-4',
                'acc_or_group' => 'Group',
                'acc_depth' => '1',
                'nature' => '1',
                'parent_id'=> $Expense->id,
                'account_status' => 'Active'
                
            ),
            Array
            (
                'account_title' => 'Purchase Account',
                'account_no' => '7-5',
                'acc_or_group' => 'Group',
                'acc_depth' => '1',
                'nature' => '1',
                'parent_id'=> $Expense->id,
                'account_status' => 'Active'
                
            ),
            Array
            (
                'account_title' => 'Depreciation',
                'account_no' => '7-6',
                'acc_or_group' => 'Account',
                'acc_depth' => '1',
                'nature' => '1',
                'parent_id'=> $Expense->id,
                'account_status' => 'Active'
                
            ),

           
            
        );
       
        foreach ($suppliers as $value) {
            $row = new Acc_account;
            $row->account_title = $value['account_title'];
            $row->account_no = $value['account_no'];
            $row->acc_or_group = $value['acc_or_group'];
            $row->acc_depth = $value['acc_depth'];
            $row->nature = $value['nature'];
            $row->account_status = $value['account_status'];
            $row->parent_id = $value['parent_id'];
            $row->save();
            };








		/*
		Row Format:
		["field_name_db", "Label", "UI Type", "Readonly", "Default_Value", "min_length", "max_length", "Required", "Pop_values"]
        Module::generate("Module_Name", "Table_Name", "view_column_name" "Fields_Array");
        
		Module::generate("Books", 'books', 'name', [
            ["address",     "Address",      "Address",  false, "",          0,  1000,   true],
            ["restricted",  "Restricted",   "Checkbox", false, false,       0,  0,      false],
            ["price",       "Price",        "Currency", false, 0.0,         0,  0,      true],
            ["date_release", "Date of Release", "Date", false, "date('Y-m-d')", 0, 0,   false],
            ["time_started", "Start Time",  "Datetime", false, "date('Y-m-d H:i:s')", 0, 0, false],
            ["weight",      "Weight",       "Decimal",  false, 0.0,         0,  20,     true],
            ["publisher",   "Publisher",    "Dropdown", false, "Marvel",    0,  0,      false, ["Bloomsbury","Marvel","Universal"]],
            ["publisher",   "Publisher",    "Dropdown", false, 3,           0,  0,      false, "@publishers"],
            ["email",       "Email",        "Email",    false, "",          0,  0,      false],
            ["file",        "File",         "File",     false, "",          0,  256,    false],
            ["weight",      "Weight",       "Float",    false, 0.0,         0,  20.00,  true],
            ["biography",   "Biography",    "HTML",     false, "<p>This is description</p>", 0, 0, true],
            ["profile_image", "Profile Image", "Image", false, "img_path.jpg", 0, 256,  false],
            ["pages",       "Pages",        "Integer",  false, 0,           0,  5000,   false],
            ["mobile",      "Mobile",       "Mobile",   false, "+91  8888888888", 0, 20,false],
            ["media_type",  "Media Type",   "Multiselect", false, ["Audiobook"], 0, 0,  false, ["Print","Audiobook","E-book"]],
            ["media_type",  "Media Type",   "Multiselect", false, [2,3],    0,  0,      false, "@media_types"],
            ["name",        "Name",         "Name",     false, "John Doe",  5,  256,    true],
            ["password",    "Password",     "Password", false, "",          6,  256,    true],
            ["status",      "Status",       "Radio",    false, "Published", 0,  0,      false, ["Draft","Published","Unpublished"]],
            ["author",      "Author",       "String",   false, "JRR Tolkien", 0, 256,   true],
            ["genre",       "Genre",        "Taginput", false, ["Fantacy","Adventure"], 0, 0, false],
            ["description", "Description",  "Textarea", false, "",          0,  1000,   false],
            ["short_intro", "Introduction", "TextField",false, "",          5,  256,    true],
            ["website",     "Website",      "URL",      false, "http://dwij.in", 0, 0,  false],
        ]);
		*/
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        if (Schema::hasTable('acc_accounts')) {
            Schema::drop('acc_accounts');
        }
    }
}

<?php
/**
 * Migration genrated using LaraAdmin
 * Help: http://laraadmin.com
 */

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;
use Dwij\Laraadmin\Models\Module;
use Dwij\Laraadmin\Models\ModuleFields;
use App\Acc_ledger;

class CreateAccLedgersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Module::generate("Acc_ledgers", 'acc_ledgers', 'ledger_id', 'ALL',[
            ["ledger_id",           "Ledger Id",            "Integer",  false, 0,               0,  5000,   false],
            ["ledger_name",         "Ledger Name",          "String",   false, "",              0, 256,   true],
            ["ledger_type",         "Ledger Type",          "Dropdown", false, 0,               0,  0,      false, "@acc_ledger_types"],
            ["ledger_type_id",      "Ledger Type Id",       "Dropdown", false, 0,               0,  0,      false, "@acc_ledger_types"],
            ["address",             "Address",              "String",   false, "",              0, 256,   true],
            ["country_id",          "Country Id",           "Integer",  false, 0,               0,  5000,   false],
            ["currency_id",         "Currency Id",          "Integer",  false, 0,               0,  5000,   false],
            ["contact_person",      "Contact Person",       "String",   false, "",              0, 256,   true],
            ["bank_acc_type",       "Bank Account Type",    "String",   false, "",              0, 256,   true],
            ["business_type",       "Business Type",        "String",   false, "",              0, 256,   true],
            ["phone",               "Phone",                "String",   false, "",              0, 256,   true],
            ["fax",                 "Fax",                  "String",   false, "",              0, 256,   true],
            ["email",               "Email",                "String",   false, "",              0, 256,   true],
            ["remarks",             "Remarks",              "String",   false, "",              0, 256,   true],
            ["team_id",             "Team Id",              "Integer",  false, 0,               0,  5000,   false],
            ["account_id",          "Account Id",           "Integer",  false, 0,               0,  5000,   false],
            ["modified_date",       "Modified Date",        "Datetime", false, "date('Y-m-d H:i:s')", 0, 0, false],
            ["company_id",          "Company Id",           "Dropdown", false, 0,               0,  0,         false, "@companies"],
            ["user_id",             "User Id",              "Dropdown", false, 0,               0,  0,         false, "@users"],
        ]);
		
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
        if (Schema::hasTable('acc_ledgers')) {
            Schema::drop('acc_ledgers');
        }
    }
}

<?php
/**
 * Migration genrated using LaraAdmin
 * Help: http://laraadmin.com
 */

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;
use Dwij\Laraadmin\Models\Module;
use Dwij\Laraadmin\Models\ModuleFields;
use App\CsSalesInvoice;

class CreateCssalesinvoicesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Module::generate("CsSalesInvoices", 'cssalesinvoices', 'sales_invoice_no', 'CS',[
         
        ["sales_invoice_no",        "sales Invoice No",         "Name",     false, "",  0,  256,    true],
        ["date", "Date", "Date", false, "date('Y-m-d')", 0, 0,   false],
        ["party",   "Party",    "Dropdown", false, 0,           0,  0,      false, "@cspartys"],
        ["store",   "Store",    "Dropdown", false, 0,           0,  0,      true, "@csinventories"],
        ["sr_no",        "SR No",         "Name",     false, "",  0,  256,    false],


        ["item",   "Items",    "Dropdown", false, 0,           0,  0,      true, "@csitems"],
        ["category",   "Category",    "Dropdown", false, 0,           0,  0,      true, "@csitemcategories"],
        ["unit",   "Unit",    "Dropdown", false, 0,           0,  0,      true, "@cssubunittypes"],

        ["quantity",      "Quantity",       "Float",    false, 0.0,         0,  20.00,  false],
        ["sub_quantity",      "Sub Quantity",       "Float",    false, 0.0,         0,  20.00,  false], 
        ["total_quantity",      "Total Quantity",       "Float",    false, 0.0,         0,  20.00,  false], 
        ["Actual_price",       "Actual Price",        "Currency", false, 0.0,         0,  0,      true],
        ["selling_price",       "Selling  Price",        "Currency", false, 0.0,         0,  0,      true],
        ["total_selling_price",       "Total selling Price",        "Currency", false, 0.0,         0,  0,      true],
        ["grans_total_price",       "Grand Total Price",        "Currency", false, 0.0,         0,  0,      true],
        
        ["payment_status",      "Payment Status",       "Radio",    false, "Unpaid", 0,  0,      false, ["Paid","Unpaid","Due"]],
        ["due_amount",       "Due",        "Currency", false, 0.0,         0,  0,      false],
        ["detail",        "Detail",         "Name",     false, "",  5,  256,    false],
        ["user_id",             "User name",        "Dropdown", false, 0,   0,  0,    false, "@users"],
        ["do_no",   "Do No",    "Dropdown", false, 0,           0,  0,      false, "@csdumyorders"],
 
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
        if (Schema::hasTable('cssalesinvoices')) {
            Schema::drop('cssalesinvoices');
        }
    }
}

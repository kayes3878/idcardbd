<?php
/**
 * Migration genrated using LaraAdmin
 * Help: http://laraadmin.com
 */

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;
use Dwij\Laraadmin\Models\Module;
use Dwij\Laraadmin\Models\ModuleFields;
use App\JMProduceItemCategory;
use App\JMProductionItem;

class CreateJmproduceitemcategorysTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Module::generate("JMProduceItemCategorys", 'jmproduceitemcategorys', 'production_item_category', 'JM',[
        ["produ_Item",   "Item",    "Dropdown", false, 3,           0,  0,      false, "@JMProductionItems"],
        ["production_item_category",        "Category",         "Name",     false, "",  0,  256,    true],
        ["production_item_category_dis",        "Discription",         "Name",     false, "",  5,  256,    false],
        ["unit_type",   "Unit Ttype",    "Dropdown", false, 0,           0,  0,      false, "@jutemillsubunittypes"],

            
        ]);
		
        // $productionItem = Array
        // (
        //     Array('production_item' => 'Yarn-Count'),
        //     Array('production_item' => 'Loom-Production')
        // );
       
        // foreach ($productionItem as $value) {
        //     $row = new Jmproductionitem;
        //     $row->name = $value['production_item'];
        //     $row->save();
        //     };

 
        $spining = JMProductionItem::where('production_item', 'Spining')->first();
        $loom = JMProductionItem::where('production_item', 'Loom')->first();
        $SPG = JMProductionItem::where('production_item', 'SPG')->first();

        $itemcategory = Array
        (
                Array('produ_Item' => $spining->id ,'production_item_category' => '10/1'),
                Array('produ_Item' => $spining->id ,'production_item_category' => '14/1'),
                Array('produ_Item' => $spining->id ,'production_item_category' => '16/1'),
                Array('produ_Item' => $spining->id ,'production_item_category' => '20/1'),
                Array('produ_Item' => $spining->id ,'production_item_category' => '28/1'),

                Array('produ_Item' => $loom->id ,'production_item_category' => 'Loom'),
                Array('produ_Item' => $loom->id ,'production_item_category' => '11/44'),
                Array('produ_Item' => $loom->id ,'production_item_category' => '12/44'),

                Array('produ_Item' => $SPG->id ,'production_item_category' => 'SPG'),

                
        );
       
        foreach ($itemcategory as $value) {
            $row = new JMProduceItemCategory;
            $row->produ_Item = $value['produ_Item'];
            $row->production_item_category = $value['production_item_category'];
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
        if (Schema::hasTable('jmproduceitemcategorys')) {
            Schema::drop('jmproduceitemcategorys');
        }
    }
}

<?php
/**
 * Migration genrated using LaraAdmin
 * Help: http://laraadmin.com
 */

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;
use Dwij\Laraadmin\Models\Module;
use Dwij\Laraadmin\Models\ModuleFields;
use App\JuteMillItemCategory;
use App\JuteMillItem;

class CreateJuteMillItemCategoriesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Module::generate("Jute Mill Item Categories", 'jutemillitemcategories', 'category_name',  'JM',[
            ["item_id",          "Item name",    "Dropdown", false, 0,   0,  0,      false, "@jutemillitems"],
            ["category_name",        "Category",         "Name",     false, "",  0,  256,    true],
            ["sub_unit_type_id",          "Sub Unit Type",    "Dropdown", false, 0,   0,  0,      false, "@jutemillsubunittypes"],
            ["item_category_discription", "Discription",  "Textarea",  false, "",  0,  1000,   false],
            ["user_id",          "User name",    "Dropdown", false, 0,   0,  0,      false, "@users"],
        ]);
        

           
        $jutes = JuteMillItem::where('item_name', 'Jute')->first();
        $oils = JuteMillItem::where('item_name', 'Oil')->first();

        $itemcategory = Array
        (
                Array('item_id' => $jutes->id ,'category_name' => 'White jute','item_category_discription' => 'White raw jute originated centuries ago in the poorer regions of India and was first used to make clothing for villagers and farmers. When trying to locate white raw jute for personal or industrial use, it is also known as "bangla white." Since them, white raw jute has grown in personal and industrial use. White raw jute is traditionally used to make products such as yarn, twine and rope. The grades of this type of jute are bangla white A, B, C, D and R.'),
                Array('item_id' => $jutes->id ,'category_name' => 'Tossa jute','item_category_discription' => 'Tossa raw jute and white raw jute are the most commonly found types of jute and are grown where climate permits in India. Tossa raw jute is silkier and much stronger than white raw jute; because of its extra strength, it is also used to make bags such as gunny sacks and clothing. Tossa raw jute is also available in grades A though E.'),
                Array('item_id' => $jutes->id ,'category_name' => 'Mesta Raw Jute','item_category_discription' => 'Cuttings are considered the lowest grade of jute. Like other harvested products, cuttings are often the left over jute of other grades and can be a mixture of leftovers. Jute cuttings are most often used to make paper products; less often, jute cuttings are used to make bags, ropes or other goods, as these products are not as strong. Both white raw jute and tossa raw jute cuttings are available in grades A and B.'),
                Array('item_id' => $jutes->id ,'category_name' => 'Jute Cuttings','item_category_discription' => 'Cuttings are considered the lowest grade of jute. Like other harvested products, cuttings are often the left over jute of other grades and can be a mixture of leftovers. Jute cuttings are most often used to make paper products; less often, jute cuttings are used to make bags, ropes or other goods, as these products are not as strong. Both white raw jute and tossa raw jute cuttings are available in grades A and B.'),
                Array('item_id' => $oils->id ,'category_name' => 'JB Oil','item_category_discription' => 'JB Oil'),
        );
       
        foreach ($itemcategory as $value) {
            $row = new JuteMillItemCategory;
            $row->item_id = $value['item_id'];
            $row->category_name = $value['category_name'];
            $row->item_category_discription = $value['item_category_discription'];
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
        if (Schema::hasTable('jute_mill_item_categories')) {
            Schema::drop('jute_mill_item_categories');
        }
    }
}

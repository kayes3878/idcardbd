<?php
/**
 * Controller genrated using LaraAdmin
 * Help: http://laraadmin.com
 */

namespace App\Http\Controllers\LA;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Http\Requests;
use Auth;
use DB;
use Validator;
use Datatables;
use Collective\Html\FormFacade as Form;
use Dwij\Laraadmin\Models\Module;

use App\JuteMillItemCategory;

class JuteMillItemCategoriesController extends Controller
{
    public $show_action = true;
    public $view_col = 'category_name';
    public $listing_cols = ['id', 'item_id', 'category_name', 'sub_unit_type_id', 'item_category_discription', 'user_id'];
    
    public function __construct() {
        // for authentication (optional)
        $this->middleware('auth');
    }
    
    /**
     * Display a listing of the JuteMillItemCategories.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $module = Module::get('JuteMillItemCategories');
        
        return View('la.jutemillitemcategories.index', [
            'show_actions' => $this->show_action,
            'listing_cols' => $this->listing_cols,
            'module' => $module
        ]);
    }

    /**
     * Show the form for creating a new jutemillitemcategory.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created jutemillitemcategory in database.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $rules = Module::validateRules("JuteMillItemCategories", $request);
        
        $validator = Validator::make($request->all(), $rules);
        
        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput();
        }
            
        $insert_id = Module::insert("JuteMillItemCategories", $request);
        
        return redirect()->route(config('laraadmin.adminRoute') . '.jutemillitemcategories.index');
    }

    /**
     * Display the specified jutemillitemcategory.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $jutemillitemcategory = JuteMillItemCategory::find($id);
        $module = Module::get('JuteMillItemCategories');
        $module->row = $jutemillitemcategory;
        return view('la.jutemillitemcategories.show', [
            'module' => $module,
            'view_col' => $this->view_col,
            'no_header' => true,
            'no_padding' => "no-padding"
        ])->with('jutemillitemcategory', $jutemillitemcategory);
    }

    /**
     * Show the form for editing the specified jutemillitemcategory.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $jutemillitemcategory = JuteMillItemCategory::find($id);
        
        $module = Module::get('JuteMillItemCategories');
        
        $module->row = $jutemillitemcategory;
        
        return view('la.jutemillitemcategories.edit', [
            'module' => $module,
            'view_col' => $this->view_col,
        ])->with('jutemillitemcategory', $jutemillitemcategory);
    }

    /**
     * Update the specified jutemillitemcategory in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $rules = Module::validateRules("JuteMillItemCategories", $request);
        
        $validator = Validator::make($request->all(), $rules);
        
        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput();;
        }
        
        $insert_id = Module::updateRow("JuteMillItemCategories", $request, $id);
        
        return redirect()->route(config('laraadmin.adminRoute') . '.jutemillitemcategories.index');
    }

    /**
     * Remove the specified jutemillitemcategory from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        JuteMillItemCategory::find($id)->delete();
        // Redirecting to index() method
        return redirect()->route(config('laraadmin.adminRoute') . '.jutemillitemcategories.index');
    }
    
    /**
     * Datatable Ajax fetch
     *
     * @return
     */
    public function dtajax()
    {
        $users = DB::table('jutemillitemcategories')->select($this->listing_cols);
        $out = Datatables::of($users)->make();
        $data = $out->getData();
        
        for($i=0; $i<count($data->data); $i++) {
            for ($j=0; $j < count($this->listing_cols); $j++) { 
                $col = $this->listing_cols[$j];
                if($col == $this->view_col) {
                    $data->data[$i][$j] = '<a href="'.url(config('laraadmin.adminRoute') . '/jutemillitemcategories/'.$data->data[$i][0]).'">'.$data->data[$i][$j].'</a>';
                }
                // else if($col == "author") {
                //    $data->data[$i][$j];
                // }
            }
            if($this->show_action) {
                $output = '<a href="'.url(config('laraadmin.adminRoute') . '/jutemillitemcategories/'.$data->data[$i][0].'/edit').'" class="btn btn-warning btn-xs" style="display:inline;padding:2px 5px 3px 5px;"><i class="fa fa-edit"></i></a>';
                $output .= Form::open(['route' => [config('laraadmin.adminRoute') . '.jutemillitemcategories.destroy', $data->data[$i][0]], 'method' => 'delete', 'style'=>'display:inline']);
                $output .= ' <button class="btn btn-danger btn-xs" type="submit"><i class="fa fa-times"></i></button>';
                $output .= Form::close();
                $data->data[$i][] = (string)$output;
            }
        }
        $out->setData($data);
        return $out;
    }

    public function jute_sub_item($itemid)
    {
        $itemchatacory = JuteMillItemCategory::where('item_id' , $itemid)->get();
        return response()->json($itemchatacory);
    }
}

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

use App\JMProduceItemCategory;

class JMProduceItemCategorysController extends Controller
{
    public $show_action = true;
    public $view_col = 'production_item_category';
    public $listing_cols = ['id', 'produ_Item', 'production_item_category', 'production_item_category_dis', 'unit_type'];
    
    public function __construct() {
        // for authentication (optional)
        $this->middleware('auth');
    }
    
    /**
     * Display a listing of the JMProduceItemCategorys.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $module = Module::get('JMProduceItemCategorys');
        
        return View('la.jmproduceitemcategorys.index', [
            'show_actions' => $this->show_action,
            'listing_cols' => $this->listing_cols,
            'module' => $module
        ]);
    }

    /**
     * Show the form for creating a new jmproduceitemcategory.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created jmproduceitemcategory in database.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $rules = Module::validateRules("JMProduceItemCategorys", $request);
        
        $validator = Validator::make($request->all(), $rules);
        
        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput();
        }
            
        $insert_id = Module::insert("JMProduceItemCategorys", $request);
        
        return redirect()->route(config('laraadmin.adminRoute') . '.jmproduceitemcategorys.index');
    }

    /**
     * Display the specified jmproduceitemcategory.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $jmproduceitemcategory = JMProduceItemCategory::find($id);
        $module = Module::get('JMProduceItemCategorys');
        $module->row = $jmproduceitemcategory;
        return view('la.jmproduceitemcategorys.show', [
            'module' => $module,
            'view_col' => $this->view_col,
            'no_header' => true,
            'no_padding' => "no-padding"
        ])->with('jmproduceitemcategory', $jmproduceitemcategory);
    }

    /**
     * Show the form for editing the specified jmproduceitemcategory.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $jmproduceitemcategory = JMProduceItemCategory::find($id);
        
        $module = Module::get('JMProduceItemCategorys');
        
        $module->row = $jmproduceitemcategory;
        
        return view('la.jmproduceitemcategorys.edit', [
            'module' => $module,
            'view_col' => $this->view_col,
        ])->with('jmproduceitemcategory', $jmproduceitemcategory);
    }

    /**
     * Update the specified jmproduceitemcategory in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $rules = Module::validateRules("JMProduceItemCategorys", $request);
        
        $validator = Validator::make($request->all(), $rules);
        
        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput();;
        }
        
        $insert_id = Module::updateRow("JMProduceItemCategorys", $request, $id);
        
        return redirect()->route(config('laraadmin.adminRoute') . '.jmproduceitemcategorys.index');
    }

    /**
     * Remove the specified jmproduceitemcategory from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        JMProduceItemCategory::find($id)->delete();
        // Redirecting to index() method
        return redirect()->route(config('laraadmin.adminRoute') . '.jmproduceitemcategorys.index');
    }
    
    /**
     * Datatable Ajax fetch
     *
     * @return
     */
    public function dtajax()
    {
        $users = DB::table('jmproduceitemcategorys')->select($this->listing_cols);
        $out = Datatables::of($users)->make();
        $data = $out->getData();
        
        for($i=0; $i<count($data->data); $i++) {
            for ($j=0; $j < count($this->listing_cols); $j++) { 
                $col = $this->listing_cols[$j];
                if($col == $this->view_col) {
                    $data->data[$i][$j] = '<a href="'.url(config('laraadmin.adminRoute') . '/jmproduceitemcategorys/'.$data->data[$i][0]).'">'.$data->data[$i][$j].'</a>';
                }
                // else if($col == "author") {
                //    $data->data[$i][$j];
                // }
            }
            if($this->show_action) {
                $output = '<a href="'.url(config('laraadmin.adminRoute') . '/jmproduceitemcategorys/'.$data->data[$i][0].'/edit').'" class="btn btn-warning btn-xs" style="display:inline;padding:2px 5px 3px 5px;"><i class="fa fa-edit"></i></a>';
                $output .= Form::open(['route' => [config('laraadmin.adminRoute') . '.jmproduceitemcategorys.destroy', $data->data[$i][0]], 'method' => 'delete', 'style'=>'display:inline']);
                $output .= ' <button class="btn btn-danger btn-xs" type="submit"><i class="fa fa-times"></i></button>';
                $output .= Form::close();
                $data->data[$i][] = (string)$output;
            }
        }
        $out->setData($data);
        return $out;
    }

    public function jm_production_item_chat($itemid)
    {
        $itemchatacory = JMProduceItemCategory::where('produ_Item' , $itemid)->get();
        return response()->json($itemchatacory);
    }
}

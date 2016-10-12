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

use App\JMProductionline;

class JMProductionlinesController extends Controller
{
    public $show_action = true;
    public $view_col = 'stock_code';
    public $listing_cols = ['id', 'stock_code', 'date', 'item_id', 'item_categorie_id', 'unit_type', 'sub_unit_type', 'quantity', 'sub_unit_quantity', 'total_quantity', 'stock_in_store', 'stock_from', 'parent_id', 'isProcessJute', 'process_jute', 'process_quantity', 'process_sub_unit_quantity', 'process_total_quantity', 'process_stock_in_store', 'isInStock', 'user_id'];
    
    public function __construct() {
        // for authentication (optional)
        $this->middleware('auth');
    }
    
    /**
     * Display a listing of the JMProductionlines.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $module = Module::get('JMProductionlines');
        
        return View('la.jmproductionlines.index', [
            'show_actions' => $this->show_action,
            'listing_cols' => $this->listing_cols,
            'module' => $module
        ]);
    }

    /**
     * Show the form for creating a new jmproductionline.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created jmproductionline in database.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $rules = Module::validateRules("JMProductionlines", $request);
        
        $validator = Validator::make($request->all(), $rules);
        
        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput();
        }
            
        $insert_id = Module::insert("JMProductionlines", $request);
        
        return redirect()->route(config('laraadmin.adminRoute') . '.jmproductionlines.index');
    }

    /**
     * Display the specified jmproductionline.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $jmproductionline = JMProductionline::find($id);
        $module = Module::get('JMProductionlines');
        $module->row = $jmproductionline;
        return view('la.jmproductionlines.show', [
            'module' => $module,
            'view_col' => $this->view_col,
            'no_header' => true,
            'no_padding' => "no-padding"
        ])->with('jmproductionline', $jmproductionline);
    }

    /**
     * Show the form for editing the specified jmproductionline.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $jmproductionline = JMProductionline::find($id);
        
        $module = Module::get('JMProductionlines');
        
        $module->row = $jmproductionline;
        
        return view('la.jmproductionlines.edit', [
            'module' => $module,
            'view_col' => $this->view_col,
        ])->with('jmproductionline', $jmproductionline);
    }

    /**
     * Update the specified jmproductionline in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $rules = Module::validateRules("JMProductionlines", $request);
        
        $validator = Validator::make($request->all(), $rules);
        
        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput();;
        }
        
        $insert_id = Module::updateRow("JMProductionlines", $request, $id);
        
        return redirect()->route(config('laraadmin.adminRoute') . '.jmproductionlines.index');
    }

    /**
     * Remove the specified jmproductionline from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        JMProductionline::find($id)->delete();
        // Redirecting to index() method
        return redirect()->route(config('laraadmin.adminRoute') . '.jmproductionlines.index');
    }
    
    /**
     * Datatable Ajax fetch
     *
     * @return
     */
    public function dtajax()
    {
        $users = DB::table('jmproductionlines')->select($this->listing_cols);
        $out = Datatables::of($users)->make();
        $data = $out->getData();
        
        for($i=0; $i<count($data->data); $i++) {
            for ($j=0; $j < count($this->listing_cols); $j++) { 
                $col = $this->listing_cols[$j];
                if($col == $this->view_col) {
                    $data->data[$i][$j] = '<a href="'.url(config('laraadmin.adminRoute') . '/jmproductionlines/'.$data->data[$i][0]).'">'.$data->data[$i][$j].'</a>';
                }
                // else if($col == "author") {
                //    $data->data[$i][$j];
                // }
            }
            if($this->show_action) {
                $output = '<a href="'.url(config('laraadmin.adminRoute') . '/jmproductionlines/'.$data->data[$i][0].'/edit').'" class="btn btn-warning btn-xs" style="display:inline;padding:2px 5px 3px 5px;"><i class="fa fa-edit"></i></a>';
                $output .= Form::open(['route' => [config('laraadmin.adminRoute') . '.jmproductionlines.destroy', $data->data[$i][0]], 'method' => 'delete', 'style'=>'display:inline']);
                $output .= ' <button class="btn btn-danger btn-xs" type="submit"><i class="fa fa-times"></i></button>';
                $output .= Form::close();
                $data->data[$i][] = (string)$output;
            }
        }
        $out->setData($data);
        return $out;
    }
}

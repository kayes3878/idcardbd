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

use App\JMProduceDistribution;

class JMProduceDistributionsController extends Controller
{
    public $show_action = true;
    public $view_col = 'serial';
    public $listing_cols = ['id', 'serial', 'date', 'item', 'categorys', 'production_inventory_id', 'distribute_to', 'unit_type', 'sun_unit_type', 'quantity', 'sub_quantity', 'user_id'];
    
    public function __construct() {
        // for authentication (optional)
        $this->middleware('auth');
    }
    
    /**
     * Display a listing of the JMProduceDistributions.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $module = Module::get('JMProduceDistributions');
        
        return View('la.jmproducedistributions.index', [
            'show_actions' => $this->show_action,
            'listing_cols' => $this->listing_cols,
            'module' => $module
        ]);
    }

    /**
     * Show the form for creating a new jmproducedistribution.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created jmproducedistribution in database.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $rules = Module::validateRules("JMProduceDistributions", $request);
        
        $validator = Validator::make($request->all(), $rules);
        
        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput();
        }
            
        $insert_id = Module::insert("JMProduceDistributions", $request);
        
        return redirect()->route(config('laraadmin.adminRoute') . '.jmproducedistributions.index');
    }

    /**
     * Display the specified jmproducedistribution.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $jmproducedistribution = JMProduceDistribution::find($id);
        $module = Module::get('JMProduceDistributions');
        $module->row = $jmproducedistribution;
        return view('la.jmproducedistributions.show', [
            'module' => $module,
            'view_col' => $this->view_col,
            'no_header' => true,
            'no_padding' => "no-padding"
        ])->with('jmproducedistribution', $jmproducedistribution);
    }

    /**
     * Show the form for editing the specified jmproducedistribution.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $jmproducedistribution = JMProduceDistribution::find($id);
        
        $module = Module::get('JMProduceDistributions');
        
        $module->row = $jmproducedistribution;
        
        return view('la.jmproducedistributions.edit', [
            'module' => $module,
            'view_col' => $this->view_col,
        ])->with('jmproducedistribution', $jmproducedistribution);
    }

    /**
     * Update the specified jmproducedistribution in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $rules = Module::validateRules("JMProduceDistributions", $request);
        
        $validator = Validator::make($request->all(), $rules);
        
        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput();;
        }
        
        $insert_id = Module::updateRow("JMProduceDistributions", $request, $id);
        
        return redirect()->route(config('laraadmin.adminRoute') . '.jmproducedistributions.index');
    }

    /**
     * Remove the specified jmproducedistribution from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        JMProduceDistribution::find($id)->delete();
        // Redirecting to index() method
        return redirect()->route(config('laraadmin.adminRoute') . '.jmproducedistributions.index');
    }
    
    /**
     * Datatable Ajax fetch
     *
     * @return
     */
    public function dtajax()
    {
        $users = DB::table('jmproducedistributions')->select($this->listing_cols);
        $out = Datatables::of($users)->make();
        $data = $out->getData();
        
        for($i=0; $i<count($data->data); $i++) {
            for ($j=0; $j < count($this->listing_cols); $j++) { 
                $col = $this->listing_cols[$j];
                if($col == $this->view_col) {
                    $data->data[$i][$j] = '<a href="'.url(config('laraadmin.adminRoute') . '/jmproducedistributions/'.$data->data[$i][0]).'">'.$data->data[$i][$j].'</a>';
                }
                // else if($col == "author") {
                //    $data->data[$i][$j];
                // }
            }
            if($this->show_action) {
                $output = '<a href="'.url(config('laraadmin.adminRoute') . '/jmproducedistributions/'.$data->data[$i][0].'/edit').'" class="btn btn-warning btn-xs" style="display:inline;padding:2px 5px 3px 5px;"><i class="fa fa-edit"></i></a>';
                $output .= Form::open(['route' => [config('laraadmin.adminRoute') . '.jmproducedistributions.destroy', $data->data[$i][0]], 'method' => 'delete', 'style'=>'display:inline']);
                $output .= ' <button class="btn btn-danger btn-xs" type="submit"><i class="fa fa-times"></i></button>';
                $output .= Form::close();
                $data->data[$i][] = (string)$output;
            }
        }
        $out->setData($data);
        return $out;
    }
}

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

use App\AccTransactionMethod;

class AccTransactionMethodsController extends Controller
{
    public $show_action = true;
    public $view_col = 'trans_method_id';
    public $listing_cols = ['id', 'trans_method_id', 'method_tile'];
    
    public function __construct() {
        // for authentication (optional)
        $this->middleware('auth');
    }
    
    /**
     * Display a listing of the AccTransactionMethods.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $module = Module::get('AccTransactionMethods');
        
        return View('la.acctransactionmethods.index', [
            'show_actions' => $this->show_action,
            'listing_cols' => $this->listing_cols,
            'module' => $module
        ]);
    }

    /**
     * Show the form for creating a new acctransactionmethod.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created acctransactionmethod in database.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $rules = Module::validateRules("AccTransactionMethods", $request);
        
        $validator = Validator::make($request->all(), $rules);
        
        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput();
        }
            
        $insert_id = Module::insert("AccTransactionMethods", $request);
        
        return redirect()->route(config('laraadmin.adminRoute') . '.acctransactionmethods.index');
    }

    /**
     * Display the specified acctransactionmethod.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $acctransactionmethod = AccTransactionMethod::find($id);
        $module = Module::get('AccTransactionMethods');
        $module->row = $acctransactionmethod;
        return view('la.acctransactionmethods.show', [
            'module' => $module,
            'view_col' => $this->view_col,
            'no_header' => true,
            'no_padding' => "no-padding"
        ])->with('acctransactionmethod', $acctransactionmethod);
    }

    /**
     * Show the form for editing the specified acctransactionmethod.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $acctransactionmethod = AccTransactionMethod::find($id);
        
        $module = Module::get('AccTransactionMethods');
        
        $module->row = $acctransactionmethod;
        
        return view('la.acctransactionmethods.edit', [
            'module' => $module,
            'view_col' => $this->view_col,
        ])->with('acctransactionmethod', $acctransactionmethod);
    }

    /**
     * Update the specified acctransactionmethod in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $rules = Module::validateRules("AccTransactionMethods", $request);
        
        $validator = Validator::make($request->all(), $rules);
        
        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput();;
        }
        
        $insert_id = Module::updateRow("AccTransactionMethods", $request, $id);
        
        return redirect()->route(config('laraadmin.adminRoute') . '.acctransactionmethods.index');
    }

    /**
     * Remove the specified acctransactionmethod from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        AccTransactionMethod::find($id)->delete();
        // Redirecting to index() method
        return redirect()->route(config('laraadmin.adminRoute') . '.acctransactionmethods.index');
    }
    
    /**
     * Datatable Ajax fetch
     *
     * @return
     */
    public function dtajax()
    {
        $users = DB::table('acctransactionmethods')->select($this->listing_cols);
        $out = Datatables::of($users)->make();
        $data = $out->getData();
        
        for($i=0; $i<count($data->data); $i++) {
            for ($j=0; $j < count($this->listing_cols); $j++) { 
                $col = $this->listing_cols[$j];
                if($col == $this->view_col) {
                    $data->data[$i][$j] = '<a href="'.url(config('laraadmin.adminRoute') . '/acctransactionmethods/'.$data->data[$i][0]).'">'.$data->data[$i][$j].'</a>';
                }
                // else if($col == "author") {
                //    $data->data[$i][$j];
                // }
            }
            if($this->show_action) {
                $output = '<a href="'.url(config('laraadmin.adminRoute') . '/acctransactionmethods/'.$data->data[$i][0].'/edit').'" class="btn btn-warning btn-xs" style="display:inline;padding:2px 5px 3px 5px;"><i class="fa fa-edit"></i></a>';
                $output .= Form::open(['route' => [config('laraadmin.adminRoute') . '.acctransactionmethods.destroy', $data->data[$i][0]], 'method' => 'delete', 'style'=>'display:inline']);
                $output .= ' <button class="btn btn-danger btn-xs" type="submit"><i class="fa fa-times"></i></button>';
                $output .= Form::close();
                $data->data[$i][] = (string)$output;
            }
        }
        $out->setData($data);
        return $out;
    }
}

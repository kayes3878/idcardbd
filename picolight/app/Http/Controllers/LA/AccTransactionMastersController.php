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

use App\AccTransactionMaster;

class AccTransactionMastersController extends Controller
{
    public $show_action = true;
    public $view_col = 'voucher_no';
    public $listing_cols = ['id', 'trans_ma_id', 'trans_date', 'voucher_no', 'voucher_payee', 'method_ref_id', 'method_ref_no', 'trans_description', 'approved_by', 'approved_date', 'modified_date', 'module', 'company_id', 'user_id', 'voucher_type', 'trans_method_id'];
    
    public function __construct() {
        // for authentication (optional)
        $this->middleware('auth');
    }
    
    /**
     * Display a listing of the AccTransactionMasters.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $module = Module::get('AccTransactionMasters');
        
        return View('la.acctransactionmasters.index', [
            'show_actions' => $this->show_action,
            'listing_cols' => $this->listing_cols,
            'module' => $module
        ]);
    }

    /**
     * Show the form for creating a new acctransactionmaster.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created acctransactionmaster in database.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $rules = Module::validateRules("AccTransactionMasters", $request);
        
        $validator = Validator::make($request->all(), $rules);
        
        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput();
        }
            
        $insert_id = Module::insert("AccTransactionMasters", $request);
        
        return redirect()->route(config('laraadmin.adminRoute') . '.acctransactionmasters.index');
    }

    /**
     * Display the specified acctransactionmaster.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $acctransactionmaster = AccTransactionMaster::find($id);
        $module = Module::get('AccTransactionMasters');
        $module->row = $acctransactionmaster;
        return view('la.acctransactionmasters.show', [
            'module' => $module,
            'view_col' => $this->view_col,
            'no_header' => true,
            'no_padding' => "no-padding"
        ])->with('acctransactionmaster', $acctransactionmaster);
    }

    /**
     * Show the form for editing the specified acctransactionmaster.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $acctransactionmaster = AccTransactionMaster::find($id);
        
        $module = Module::get('AccTransactionMasters');
        
        $module->row = $acctransactionmaster;
        
        return view('la.acctransactionmasters.edit', [
            'module' => $module,
            'view_col' => $this->view_col,
        ])->with('acctransactionmaster', $acctransactionmaster);
    }

    /**
     * Update the specified acctransactionmaster in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $rules = Module::validateRules("AccTransactionMasters", $request);
        
        $validator = Validator::make($request->all(), $rules);
        
        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput();;
        }
        
        $insert_id = Module::updateRow("AccTransactionMasters", $request, $id);
        
        return redirect()->route(config('laraadmin.adminRoute') . '.acctransactionmasters.index');
    }

    /**
     * Remove the specified acctransactionmaster from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        AccTransactionMaster::find($id)->delete();
        // Redirecting to index() method
        return redirect()->route(config('laraadmin.adminRoute') . '.acctransactionmasters.index');
    }
    
    /**
     * Datatable Ajax fetch
     *
     * @return
     */
    public function dtajax()
    {
        $users = DB::table('acctransactionmasters')->select($this->listing_cols);
        $out = Datatables::of($users)->make();
        $data = $out->getData();
        
        for($i=0; $i<count($data->data); $i++) {
            for ($j=0; $j < count($this->listing_cols); $j++) { 
                $col = $this->listing_cols[$j];
                if($col == $this->view_col) {
                    $data->data[$i][$j] = '<a href="'.url(config('laraadmin.adminRoute') . '/acctransactionmasters/'.$data->data[$i][0]).'">'.$data->data[$i][$j].'</a>';
                }
                // else if($col == "author") {
                //    $data->data[$i][$j];
                // }
            }
            if($this->show_action) {
                $output = '<a href="'.url(config('laraadmin.adminRoute') . '/acctransactionmasters/'.$data->data[$i][0].'/edit').'" class="btn btn-warning btn-xs" style="display:inline;padding:2px 5px 3px 5px;"><i class="fa fa-edit"></i></a>';
                $output .= Form::open(['route' => [config('laraadmin.adminRoute') . '.acctransactionmasters.destroy', $data->data[$i][0]], 'method' => 'delete', 'style'=>'display:inline']);
                $output .= ' <button class="btn btn-danger btn-xs" type="submit"><i class="fa fa-times"></i></button>';
                $output .= Form::close();
                $data->data[$i][] = (string)$output;
            }
        }
        $out->setData($data);
        return $out;
    }
}

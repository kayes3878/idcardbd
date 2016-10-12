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

use App\AccTransactionDetail;

class AccTransactionDetailsController extends Controller
{
    public $show_action = true;
    public $view_col = 'trans_d_id';
    public $listing_cols = ['id', 'trans_d_id', 'trans_m_id', 'account_id', 'credit_amt', 'debit_amt', 'comments', 'company_id', 'user_id'];
    
    public function __construct() {
        // for authentication (optional)
        $this->middleware('auth');
    }
    
    /**
     * Display a listing of the AccTransactionDetails.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $module = Module::get('AccTransactionDetails');
        
        return View('la.acctransactiondetails.index', [
            'show_actions' => $this->show_action,
            'listing_cols' => $this->listing_cols,
            'module' => $module
        ]);
    }

    /**
     * Show the form for creating a new acctransactiondetail.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created acctransactiondetail in database.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $rules = Module::validateRules("AccTransactionDetails", $request);
        
        $validator = Validator::make($request->all(), $rules);
        
        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput();
        }
            
        $insert_id = Module::insert("AccTransactionDetails", $request);
        
        return redirect()->route(config('laraadmin.adminRoute') . '.acctransactiondetails.index');
    }

    /**
     * Display the specified acctransactiondetail.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $acctransactiondetail = AccTransactionDetail::find($id);
        $module = Module::get('AccTransactionDetails');
        $module->row = $acctransactiondetail;
        return view('la.acctransactiondetails.show', [
            'module' => $module,
            'view_col' => $this->view_col,
            'no_header' => true,
            'no_padding' => "no-padding"
        ])->with('acctransactiondetail', $acctransactiondetail);
    }

    /**
     * Show the form for editing the specified acctransactiondetail.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $acctransactiondetail = AccTransactionDetail::find($id);
        
        $module = Module::get('AccTransactionDetails');
        
        $module->row = $acctransactiondetail;
        
        return view('la.acctransactiondetails.edit', [
            'module' => $module,
            'view_col' => $this->view_col,
        ])->with('acctransactiondetail', $acctransactiondetail);
    }

    /**
     * Update the specified acctransactiondetail in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $rules = Module::validateRules("AccTransactionDetails", $request);
        
        $validator = Validator::make($request->all(), $rules);
        
        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput();;
        }
        
        $insert_id = Module::updateRow("AccTransactionDetails", $request, $id);
        
        return redirect()->route(config('laraadmin.adminRoute') . '.acctransactiondetails.index');
    }

    /**
     * Remove the specified acctransactiondetail from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        AccTransactionDetail::find($id)->delete();
        // Redirecting to index() method
        return redirect()->route(config('laraadmin.adminRoute') . '.acctransactiondetails.index');
    }
    
    /**
     * Datatable Ajax fetch
     *
     * @return
     */
    public function dtajax()
    {
        $users = DB::table('acctransactiondetails')->select($this->listing_cols);
        $out = Datatables::of($users)->make();
        $data = $out->getData();
        
        for($i=0; $i<count($data->data); $i++) {
            for ($j=0; $j < count($this->listing_cols); $j++) { 
                $col = $this->listing_cols[$j];
                if($col == $this->view_col) {
                    $data->data[$i][$j] = '<a href="'.url(config('laraadmin.adminRoute') . '/acctransactiondetails/'.$data->data[$i][0]).'">'.$data->data[$i][$j].'</a>';
                }
                // else if($col == "author") {
                //    $data->data[$i][$j];
                // }
            }
            if($this->show_action) {
                $output = '<a href="'.url(config('laraadmin.adminRoute') . '/acctransactiondetails/'.$data->data[$i][0].'/edit').'" class="btn btn-warning btn-xs" style="display:inline;padding:2px 5px 3px 5px;"><i class="fa fa-edit"></i></a>';
                $output .= Form::open(['route' => [config('laraadmin.adminRoute') . '.acctransactiondetails.destroy', $data->data[$i][0]], 'method' => 'delete', 'style'=>'display:inline']);
                $output .= ' <button class="btn btn-danger btn-xs" type="submit"><i class="fa fa-times"></i></button>';
                $output .= Form::close();
                $data->data[$i][] = (string)$output;
            }
        }
        $out->setData($data);
        return $out;
    }
}

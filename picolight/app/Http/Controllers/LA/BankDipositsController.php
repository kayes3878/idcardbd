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

use App\BankDiposit;

class BankDipositsController extends Controller
{
    public $show_action = true;
    public $view_col = 'bank_account_id';
    public $listing_cols = ['id', 'diposit_no', 'bank_account_id', 'diposit_date', 'diposit_type', 'diposited_branch', 'diposited_by', 'tranjection_reference_no', 'diposit_from', 'cheque_no', 'amount', 'grand_total', 'user_id'];
    
    public function __construct() {
        // for authentication (optional)
        $this->middleware('auth');
    }
    
    /**
     * Display a listing of the BankDiposits.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $module = Module::get('BankDiposits');
        
        return View('la.bankdiposits.index', [
            'show_actions' => $this->show_action,
            'listing_cols' => $this->listing_cols,
            'module' => $module
        ]);
    }

    /**
     * Show the form for creating a new bankdiposit.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created bankdiposit in database.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $rules = Module::validateRules("BankDiposits", $request);
        
        $validator = Validator::make($request->all(), $rules);
        
        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput();
        }
            
        $insert_id = Module::insert("BankDiposits", $request);
        
        return redirect()->route(config('laraadmin.adminRoute') . '.bankdiposits.index');
    }

    /**
     * Display the specified bankdiposit.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $bankdiposit = BankDiposit::find($id);
        $module = Module::get('BankDiposits');
        $module->row = $bankdiposit;
        return view('la.bankdiposits.show', [
            'module' => $module,
            'view_col' => $this->view_col,
            'no_header' => true,
            'no_padding' => "no-padding"
        ])->with('bankdiposit', $bankdiposit);
    }

    /**
     * Show the form for editing the specified bankdiposit.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $bankdiposit = BankDiposit::find($id);
        
        $module = Module::get('BankDiposits');
        
        $module->row = $bankdiposit;
        
        return view('la.bankdiposits.edit', [
            'module' => $module,
            'view_col' => $this->view_col,
        ])->with('bankdiposit', $bankdiposit);
    }

    /**
     * Update the specified bankdiposit in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $rules = Module::validateRules("BankDiposits", $request);
        
        $validator = Validator::make($request->all(), $rules);
        
        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput();;
        }
        
        $insert_id = Module::updateRow("BankDiposits", $request, $id);
        
        return redirect()->route(config('laraadmin.adminRoute') . '.bankdiposits.index');
    }

    /**
     * Remove the specified bankdiposit from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        BankDiposit::find($id)->delete();
        // Redirecting to index() method
        return redirect()->route(config('laraadmin.adminRoute') . '.bankdiposits.index');
    }
    
    /**
     * Datatable Ajax fetch
     *
     * @return
     */
    public function dtajax()
    {
        $users = DB::table('bankdiposits')->select($this->listing_cols);
        $out = Datatables::of($users)->make();
        $data = $out->getData();
        
        for($i=0; $i<count($data->data); $i++) {
            for ($j=0; $j < count($this->listing_cols); $j++) { 
                $col = $this->listing_cols[$j];
                if($col == $this->view_col) {
                    $data->data[$i][$j] = '<a href="'.url(config('laraadmin.adminRoute') . '/bankdiposits/'.$data->data[$i][0]).'">'.$data->data[$i][$j].'</a>';
                }
                // else if($col == "author") {
                //    $data->data[$i][$j];
                // }
            }
            if($this->show_action) {
                $output = '<a href="'.url(config('laraadmin.adminRoute') . '/bankdiposits/'.$data->data[$i][0].'/edit').'" class="btn btn-warning btn-xs" style="display:inline;padding:2px 5px 3px 5px;"><i class="fa fa-edit"></i></a>';
                $output .= Form::open(['route' => [config('laraadmin.adminRoute') . '.bankdiposits.destroy', $data->data[$i][0]], 'method' => 'delete', 'style'=>'display:inline']);
                $output .= ' <button class="btn btn-danger btn-xs" type="submit"><i class="fa fa-times"></i></button>';
                $output .= Form::close();
                $data->data[$i][] = (string)$output;
            }
        }
        $out->setData($data);
        return $out;
    }
}

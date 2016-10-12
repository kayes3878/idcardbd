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

use App\Debitvoucher;
use App\AccTransactionMaster;
use App\AccTransactionMethod;
use App\AccTransactionDetail;
use App\Acc_account;

class DebitvouchersController extends Controller
{
    public $show_action = true;
    public $view_col = 'trans_date';
    public $listing_cols = ['id', 'trans_date', 'voucher_no', 'voucher_type', 'trans_method_id', 'trans_description', 'approved_by', 'approved_date', 'module', 'credit_amt', 'trans_m_id', 'account_id', 'debit_amt', 'user_id'];
    
    public function __construct() {
        // for authentication (optional)
        $this->middleware('auth');
    }
    
    /**
     * Display a listing of the Debitvouchers.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $module = Module::get('Debitvouchers');
        $voucher = new AccTransactionMaster();
        $items = AccTransactionMethod::all();
        // $acc_items = Acc_account::all();
        $acc_items = Acc_account::where('acc_depth','>',1)->get();
        $xy = AccTransactionMaster::orderBy('id', 'desc')->first();
        // var_dump($xy->voucher_no);
        
        // return View('la.debitvouchers.index', [
        //     'show_actions' => $this->show_action,
        //     'listing_cols' => $this->listing_cols,
        //     'module' => $module
        // ]);
        return view('la.debitvouchers.index', [
            'vouchers' => AccTransactionMaster::orderBy('created_at', 'asc')->get(),
            'voucher' => $voucher,
            'items' => $items,
            'acc_items' => $acc_items,
            'xy' => $xy,
            'show_actions' => $this->show_action

            // 'show_actions' => $this->show_action,
            // 'listing_cols' => $this->listing_cols,
            // 'module' => $module
            // 'cold_storage_agent_registers' =>  Cold_storage_agent_register::where('agent_code', Auth::user()->id)->get()

        ]);
        
    }

    /**
     * Show the form for creating a new debitvoucher.
     *
     * @return \Illuminate\Http\Response
     */

    public function create()
    {
        //
    }

    /**
     * Store a newly created debitvoucher in database.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {   

        // $rules = Module::validateRules("Debitvouchers", $request);
        
        // $validator = Validator::make($request->all(), $rules);
        
        // if ($validator->fails()) {
        //     return redirect()->back()->withErrors($validator)->withInput();
        // }
            
        // $insert_id = Module::insert("Debitvouchers", $request);
        
        // return redirect()->route(config('laraadmin.adminRoute') . '.debitvouchers.index');

        
 $module = Module::get('Debitvouchers');
        $voucher = new AccTransactionMaster();
        $items = AccTransactionMethod::all();
        $acc_items = Acc_account::all();
        // $voucher = new AccTransactionMaster();
 


        if($voucher->id == 0)
        {
            $updatevoucher = new AccTransactionMaster();
        }
        else
        {
            $updatevoucher = AccTransactionMaster::find($voucher->id);
        }
 

        $updatevoucher->trans_date = $request->trans_date;
        $updatevoucher->voucher_no = $request->voucher_no;
        // $updatevoucher->voucher_type = 2;//Debit = 2
        $updatevoucher->trans_method_id = $request->trans_method=1;
        $updatevoucher->trans_description = $request->trans_description;
        $updatevoucher->approved_by = $request->approved_by;
        $updatevoucher->approved_date = $request->approved_date;
        $updatevoucher->module = "Voucher";
        $updatevoucher->user_id = Auth::user()->id;

        $updatevoucher->save();
        $acc_transaction_master_info = AccTransactionMaster::where('voucher_no', $updatevoucher->voucher_no)->first();



        $t_m_id = $acc_transaction_master_info->id;


    for($detial_index = 1; $detial_index <= $request->detail_max_number;$detial_index++)
        {
                 if(isset($request->account_no[$detial_index]))
                 {
                $updateT_details = new AccTransactionDetail();
                $updateT_details->credit_amt = 0;
                $updateT_details->trans_m_id = $t_m_id;
                $updateT_details->account_id = $request->account_no[$detial_index];
                $updateT_details->debit_amt = $request->debit_amt[$detial_index];
                $updateT_details->user_id = $updatevoucher->user_id;
                $updateT_details->save();
            }

        }

             $updateT_details = new AccTransactionDetail();

                $updateT_details->credit_amt = $request->total_amt;
                $updateT_details->trans_m_id = $t_m_id;
                $updateT_details->account_id = 1;
                $updateT_details->debit_amt = 0;
                $updateT_details->user_id = $updatevoucher->user_id;
                $updateT_details->save();

// test

return redirect()->route(config('laraadmin.adminRoute') . '.debitvouchers.index');









    }

    /**
     * Display the specified debitvoucher.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $debitvoucher = Debitvoucher::find($id);
        $module = Module::get('Debitvouchers');
        $module->row = $debitvoucher;
        return view('la.debitvouchers.show', [
            'module' => $module,
            'view_col' => $this->view_col,
            'no_header' => true,
            'no_padding' => "no-padding"
        ])->with('debitvoucher', $debitvoucher);
    }

    /**
     * Show the form for editing the specified debitvoucher.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $debitvoucher = Debitvoucher::find($id);
        
        $module = Module::get('Debitvouchers');
        
        $module->row = $debitvoucher;
        
        return view('la.debitvouchers.edit', [
            'module' => $module,
            'view_col' => $this->view_col,
        ])->with('debitvoucher', $debitvoucher);
    }

    /**
     * Update the specified debitvoucher in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $rules = Module::validateRules("Debitvouchers", $request);
        
        $validator = Validator::make($request->all(), $rules);
        
        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput();;
        }
        
        $insert_id = Module::updateRow("Debitvouchers", $request, $id);
        
        return redirect()->route(config('laraadmin.adminRoute') . '.debitvouchers.index');
    }

    /**
     * Remove the specified debitvoucher from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        Debitvoucher::find($id)->delete();
        // Redirecting to index() method
        return redirect()->route(config('laraadmin.adminRoute') . '.debitvouchers.index');
    }
    
    /**
     * Datatable Ajax fetch
     *
     * @return
     */
    public function dtajax()
    {
        $users = DB::table('debitvouchers')->select($this->listing_cols);
        $out = Datatables::of($users)->make();
        $data = $out->getData();
        
        for($i=0; $i<count($data->data); $i++) {
            for ($j=0; $j < count($this->listing_cols); $j++) { 
                $col = $this->listing_cols[$j];
                if($col == $this->view_col) {
                    $data->data[$i][$j] = '<a href="'.url(config('laraadmin.adminRoute') . '/debitvouchers/'.$data->data[$i][0]).'">'.$data->data[$i][$j].'</a>';
                }
                // else if($col == "author") {
                //    $data->data[$i][$j];
                // }
            }
            if($this->show_action) {
                $output = '<a href="'.url(config('laraadmin.adminRoute') . '/debitvouchers/'.$data->data[$i][0].'/edit').'" class="btn btn-warning btn-xs" style="display:inline;padding:2px 5px 3px 5px;"><i class="fa fa-edit"></i></a>';
                $output .= Form::open(['route' => [config('laraadmin.adminRoute') . '.debitvouchers.destroy', $data->data[$i][0]], 'method' => 'delete', 'style'=>'display:inline']);
                $output .= ' <button class="btn btn-danger btn-xs" type="submit"><i class="fa fa-times"></i></button>';
                $output .= Form::close();
                $data->data[$i][] = (string)$output;
            }
        }
        $out->setData($data);
        return $out;
    }
}

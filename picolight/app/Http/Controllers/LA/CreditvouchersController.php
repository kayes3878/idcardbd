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

use App\Creditvoucher;
use App\AccTransactionMaster;
use App\AccTransactionMethod;
use App\AccTransactionDetail;
use App\Acc_account;

class CreditvouchersController extends Controller
{
    public $show_action = true;
    public $view_col = 'voucher_no';
    public $listing_cols = ['id', 'trans_date', 'voucher_no', 'voucher_type', 'trans_method_id', 'trans_description', 'approved_by', 'approved_date', 'module', 'credit_amt', 'trans_m_id', 'account_id', 'debit_amt', 'user_id', 'address', 'price'];
    
    public function __construct() {
        // for authentication (optional)
        $this->middleware('auth');
    }
    
    /**
     * Display a listing of the Creditvouchers.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $module = Module::get('Creditvouchers');
        $voucher = new AccTransactionMaster();
        $items = AccTransactionMethod::all();
        // $acc_items = Acc_account::all();
        $acc_items = Acc_account::where('acc_depth','>',1)->get();
        
        // return View('la.creditvouchers.index', [
        //     'show_actions' => $this->show_action,
        //     'listing_cols' => $this->listing_cols,
        //     'module' => $module
        // ]);
        return view('la.creditvouchers.index', [
            'vouchers' => AccTransactionMaster::orderBy('created_at', 'asc')->get(),
            'voucher' => $voucher,
            'items' => $items,
            'acc_items' => $acc_items,
            'show_actions' => $this->show_action
            ]);
    }

    /**
     * Show the form for creating a new creditvoucher.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created creditvoucher in database.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        // $rules = Module::validateRules("Creditvouchers", $request);
        
        // $validator = Validator::make($request->all(), $rules);
        
        // if ($validator->fails()) {
        //     return redirect()->back()->withErrors($validator)->withInput();
        // }
            
        // $insert_id = Module::insert("Creditvouchers", $request);
        
        // return redirect()->route(config('laraadmin.adminRoute') . '.creditvouchers.index');
        $voucher = new AccTransactionMaster();
        $items = AccTransactionMethod::all();
        $acc_items = Acc_account::all();

        // $voucher = new Acc_transaction_master();
 


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
        // var_dump($t_m_id);


    for($detial_index = 1; $detial_index <= $request->detail_max_number;$detial_index++)
        {

                 // var_dump($voucher->detail_max_number);
                $updateT_details = new AccTransactionDetail();
                $updateT_details->debit_amt = 0;
                $updateT_details->trans_m_id = $t_m_id;
                $updateT_details->account_id = $request->account_no[$detial_index];
                $updateT_details->credit_amt = $request->debit_amt[$detial_index];
                $updateT_details->user_id = $updatevoucher->user_id;
                $updateT_details->save();
                // var_dump($updateT_details->credit_amt);

        }

             $updateT_details = new AccTransactionDetail();

                $updateT_details->debit_amt = $request->total_amt;
                 //var_dump($request->total_amt);
                $updateT_details->trans_m_id = $t_m_id;
                $updateT_details->account_id = 1;
                $updateT_details->credit_amt = 0;
                $updateT_details->user_id = $updatevoucher->user_id;
                $updateT_details->save();

// test

        return redirect()->route(config('laraadmin.adminRoute') . '.creditvouchers.index');
    }

    /**
     * Display the specified creditvoucher.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $creditvoucher = Creditvoucher::find($id);
        $module = Module::get('Creditvouchers');
        $module->row = $creditvoucher;
        return view('la.creditvouchers.show', [
            'module' => $module,
            'view_col' => $this->view_col,
            'no_header' => true,
            'no_padding' => "no-padding"
        ])->with('creditvoucher', $creditvoucher);
    }

    /**
     * Show the form for editing the specified creditvoucher.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $creditvoucher = Creditvoucher::find($id);
        
        $module = Module::get('Creditvouchers');
        
        $module->row = $creditvoucher;
        
        return view('la.creditvouchers.edit', [
            'module' => $module,
            'view_col' => $this->view_col,
        ])->with('creditvoucher', $creditvoucher);
    }

    /**
     * Update the specified creditvoucher in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $rules = Module::validateRules("Creditvouchers", $request);
        
        $validator = Validator::make($request->all(), $rules);
        
        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput();;
        }
        
        $insert_id = Module::updateRow("Creditvouchers", $request, $id);
        
        return redirect()->route(config('laraadmin.adminRoute') . '.creditvouchers.index');
    }

    /**
     * Remove the specified creditvoucher from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        Creditvoucher::find($id)->delete();
        // Redirecting to index() method
        return redirect()->route(config('laraadmin.adminRoute') . '.creditvouchers.index');
    }
    
    /**
     * Datatable Ajax fetch
     *
     * @return
     */
    public function dtajax()
    {
        $users = DB::table('creditvouchers')->select($this->listing_cols);
        $out = Datatables::of($users)->make();
        $data = $out->getData();
        
        for($i=0; $i<count($data->data); $i++) {
            for ($j=0; $j < count($this->listing_cols); $j++) { 
                $col = $this->listing_cols[$j];
                if($col == $this->view_col) {
                    $data->data[$i][$j] = '<a href="'.url(config('laraadmin.adminRoute') . '/creditvouchers/'.$data->data[$i][0]).'">'.$data->data[$i][$j].'</a>';
                }
                // else if($col == "author") {
                //    $data->data[$i][$j];
                // }
            }
            if($this->show_action) {
                $output = '<a href="'.url(config('laraadmin.adminRoute') . '/creditvouchers/'.$data->data[$i][0].'/edit').'" class="btn btn-warning btn-xs" style="display:inline;padding:2px 5px 3px 5px;"><i class="fa fa-edit"></i></a>';
                $output .= Form::open(['route' => [config('laraadmin.adminRoute') . '.creditvouchers.destroy', $data->data[$i][0]], 'method' => 'delete', 'style'=>'display:inline']);
                $output .= ' <button class="btn btn-danger btn-xs" type="submit"><i class="fa fa-times"></i></button>';
                $output .= Form::close();
                $data->data[$i][] = (string)$output;
            }
        }
        $out->setData($data);
        return $out;
    }
}

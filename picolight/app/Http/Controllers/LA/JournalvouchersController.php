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

use App\Journalvoucher;
use App\AccTransactionMaster;
use App\AccTransactionMethod;
use App\AccTransactionDetail;
use App\Acc_account;


class JournalvouchersController extends Controller
{
    public $show_action = true;
    public $view_col = 'address';
    public $listing_cols = ['id', 'address'];
    
    public function __construct() {
        // for authentication (optional)
        $this->middleware('auth');
    }
    
    /**
     * Display a listing of the Journalvouchers.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $module = Module::get('Journalvouchers');
        $voucher = new AccTransactionMaster();
        $items = AccTransactionMethod::all();
        $acc_items = Acc_account::all();
        
        // return View('la.journalvouchers.index', [
        //     'show_actions' => $this->show_action,
        //     'listing_cols' => $this->listing_cols,
        //     'module' => $module
        // ]);
        return view('la.journalvouchers.index', [
        'vouchers' => AccTransactionMaster::orderBy('created_at', 'asc')->get(),
        'voucher' => $voucher,
        'items' => $items,
        'acc_items' => $acc_items,
        'show_actions' => $this->show_action

            // 'show_actions' => $this->show_action,
            // 'listing_cols' => $this->listing_cols,
            // 'module' => $module
            // 'cold_storage_agent_registers' =>  Cold_storage_agent_register::where('agent_code', Auth::user()->id)->get()

        ]);
    }

    /**
     * Show the form for creating a new journalvoucher.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created journalvoucher in database.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        // $rules = Module::validateRules("Journalvouchers", $request);
        
        // $validator = Validator::make($request->all(), $rules);
        
        // if ($validator->fails()) {
        //     return redirect()->back()->withErrors($validator)->withInput();
        // }
            
        // $insert_id = Module::insert("Journalvouchers", $request);
        
        // return redirect()->route(config('laraadmin.adminRoute') . '.journalvouchers.index');

        $module = Module::get('Debitvouchers');
        // $voucher = new AccTransactionMaster();
        $items = AccTransactionMethod::all();
        $acc_items = Acc_account::all();
        $voucher = new AccTransactionMaster();

        // $validator = Validator::make($voucher->all(), [
        //     // 'trans_ma_id' => 'required|max:255',
        //     // 'voucher_no' => 'required|max:255',
        // ]);
        // if ($validator->fails()) {
        //     return redirect('/journalVoucher/')
        //         ->withInput()
        //         ->withErrors($validator);
        // }

        if($voucher->id == 0)
        {
            $updatevoucher = new AccTransactionMaster();

        }
        else
        {
            $updatevoucher = AccTransactionMaster::find($voucher->id);
        }
 
        //abort(403,"bkvjkljlkgd".$voucher->voucher_no);

        $updatevoucher->trans_date = $request->trans_date;
        $updatevoucher->voucher_no = $request->voucher_no;
        $updatevoucher->voucher_type = 3;//journal = 3
        // $updatevoucher->trans_method_id = $voucher->trans_method;
        $updatevoucher->trans_description = $request->trans_description;
        $updatevoucher->approved_by = $request->approved_by;
        $updatevoucher->approved_date = $request->approved_date;
        $updatevoucher->module = "Voucher";
        $updatevoucher->user_id = Auth::user()->id;

        $updatevoucher->save();
        $acc_transaction_master_info = AccTransactionMaster::where('voucher_no', $updatevoucher->voucher_no)->first();



        //abort(403, "ID: ".$acc_transaction_master_info->trans_ma_id);

           $t_m_id = $acc_transaction_master_info->trans_ma_id;


    for($detial_index = 1; $detial_index <= $request->detail_max_number;$detial_index++)
        {
                 
                $updateT_details = new AccTransactionDetail();

                $updateT_details->credit_amt = $request->credit_amt[$detial_index];
                $updateT_details->trans_m_id = $t_m_id;
                $updateT_details->account_id = $request->account_no[$detial_index];
                $updateT_details->debit_amt = $request->debit_amt[$detial_index];
                $updateT_details->user_id = $updatevoucher->user_id;

                $updateT_details->save();

        }

        return redirect()->route(config('laraadmin.adminRoute') . '.journalvouchers.index');

    }

    /**
     * Display the specified journalvoucher.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $journalvoucher = Journalvoucher::find($id);
        $module = Module::get('Journalvouchers');
        $module->row = $journalvoucher;
        return view('la.journalvouchers.show', [
            'module' => $module,
            'view_col' => $this->view_col,
            'no_header' => true,
            'no_padding' => "no-padding"
        ])->with('journalvoucher', $journalvoucher);
    }

    /**
     * Show the form for editing the specified journalvoucher.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $journalvoucher = Journalvoucher::find($id);
        
        $module = Module::get('Journalvouchers');
        
        $module->row = $journalvoucher;
        
        return view('la.journalvouchers.edit', [
            'module' => $module,
            'view_col' => $this->view_col,
        ])->with('journalvoucher', $journalvoucher);
    }

    /**
     * Update the specified journalvoucher in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $rules = Module::validateRules("Journalvouchers", $request);
        
        $validator = Validator::make($request->all(), $rules);
        
        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput();;
        }
        
        $insert_id = Module::updateRow("Journalvouchers", $request, $id);
        
        return redirect()->route(config('laraadmin.adminRoute') . '.journalvouchers.index');
    }

    /**
     * Remove the specified journalvoucher from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        Journalvoucher::find($id)->delete();
        // Redirecting to index() method
        return redirect()->route(config('laraadmin.adminRoute') . '.journalvouchers.index');
    }
    
    /**
     * Datatable Ajax fetch
     *
     * @return
     */
    public function dtajax()
    {
        $users = DB::table('journalvouchers')->select($this->listing_cols);
        $out = Datatables::of($users)->make();
        $data = $out->getData();
        
        for($i=0; $i<count($data->data); $i++) {
            for ($j=0; $j < count($this->listing_cols); $j++) { 
                $col = $this->listing_cols[$j];
                if($col == $this->view_col) {
                    $data->data[$i][$j] = '<a href="'.url(config('laraadmin.adminRoute') . '/journalvouchers/'.$data->data[$i][0]).'">'.$data->data[$i][$j].'</a>';
                }
                // else if($col == "author") {
                //    $data->data[$i][$j];
                // }
            }
            if($this->show_action) {
                $output = '<a href="'.url(config('laraadmin.adminRoute') . '/journalvouchers/'.$data->data[$i][0].'/edit').'" class="btn btn-warning btn-xs" style="display:inline;padding:2px 5px 3px 5px;"><i class="fa fa-edit"></i></a>';
                $output .= Form::open(['route' => [config('laraadmin.adminRoute') . '.journalvouchers.destroy', $data->data[$i][0]], 'method' => 'delete', 'style'=>'display:inline']);
                $output .= ' <button class="btn btn-danger btn-xs" type="submit"><i class="fa fa-times"></i></button>';
                $output .= Form::close();
                $data->data[$i][] = (string)$output;
            }
        }
        $out->setData($data);
        return $out;
    }
}

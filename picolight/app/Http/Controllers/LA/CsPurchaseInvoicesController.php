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

use App\CsPurchaseInvoice;

class CsPurchaseInvoicesController extends Controller
{
    public $show_action = true;
    public $view_col = 'category';
    public $listing_cols = ['id', 'invoice_no', 'date', 'bill_no', 'purchase_type', 'suppliers', 'item', 'category', 'unit', 'quantity', 'sub_quantity', 'total_quantity', 'Actual_price', 'Purchase_price', 'total_Purchase_price', 'grans_total_price', 'payment_status', 'due_amount', 'detail', 'user_id'];
    
    public function __construct() {
        // for authentication (optional)
        $this->middleware('auth');
    }
    
    /**
     * Display a listing of the CsPurchaseInvoices.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $module = Module::get('CsPurchaseInvoices');
        
        return View('la.cspurchaseinvoices.index', [
            'show_actions' => $this->show_action,
            'listing_cols' => $this->listing_cols,
            'module' => $module
        ]);
    }

    /**
     * Show the form for creating a new cspurchaseinvoice.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created cspurchaseinvoice in database.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $rules = Module::validateRules("CsPurchaseInvoices", $request);
        
        $validator = Validator::make($request->all(), $rules);
        
        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput();
        }
            
        $insert_id = Module::insert("CsPurchaseInvoices", $request);
        
        return redirect()->route(config('laraadmin.adminRoute') . '.cspurchaseinvoices.index');
    }

    /**
     * Display the specified cspurchaseinvoice.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $cspurchaseinvoice = CsPurchaseInvoice::find($id);
        $module = Module::get('CsPurchaseInvoices');
        $module->row = $cspurchaseinvoice;
        return view('la.cspurchaseinvoices.show', [
            'module' => $module,
            'view_col' => $this->view_col,
            'no_header' => true,
            'no_padding' => "no-padding"
        ])->with('cspurchaseinvoice', $cspurchaseinvoice);
    }

    /**
     * Show the form for editing the specified cspurchaseinvoice.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $cspurchaseinvoice = CsPurchaseInvoice::find($id);
        
        $module = Module::get('CsPurchaseInvoices');
        
        $module->row = $cspurchaseinvoice;
        
        return view('la.cspurchaseinvoices.edit', [
            'module' => $module,
            'view_col' => $this->view_col,
        ])->with('cspurchaseinvoice', $cspurchaseinvoice);
    }

    /**
     * Update the specified cspurchaseinvoice in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $rules = Module::validateRules("CsPurchaseInvoices", $request);
        
        $validator = Validator::make($request->all(), $rules);
        
        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput();;
        }
        
        $insert_id = Module::updateRow("CsPurchaseInvoices", $request, $id);
        
        return redirect()->route(config('laraadmin.adminRoute') . '.cspurchaseinvoices.index');
    }

    /**
     * Remove the specified cspurchaseinvoice from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        CsPurchaseInvoice::find($id)->delete();
        // Redirecting to index() method
        return redirect()->route(config('laraadmin.adminRoute') . '.cspurchaseinvoices.index');
    }
    
    /**
     * Datatable Ajax fetch
     *
     * @return
     */
    public function dtajax()
    {
        $users = DB::table('cspurchaseinvoices')->select($this->listing_cols);
        $out = Datatables::of($users)->make();
        $data = $out->getData();
        
        for($i=0; $i<count($data->data); $i++) {
            for ($j=0; $j < count($this->listing_cols); $j++) { 
                $col = $this->listing_cols[$j];
                if($col == $this->view_col) {
                    $data->data[$i][$j] = '<a href="'.url(config('laraadmin.adminRoute') . '/cspurchaseinvoices/'.$data->data[$i][0]).'">'.$data->data[$i][$j].'</a>';
                }
                // else if($col == "author") {
                //    $data->data[$i][$j];
                // }
            }
            if($this->show_action) {
                $output = '<a href="'.url(config('laraadmin.adminRoute') . '/cspurchaseinvoices/'.$data->data[$i][0].'/edit').'" class="btn btn-warning btn-xs" style="display:inline;padding:2px 5px 3px 5px;"><i class="fa fa-edit"></i></a>';
                $output .= Form::open(['route' => [config('laraadmin.adminRoute') . '.cspurchaseinvoices.destroy', $data->data[$i][0]], 'method' => 'delete', 'style'=>'display:inline']);
                $output .= ' <button class="btn btn-danger btn-xs" type="submit"><i class="fa fa-times"></i></button>';
                $output .= Form::close();
                $data->data[$i][] = (string)$output;
            }
        }
        $out->setData($data);
        return $out;
    }
}
